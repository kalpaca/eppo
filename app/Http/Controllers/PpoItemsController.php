<?php

namespace eppo\Http\Controllers;

use Illuminate\Http\Request;

use eppo\Http\Requests;
use eppo\Http\Controllers\Controller;

use eppo\PpoItem;
use eppo\Medication;
use eppo\Ppo;
use eppo\PpoSection;
use eppo\DoseUnit;
use eppo\DoseRoute;
use eppo\MitteUnit;
use eppo\DoseCalculationType;

class PpoItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = PpoItem::with('doseRoute','doseUnit','mitteUnit','ppo','medication','ppoSection')->get();
        return view('ppo_items.index', compact('items'));
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

        return view('ppo_items.create', compact('medications','ppoSections','ppos','doseCalculationTypes','doseUnits','doseRoutes','mitteUnits'));
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
        PpoItem::create( $input );

        return redirect()->route('ppoitems.index')->with('success-message', 'Dose Schedule created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = PpoItem::with('doseRoute','doseUnit','doseCalculationType','mitteUnit','ppo','medication','ppoSection')->findOrFail($id);
        return view('ppo_items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = PpoItem::findOrFail($id);

        $medications = Medication::lists('name','id');
        $ppoSections = PpoSection::lists('name','id');
        $ppos = Ppo::lists('name','id');
        $doseCalculationTypes = DoseCalculationType::lists('name','id');
        $doseUnits = DoseUnit::lists('name','id');
        $doseRoutes = DoseRoute::lists('name','id');
        $mitteUnits = MitteUnit::lists('name','id');

        return view('ppo_items.edit', compact('item','medications','ppoSections','ppos','doseCalculationTypes','doseUnits','doseRoutes','mitteUnits'));
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
        $item = PpoItem::findOrFail($id);
        $item->update( $input );

        return redirect()->route('ppoitems.index')->with('success-message', 'Dose Schedule updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = PpoItem::findOrFail($id);
        $item->delete();

        return redirect()->route('ppoitems.index')->with('success-message', 'Dose Schedule deleted.');
    }
}