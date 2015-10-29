<?php

namespace eppo\Http\Controllers;

use Illuminate\Http\Request;

use eppo\Http\Requests;
use eppo\Http\Controllers\Controller;

use eppo\MitteUnit;

class MitteUnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = MitteUnit::all();
        return view('mitte_units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mitte_units.create');
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
            'name' => 'required',
        ]);
        $input = $request->all();
        MitteUnit::create( $input );

        return redirect()->route('mitteunits.index')->with('success-message', 'Mitte Unit created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $units = MitteUnit::findOrFail($id);
        return view('mitte_units.show', compact('units'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = MitteUnit::findOrFail($id);
        return view('mitte_units.edit', compact('unit'));
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
        $input = $request->all();
        $unit = MitteUnit::findOrFail($id);
        $unit->update( $input );

        return redirect()->route('mitteunits.index')->with('success-message', 'Mitte Unit updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = MitteUnit::findOrFail($id);
        $unit->delete();

        return redirect()->route('mitteunits.index')->with('success-message', 'Mitte Unit deleted.');
    }
}