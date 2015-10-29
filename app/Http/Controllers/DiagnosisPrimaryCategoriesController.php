<?php

namespace eppo\Http\Controllers;

use Illuminate\Http\Request;

use eppo\Http\Requests;
use eppo\Http\Controllers\Controller;

use eppo\DiagnosisPrimaryCategory;

class DiagnosisPrimaryCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = DiagnosisPrimaryCategory::all();
        return view('diagnosis_primary_categories.index', compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('diagnosis_primary_categories.create');
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
        DiagnosisPrimaryCategory::create( $input );

        return redirect()->route('diagnosisprimarycategories.index')->with('success-message', 'Diagnosis primary category created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $diagnosisPrimaryCategory = DiagnosisPrimaryCategory::findOrFail($id);
        return view('diagnosis_primary_categories.show', compact('diagnosisPrimaryCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $diagnosisPrimaryCategory = DiagnosisPrimaryCategory::findOrFail($id);
        return view('diagnosis_primary_categories.edit', compact('diagnosisPrimaryCategory'));
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
        $cat = DiagnosisPrimaryCategory::findOrFail($id);
        $cat->update( $input );

        return redirect()->route('diagnosisprimarycategories.index')->with('success-message', 'Diagnosis primary category updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diagnosis = DiagnosisPrimaryCategory::findOrFail($id);
        $diagnosis->delete();

        return redirect()->route('diagnosisprimarycategories.index')->with('success-message', 'Diagosis primary category deleted.');
    }
}
