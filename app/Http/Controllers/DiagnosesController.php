<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Diagnosis;
use App\DiagnosisSecondaryCategory;


class DiagnosesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diagnoses = Diagnosis::with('primaryCat','secondaryCat')->get();
        return view('diagnoses.index', compact('diagnoses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = DiagnosisSecondaryCategory::lists('name', 'id');
        return view('diagnoses.create', compact('cats'));
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
        if($request->has('diagnosis_secondary_category_id')){
            $diagnosis_primary_category_id = DiagnosisSecondaryCategory::find($request->diagnosis_secondary_category_id)->diagnosis_primary_category_id;
            $request->merge( array( 'diagnosis_primary_category_id' => $diagnosis_primary_category_id ) );
        }
        //$diagnosisPrimaryCategory = DiagnosisPrimaryCategory::all();
        $input = $request->all();
        Diagnosis::create( $input );

        return redirect()->route('diagnoses.index')->with('success-message', 'Diagnosis created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $diagnosis = Diagnosis::findOrFail($id);
        return view('diagnoses.show', compact('diagnosis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $diagnosis = Diagnosis::findOrFail($id);
        $cats = DiagnosisSecondaryCategory::lists("name","id");
        return view('diagnoses.edit', compact('diagnosis','cats'));
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
        if($request->has('diagnosis_secondary_category_id')){
            $diagnosis_primary_category_id = DiagnosisSecondaryCategory::find($request->diagnosis_secondary_category_id)->diagnosis_primary_category_id;
            $request->merge( array( 'diagnosis_primary_category_id' => $diagnosis_primary_category_id ) );
        }
        $input = $request->all();
        $diagnosis = Diagnosis::findOrFail($id);
        $diagnosis->update( $input );

        return redirect()->route('diagnoses.index')->with('success-message', 'Diagnosis updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diagnosis = Diagnosis::findOrFail($id);
        $diagnosis->delete();

        return redirect()->route('diagnoses.index')->with('success-message', 'Diagnosis deleted.');
    }
}
