<?php

namespace eppo\Http\Controllers;

use Illuminate\Http\Request;
use eppo\Http\Requests;
use eppo\Http\Controllers\Controller;

use eppo\DoseModificationReason;

class DoseModificationReasonsController extends Controller
{
    public function index()
    {
        $reasons = DoseModificationReason::all();
        return view('dose_modification_reasons.index', compact('reasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dose_modification_reasons.create');
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
        DoseModificationReason::create( $input );

        return redirect()->route('dosemodificationreasons.index')->with('success-message', 'Dose Modification Reason created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reason = DoseModificationReason::findOrFail($id);
        return view('dose_modification_reasons.show', compact('reason'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reason = DoseModificationReason::findOrFail($id);
        return view('dose_modification_reasons.edit', compact('reason'));
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
            'name' => 'required',
        ]);
        $input = $request->all();
        $reason = DoseModificationReason::findOrFail($id);
        $reason->update( $input );

        return redirect()->route('dosemodificationreasons.index')->with('success-message', 'Dose Modification Reason updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reason = DoseModificationReason::findOrFail($id);
        $reason->delete();

        return redirect()->route('dosemodificationreasons.index')->with('success-message', 'Dose Calculation Type deleted.');
    }
}
