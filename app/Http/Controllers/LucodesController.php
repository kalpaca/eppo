<?php

namespace eppo\Http\Controllers;

use Illuminate\Http\Request;
use eppo\Http\Requests;
use eppo\Http\Controllers\Controller;

use eppo\Lucode;
use eppo\Medication;

class LucodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lucodes = Lucode::with('medication')->paginate(10);
        return view('lucodes.index', compact('lucodes'));
    }

    /**
     * Get a listing of the resource by AJAX.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxListByMed(Request $request)
    {
        $id = $request->medid;
        $lucodes = Lucode::where('medication_id', $id)->get()->lists('detail','id');
        return response()->json($lucodes);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($medid = null)
    {
        if($medid)
        {
            $medication = Medication::select('name','id')->find($medid);
            $medications = null;
        }
        else
        {
            $medication = null;
            $medications = Medication::lists('name','id');
        }

        return view('lucodes.create', compact('medication','medications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Lucode::create( $input );

        return redirect()->route('medications.show', $input['medication_id'])->with('success-message', 'Lucode created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lucodes = Lucode::findOrFail($id);
        return view('lucodes.show', compact('lucodes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lucode = Lucode::with('medication')->findOrFail($id);
        $medication = $lucode->medication;
        return view('lucodes.edit', compact('lucode','medication'));
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
        $lucode = Lucode::findOrFail($id);
        $lucode->update( $input );

        return redirect()->route('medications.show', $input['medication_id'])->with('success-message', 'Lucode created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $lucode = Lucode::findOrFail($id);
        $lucode->delete();
        $request->session()->put('success-message', 'Lucode deleted.');
        return redirect()->back();
    }
}
