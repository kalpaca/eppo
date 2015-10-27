<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\DoseModicationReason;

class DoseModicationReasonsController extends Controller
{
    public function index()
    {
        $reasons = DoseModicationReason::all();
        return view('dosemodicationreasons.index', compact('reasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dosemodicationreasons.create');
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
        DoseModicationReason::create( $input );

        return redirect()->route('dosemodicationreasons.index')->with('success-message', 'Dose Calculation Type created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reason = DoseModicationReason::findOrFail($id);
        return view('dosemodicationreasons.show', compact('reason'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reason = DoseModicationReason::findOrFail($id);
        return view('dosemodicationreasons.edit', compact('reason'));
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
        $reason = DoseModicationReason::findOrFail($id);
        $reason->update( $input );

        return redirect()->route('dosemodicationreasons.index')->with('success-message', 'Dose Calculation Type updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reason = DoseModicationReason::findOrFail($id);
        $reason->delete();

        return redirect()->route('dosemodicationreasons.index')->with('success-message', 'Dose Calculation Type deleted.');
    }
}
