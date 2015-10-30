<?php

namespace eppo\Http\Controllers;

use Illuminate\Http\Request;

use eppo\Http\Requests;
use eppo\Http\Controllers\Controller;

use eppo\DosingSchedule;
use eppo\Medication;
use eppo\Ppo;
use eppo\PpoSection;
use eppo\DoseUnit;
use eppo\DoseRoute;
use eppo\MitteUnit;
use eppo\DoseCalculationType;

class DosingSchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = DosingSchedule::with('doseRoute','doseUnit','doseCalculationType','mitteUnit','ppo','medication','ppoSection')->get();
        return view('dosing_schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $medications = Medication::lists('name','id');
        $ppoSections = PpoSection::lists('name','id');
        $ppos = Ppo::lists('name','id');
        $doseCalculationTypes = DoseCalculationType::lists('name','id');
        $doseUnits = DoseUnit::lists('name','id');
        $doseRoutes = DoseRoute::lists('name','id');
        $mitteUnits = MitteUnit::lists('name','id');

        return view('dosing_schedules.create', compact('medications','ppoSections','ppos','doseCalculationTypes','doseUnits','doseRoutes','mitteUnits'));
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
            'ppo_id' => 'required',
            'medication_id' => 'required',
            'ppo_section_id' => 'required',
        ]);
        $input = $request->all();
        DosingSchedule::create( $input );

        return redirect()->route('dosingschedules.index')->with('success-message', 'Dose Schedule created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = DosingSchedule::with('doseRoute','doseUnit','doseCalculationType','mitteUnit','ppo','medication','ppoSection')->findOrFail($id);
        return view('dosing_schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule = DosingSchedule::findOrFail($id);

        $medications = Medication::lists('name','id');
        $ppoSections = PpoSection::lists('name','id');
        $ppos = Ppo::lists('name','id');
        $doseCalculationTypes = DoseCalculationType::lists('name','id');
        $doseUnits = DoseUnit::lists('name','id');
        $doseRoutes = DoseRoute::lists('name','id');
        $mitteUnits = MitteUnit::lists('name','id');

        return view('dosing_schedules.edit', compact('schedule','medications','ppoSections','ppos','doseCalculationTypes','doseUnits','doseRoutes','mitteUnits'));
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
            'ppo_id' => 'required',
            'medication_id' => 'required',
            'ppo_section_id' => 'required',
        ]);
        $input = $request->all();
        $schedule = DosingSchedule::findOrFail($id);
        $schedule->update( $input );

        return redirect()->route('dosingschedules.index')->with('success-message', 'Dose Schedule updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = DosingSchedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('dosingschedules.index')->with('success-message', 'Dose Schedule deleted.');
    }
}