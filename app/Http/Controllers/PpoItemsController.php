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
use eppo\Lucode;

class PpoItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = PpoItem::with('doseUnit','mitteUnit','ppo','medication','ppoSection','lucodes')->paginate(10);
        $isAdminView = true;
        return view('ppo_items.index', compact('items','isAdminView'));
    }
    /**
     * Get a listing of the resource by AJAX.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxListByMed(Request $request)
    {
        $id = $request->medid;
        $templates = PpoItem::where('medication_id', $id)->get()->lists('detail','id');
        return response()->json($templates);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($ppoid, $templateid=null)
    {
        $ppo = Ppo::select('id','name')->findOrFail($ppoid);
        if($templateid) {
            $item = PpoItem::select(
                'medication_id',
                'is_active',
                'ppo_section_id',
                'dose_base',
                'dose_calculation_type_id',
                'fixed_dose_result',
                'dose_unit_id',
                'dose_route_id',
                'instruction',
                'is_instruction_input',
                'is_start_date',
                'is_frequency_input',
                'is_duration_input',
                'is_mitte_input',
                'is_repeat_input',
                'mitte_unit_id',
                'id')->with('lucodes')->findOrFail($templateid);
            $item->id = null;
            //because detail is not a db field, so we have to get() first then lists()
            $templates = PpoItem::where('medication_id', $item->medication_id)->get()->lists('detail','id')->toArray();
            $templateSelected = $templateid;
            $lucodes = Lucode::where('medication_id', $item->medication_id)->get()->lists('detail','id')->toArray();
            $lucodesSelected = $item->lucodes->pluck('id')->all();
        } else {
            $item = new PpoItem();
            $lucodes = array();
            $lucodesSelected = null;
            $templates = array();
            $templateSelected = null;
        }
        $medications = Medication::lists('name','id');
        $ppoSections = PpoSection::lists('name','id');
        $doseCalculationTypes = DoseCalculationType::lists('name','id');
        $doseUnits = DoseUnit::lists('name','id');
        $doseRoutes = DoseRoute::lists('name','id');
        $mitteUnits = MitteUnit::lists('name','id');


        return view('ppo_items.create', compact('templates','templateSelected','lucodes','lucodesSelected','item','medications','ppoSections','ppo','doseCalculationTypes','doseUnits','doseRoutes','mitteUnits'));
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
        $item = PpoItem::create( $input );
        if(isset($request->lucodes))
        {
            $item->lucodes()->sync($request->lucodes);
        }
        return redirect()->route('ppos.show', ['id'=>$input['ppo_id']])->with('success-message', 'Dose Schedule created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = PpoItem::with('doseUnit','mitteUnit','ppo','medication')->findOrFail($id);
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
        $item = PpoItem::with('lucodes')->findOrFail($id);
        //because detail is not a db field, so we have to get() first then lists()
        $templates = PpoItem::where('medication_id', $item->medication_id)->get()->lists('detail','id')->toArray();
        $templateSelected = $id;
        $lucodes = Lucode::where('medication_id', $item->medication_id)->get()->lists('detail','id')->toArray();
        $lucodesSelected = $item->lucodes->pluck('id')->all();


        $medications = Medication::lists('name','id');
        $ppoSections = PpoSection::lists('name','id');
        $ppos = Ppo::lists('name','id');
        $doseCalculationTypes = DoseCalculationType::lists('name','id');
        $doseUnits = DoseUnit::lists('name','id');
        $doseRoutes = DoseRoute::lists('name','id');
        $mitteUnits = MitteUnit::lists('name','id');


        return view('ppo_items.edit', compact('templates','templateSelected','lucodes','lucodesSelected','item','medications','ppoSections','ppos','doseCalculationTypes','doseUnits','doseRoutes','mitteUnits'));
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
        if(isset($request->lucodes))
        {
            $item->lucodes()->sync($request->lucodes);
        }
        return redirect()->back()->with('success-message', 'Dose Schedule updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $item = PpoItem::findOrFail($id);
        $item->delete();
        $request->session()->put('success-message', 'Dose Schedule deleted.');
        return redirect()->back();
    }
}