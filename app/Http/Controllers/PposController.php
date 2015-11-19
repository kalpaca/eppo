<?php

namespace eppo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use eppo\Http\Requests;
use eppo\Http\Controllers\Controller;

use eppo\Ppo;
use eppo\Regimen;
use eppo\Diagnosis;
use eppo\DoseModificationReason;
use eppo\DiagnosisSecondaryCategory;
use eppo\DiagnosisPrimaryCategory;


class PposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->isMethod('post'))
        {
            if($request->name)
            {
                $ppos = Ppo::with('diagnoses','regimen','author')
                ->where('name', 'like', '%'.$request->name.'%')
                ->paginate(10);
            }
        }
        else
            $ppos = Ppo::with('diagnoses','regimen','author')->paginate(10);
        return view('ppos.index', compact('ppos'));
    }

    /**
     * Select a ppo based on regimen and diagnosis.
     *
     * @return \Illuminate\Http\Response
     */
    public function explore($patientid)
    {
        $primaryCats = DiagnosisPrimaryCategory::with('secondaryCats')->get();
        $secondaryCats = DiagnosisSecondaryCategory::lists('diagnosis_primary_category_id','id');
        $ppos = Ppo::with('diagnoses','regimen')->get(['regimen_id','id']);
        return view('ppos.explore', compact('primaryCats','secondaryCats','ppos','patientid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regimens = Regimen::lists('name','id');
        $diagnoses = Diagnosis::lists('name','id');
        $reasons = DoseModificationReason::lists('name','id');
        $diagnosesSelected = null;
        $reasonsSelected = null;
        return view('ppos.create', compact('regimens','diagnosesSelected','diagnoses','reasons','reasonsSelected'));
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
            'regimen_id' => 'required',
            'name' => 'required',
        ]);
        $user = Auth::user();

        $request->merge(array('user_id' => $user->id));

        $input = $request->all();

        $ppo = Ppo::create( $input );

        if(isset($request->diagnoses))
        {
            $ppo->diagnoses()->sync($request->diagnoses);
        }
        if(isset($request->reasons))
        {
            $ppo->reasons()->sync($request->reasons);
        }
        return redirect()->route('ppos.show',$ppo->id)->with('message', 'PPO created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {//'doseModificationReasons'
        $ppo = Ppo::with('diagnoses','regimen','author','ppoItems','reasons')->findOrFail($id);
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
        $isAdminView = true;
        $patient = null;
        //flash a back url
        $request->session()->put('backUrl', $request->fullUrl());

        return view('ppos.show', compact('ppo','rx','supportiveRx','isAdminView','patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ppo = Ppo::findOrFail($id);
        $regimens = Regimen::lists('name','id');
        $diagnoses = Diagnosis::lists('name','id');
        $reasons = DoseModificationReason::lists('name','id');
        $diagnosesSelected = $ppo->diagnoses->pluck('id')->all();
        $reasonsSelected = $ppo->reasons->pluck('id')->all();
        return view('ppos.edit', compact('ppo','regimens','diagnosesSelected','diagnoses','reasons','reasonsSelected'));
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
            'regimen_id' => 'required',
            'name' => 'required',
        ]);

        $user = Auth::user();

        $request->merge(array('user_id' => $user->id));

        $input = $request->all();

        $ppo = Ppo::findOrFail($id);
        $ppo->update( $input );

        if(isset($request->diagnoses))
        {
            $ppo->diagnoses()->sync($request->diagnoses);
        }
        if(isset($request->reasons))
        {
            $ppo->reasons()->sync($request->reasons);
        }
        return redirect()->route('ppos.index')->with('message', 'PPO updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ppo = Ppo::findOrFail($id);
        $ppo->delete();

        return redirect()->route('ppos.index')->with('success-message', 'PPO deleted.');
    }


    /**
     * Show the form for creating a new resource in ajax modal.
     *
     * @return \Illuminate\Http\Response
     */
    public function addDiagnosisAjax(Request $request)
    {
        $cats = DiagnosisSecondaryCategory::lists('name', 'id');
        if($request->isMethod('post')){
            $this->validate($request, [
                'name' => 'required',
            ]);

            $input = $request->all();
            Diagnosis::create( $input );
            return redirect()->route('ppos.create')->with('success-message', 'Diagnosis list updated');
        }
        return view('ppos.add_diagnosis_ajax', compact('cats'));
    }

    /**
     * Show the form for creating a new resource in ajax modal.
     *
     * @return \Illuminate\Http\Response
     */
    public function addRegimenAjax(Request $request)
    {
        if($request->isMethod('post')){
            $this->validate($request, [
                'name' => 'required',
            ]);

            $input = $request->all();
            Regimen::create( $input );
            return redirect()->route('ppos.create')->with('success-message', 'Regimen list updated');
        }
        return view('ppos.add_regimen_ajax');
    }

    /**
     * Show the form for creating a new resource in ajax modal.
     *
     * @return \Illuminate\Http\Response
     */
    public function addReasonAjax(Request $request)
    {
        if($request->isMethod('post')){
            $this->validate($request, [
                'name' => 'required',
            ]);

            $input = $request->all();
            DoseModificationReason::create( $input );
            return redirect()->route('ppos.create')->with('success-message', 'Regimen list updated');
        }
        return view('ppos.add_reason_ajax');
    }
}
