<?php

namespace eppo\Http\Controllers;

use Illuminate\Http\Request;
use eppo\Http\Requests;
use eppo\Http\Controllers\Controller;

use eppo\Ppo;
use eppo\Regimen;
use eppo\Diagnosis;
use eppo\DoseModificationReason;

class PposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ppos = Ppo::with('diagnoses','regimen','author')->get();
        return view('ppos.index', compact('ppos'));
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
        return view('ppos.create', compact('regimens','diagnosesSelected','diagnoses','reasons'));
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
        ]);

        $input = $request->all();

        $ppo = Ppo::create( $input );

        if(isset($request->diagnoses))
        {
            $ppo->diagnoses()->sync($request->diagnoses);
        }

        return redirect()->route('ppos.index')->with('message', 'PPO created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ppo = Ppo::find($id)->with('ppoSections','diagnoses','regimen','author','dosingSchedule','doseModificationReasons')->get();
        return view('ppos.show', compact('ppo'));
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
        return view('ppos.edit', compact('ppo','regimens','diagnosesSelected','diagnoses','reasons'));
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
        ]);
        $input = $request->all();

        $ppo = Ppo::findOrFail($id);
        $ppo->update( $input );
        if(isset($request->diagnoses))
        {
            $ppo->diagnoses()->sync($request->diagnoses);
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
}
