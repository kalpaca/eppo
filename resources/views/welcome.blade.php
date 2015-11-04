@extends('layouts.master')
@section('title','ePPO')
@section('content')

<p>Welcome, currently ePPO is under construction.</p>
<p>you can check navbar <a href="/about">About</a> link to learn more about this application.</p>

<p>GitHub: <a href="https://github.com/kalpaca/eppo">click here</a></p>

<h3>To Do List</h3>
<ul class="list-group">
<li class="list-group-item"><a href="{{route('ppos.create')}}">Use Case: build a ppo (almost done)</a></li>
<li class="list-group-item"><a href="{{route('ppoitems.create')}}">Use Case: add dosing schedule to a ppo (almost done)</a></li>
<li class="list-group-item"><a href="{{route('ppos.show',['id'=>1])}}">Use Case: view a ppo (done)</a></li>
<li class="list-group-item"><a href="{{route('patients.show',['id'=>2])}}">Use Case: select a patient (done)</a></li>
<li class="list-group-item"><a href="{{route('ppos.explore')}}">Use Case: select a ppo (done) </a></li>
<li class="list-group-item"><a href="{{route('prescriptions.create', ['ppoId'=>1,'diagnosisId'=>1])}}">Use Case: fill a ppo (almost done)</a></li>
<li class="list-group-item"><a href="{{route('prescriptions.create', ['ppoId'=>1,'diagnosisId'=>1])}}">Use Case: validate a prescription input (in progress)</a></li>
<li class="list-group-item"><a href="{{route('prescriptions.create', ['ppoId'=>1,'diagnosisId'=>1])}}">Use Case: save a prescription (done)</a></li>
<li class="list-group-item"><a href="{{route('prescriptions.show', ['id'=>19])}}">Use Case: view a prescription (almost done)</a></li>
<li class="list-group-item">Use Case: print prescription</li>
<li class="list-group-item">Use Case: login and signup</li>
</ul>
@endsection

