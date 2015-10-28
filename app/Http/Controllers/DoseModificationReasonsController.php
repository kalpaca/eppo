<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\DoseModificationReason;

class DoseModificationReasonsController extends Controller
{
    public function index()
    {
        $reasons = DoseModificationReason::all();
        return view('dosemodificationreasons.index', compact('reasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dosemodificationreasons.create');
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

        return redirect()->route('dosemodificationreasons.index')->with('success-message', 'Dose Calculation Type created');
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
        return view('dosemodificationreasons.show', compact('reason'));
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
        return view('dosemodificationreasons.edit', compact('reason'));
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
        $reason = DoseModificationReason::findOrFail($id);
        $reason->update( $input );

        return redirect()->route('dosemodificationreasons.index')->with('success-message', 'Dose Calculation Type updated');
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
