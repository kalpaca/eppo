<?php

namespace eppo\Http\Controllers;

use Illuminate\Http\Request;
use eppo\Http\Requests;
use eppo\Http\Controllers\Controller;
use eppo\Prescription;
use eppo\PrescriptionItem;
use eppo\Ppo;
use eppo\Diagnosis;
class PrescriptionsController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::with('diagnosis','regimen')->get();
        return view('prescriptions.index', compact('prescriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($ppoId, $diagnosisId)
    {
        $diagnosis = Diagnosis::findOrFail($diagnosisId);
        $ppo = Ppo::with('diagnoses','regimen','author','ppoItems')->findOrFail($ppoId);
        return view('prescriptions.create', compact('ppo','diagnosis'));
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prescription = Prescription::with('diagnosis','regimen','author','prescriptionItems','reasons')->findOrFail($id);
        return view('prescriptions.show', compact('prescription'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prescription = Prescription::with('diagnosis','regimen','author','prescriptionItems','reasons')->findOrFail($id);
        return view('prescriptions.edit', compact('prescription'));
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
        $input = $request->all();

        $prescription = Prescription::findOrFail($id);
        $prescription->update( $input );

        if(isset($request->prescriptionItems))
        {
            $prescription->prescriptionItems()->delete();
            foreach($request->prescriptionItems as $item)
                if(isset($item['is_selected']) && $item['is_selected'])
                    $prescription->prescriptionItems()->create($item);
        }
        if(isset($request->reasons))
        {
            $prescription->reasons()->sync($request->reasons);
        }
        return redirect()->route('prescriptions.show', [$prescription->id])->with('message', 'Prescription created');
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
