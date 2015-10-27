<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\DiagnosisPrimaryCategory;
use App\DiagnosisSecondaryCategory;

class DiagnosisSecondaryCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = DiagnosisSecondaryCategory::with('primaryCat')->get();
        return view('diagnosis_secondary_categories.index', compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $primaryCats = DiagnosisPrimaryCategory::lists('name', 'id');
        return view('diagnosis_secondary_categories.create', compact('primaryCats'));
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
        //var_dump($input);
        DiagnosisSecondaryCategory::create( $input );

        return redirect()->route('diagnosissecondarycategories.index')->with('success-message', 'Diagnosis secondary category created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $diagnosisSecondaryCategory = DiagnosisSecondaryCategory::findOrFail($id);
        return view('diagnosis_secondary_categories.show', compact('diagnosisSecondaryCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $diagnosisSecondaryCategory = DiagnosisSecondaryCategory::findOrFail($id);
        $primaryCats = DiagnosisPrimaryCategory::lists('name', 'id');
        return view('diagnosis_secondary_categories.edit', compact('diagnosisSecondaryCategory','primaryCats'));
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
        $cat = DiagnosisSecondaryCategory::findOrFail($id);
        $cat->update( $input );

        return redirect()->route('diagnosissecondarycategories.index')->with('success-message', 'Diagnosis secondary category updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diagnosis = DiagnosisSecondaryCategory::findOrFail($id);
        $diagnosis->delete();

        return redirect()->route('diagnosissecondarycategories.index')->with('success-message', 'Diagosis secondary category deleted.');
    }
}
