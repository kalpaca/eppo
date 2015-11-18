<?php

namespace eppo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use eppo\Http\Requests;
use eppo\Http\Controllers\Controller;
use eppo\Prescription;
use eppo\PrescriptionItem;
use eppo\Ppo;
use eppo\Diagnosis;
use eppo\Patient;
use PDF;
class PrescriptionsController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $prescriptions = Prescription::where('user_id', $userId)->with('diagnosis','regimen','author','patient')->paginate(10);
        return view('prescriptions.index', compact('prescriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param   $ppoid, ppo id selected in ppo explorer;
     *          $diagnosisid, id selected in ppo explorer;
     *          $patientid, id selected patient selection;
     *
     * @return \Illuminate\Http\Response
     */

    public function create($ppoid, $diagnosisid, $patientid)
    {
        $diagnosis = Diagnosis::findOrFail($diagnosisid);
        $patient = Patient::findOrFail($patientid);
        $ppo = Ppo::with('diagnoses','regimen','author','ppoItems')->findOrFail($ppoid);
        $ppo->ppoItems->load('doseUnit','mitteUnit','medication','lucodes');
        $rx = new Collection();
        $supportiveRx = new Collection();
        foreach($ppo->ppoItems as $item)
        {
            if($item->ppo_section_id == 1)
                $rx->push($item);
            elseif($item->ppo_section_id == 2)
                $supportiveRx->push($item);
        }
        return view('prescriptions.create', compact('patient','ppo','diagnosis','rx','supportiveRx'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'diagnosis_id' => 'required',
            'regimen_id' => 'required',
            'ppo_id' => 'required',
        ]);

        $user = Auth::user();

        $request->merge(array('user_id' => $user->id));

        $input = $request->all();

        $prescription = Prescription::create( $input );

        if(isset($request->prescriptionItems))
        {
            foreach($request->prescriptionItems as $item)
            {
                if(isset($item['is_selected']) && $item['is_selected'])
                    $prescription->prescriptionItems()->create($item);
            }
        }
        if(isset($request->reasons))
        {
            $prescription->reasons()->sync($request->reasons);
        }
        return redirect()->route('prescriptions.show', [$prescription->id])->with('message', 'Prescription created');
    }

    /**
     * Finalize a prescription, lock it to prevent editing.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function finalize(Request $request, $id)
    {

        $prescription = Prescription::with('diagnosis','regimen','author','prescriptionItems','reasons','patient')->findOrFail($id);
        $prescription->prescriptionItems->load('doseUnit','mitteUnit','lucode');

        if($prescription->is_void)
        {
            return redirect()->back()->with("warning-message","Prescription void");
        }
        //set to final status
        if(!$prescription->is_final)
        {
            $prescription->is_final = true;
            $prescription->final_date = date("F d, Y, g:i a");
            $prescription->save();
        }


        $rx = new Collection();
        $supportiveRx = new Collection();
        foreach($prescription->prescriptionItems as $item)
        {
            if($item->ppo_section_id == 1)
                $rx->push($item);
            elseif($item->ppo_section_id == 2)
                $supportiveRx->push($item);
        }
        $pdf = PDF::loadView('prescriptions.show', compact('prescription','rx','supportiveRx'));
        $pdf->setOption('header-left', "eppo prescription");
        $pdf->setOption('header-line', true);
        $pdf->setOption('header-font-size', 24);
        $pdf->setOption('footer-center', "Genarated by eppo");
        $pdf->setOption('footer-line', true);
        $pdf->setOption('margin-top', '24mm');
        $pdf->setOption('margin-bottom', '24mm');
        $pdf->setOption('print-media-type', true);
        return $pdf->download('eppo_prescription_'.$prescription->id.'.pdf');
    }

    /**
     * Finalize a prescription, lock it to prevent editing.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function void(Request $request, $id)
    {
        $prescription = Prescription::findOrFail($id);
        $prescription->is_final = true;
        $prescription->is_void = true;
        $prescription->final_date = date("F d, Y, g:i a");
        $prescription->save();
        return redirect()->back()->with("success-message","Prescription void");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prescription = Prescription::with('diagnosis','regimen','author','prescriptionItems','reasons','patient')->findOrFail($id);
        $prescription->prescriptionItems->load('doseUnit','mitteUnit','lucode');
        $rx = new Collection();
        $supportiveRx = new Collection();
        foreach($prescription->prescriptionItems as $item)
        {
            if($item->ppo_section_id == 1)
                $rx->push($item);
            elseif($item->ppo_section_id == 2)
                $supportiveRx->push($item);
        }
        return view('prescriptions.show', compact('prescription','rx','supportiveRx'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prescription = Prescription::with('diagnosis','ppo.ppoItems','author','prescriptionItems','reasons','patient')->findOrFail($id);
        if($prescription->is_final)
            return redirect()->back();
        $patient = $prescription->patient;
        $ppo = $prescription->ppo;
        $ppo->ppoItems->load('doseUnit','mitteUnit','medication','lucodes');
        $rx = new Collection();
        $supportiveRx = new Collection();
        $temp = new Collection();

        //this loop will produce the ppo item collection, which looks like a bunch of inputs on form
        //and those ppoItems index by ppo item id in the form
        foreach($ppo->ppoItems as $item)
        {
            if($item->ppo_section_id == 1)
                $rx->push($item);
            elseif($item->ppo_section_id == 2)
                $supportiveRx->push($item);
        }

        //this loop will produce an array for swap, make the prescriptionItems array indexed by ppo_item_id
        //so prescriptionItem data can find their ppo item inputs, and sit in the empty boxes where they should be!
        foreach($prescription->prescriptionItems as $item)
        {
            $temp->put($item->ppo_item_id, $item);
        }

        $prescription->prescriptionItems = $temp;

        return view('prescriptions.edit', compact('patient','diagnosis','prescription','ppo','rx','supportiveRx'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
        ]);

        $user = Auth::user();

        $request->merge(array('user_id' => $user->id));

        $input = $request->all();

        $prescription = Prescription::findOrFail($id);
        $prescription->update( $input );

        if(isset($request->prescriptionItems))
        {
            $prescription->prescriptionItems()->delete();
            foreach($request->prescriptionItems as $item)
            {
                if(isset($item['is_selected']) && $item['is_selected'])
                    $prescription->prescriptionItems()->create($item);
            }
        } else {
            $prescription->prescriptionItems()->delete();
        }
        if(isset($request->reasons))
        {
            $prescription->reasons()->sync($request->reasons);
        }
        return redirect()->route('prescriptions.show', [$prescription->id])->with('success-message', 'Prescription created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
