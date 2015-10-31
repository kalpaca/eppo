<?php

namespace eppo\Http\Controllers;

use Illuminate\Http\Request;
use eppo\Http\Requests;
use eppo\Http\Controllers\Controller;
use eppo\Prescription;
use eppo\Ppo;
class PrescriptionsController extends Controller
{
    public function index()
    {
        $prescription = Prescription::all();
        return view('prescriptions.index', compact('prescription'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($ppoId)
    {
        $ppo = Ppo::with('diagnoses','regimen','author','ppoItems')->findOrFail($ppoId);
        return view('prescriptions.create', compact('ppo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prescription = Prescription::find($id);
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
        $prescription = Prescription::find($id);
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
        //
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
