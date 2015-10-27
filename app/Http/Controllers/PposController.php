<?php

namespace App\Http\Controllers;
use App\Ppo;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ppos = Ppo::with('diagnoses','regimen','author')->get();
        return view('ppos.index', compact('ppos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ppos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all;
        Ppo::create( $input );

        return Redirect::route('pposs.index')->with('message', 'PPO created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ppo = Ppo::find($id)->with('ppoSections','diagnoses','regimen','author','dosingSchedule','doseModificationReasons')->get();
        return view('ppos.show', compact('ppo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $ppo = Ppo::find($id)->with('ppoSections','diagnoses','regimen','author','dosingSchedule','doseModificationReasons')->get();
        return view('ppos.edit', compact('ppo'));
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
        $input = $request->all;
        $ppo = Ppo::findOrFail($id);
        $ppo->update( $input );

        return Redirect::route('ppos.index')->with('message', 'PPO updated');
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
