@extends('layouts.master')
@section('title','ePPO')
@section('content')

<p>Welcome, currently ePPO is under construction.</p>
<p>you can check navbar 'About' link to learn more about this application.</p>
<h3>To Do List</h3>
<ul>
<li><a href="{{route('ppos.create')}}">Use Case: build ppo (almost done)</a></li>
<li><a href="{{route('ppoitems.create')}}">Use Case: add dosing schedule to ppo (almost done)</a></li>
<li><a href="{{route('ppos.show',['id'=>1])}}">Use Case: view ppo (done)</a></li>
<li>Use Case: select patient</li>
<li><a href="{{route('ppos.explore')}}">Use Case: select ppo (done) </a></li>
<li><a href="{{route('prescriptions.create', ['ppoId'=>1,'diagnosisId'=>1])}}">Use Case: fill ppo (almost done)</a></li>
<li><a href="{{route('prescriptions.create', ['ppoId'=>1,'diagnosisId'=>1])}}">Use Case: validate prescription input (in progress)</a></li>
<li><a href="{{route('prescriptions.create', ['ppoId'=>1,'diagnosisId'=>1])}}">Use Case: save prescription (done)</a></li>
<li><a href="{{route('prescriptions.show', ['id'=>19])}}">Use Case: view prescription</a></li>
<li>Use Case: print prescription</li>
<li>Use Case: login and signup</li>
</ul>
@endsection

