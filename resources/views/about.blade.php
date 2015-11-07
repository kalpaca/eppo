@extends('layouts.master')
@section('title','About')
@section('content')
<div class="jumbotron">
  <div class="container">
    <h1>ePPO</h1>
    <p>Pre-Printed Orders for Take-Home Chemotherapy</p>
    <p>Developed by Steven Song Wang</p><p>Powered by Laravel, Bootstrap and JQuery frameworks</p>
    <a href="https://github.com/kalpaca/eppo" class="btn btn-primary">GitHub</a></p>
  </div>
</div>
<div class="container">
    <div class="col-md-12">
        <div><img src="{{asset('img/workflow.jpg')}}" class="img-responsive center-block"></div>
        <h3>Description</h3>

        <p>"<a href="https://www.cancercare.on.ca/toolbox/drugformulary/pre_printed_orders/" target="_blank">CancerCare Ontario PrePrinted Orders (PPOs)</a> are protocol-specific forms that simplify and standardize the prescribing process. CancerCare Ontario pre-printed order forms for take-home chemotherapy prescriptions may reduce dosing, transcription and omission errors related to handwritten and verbal take-home chemotherapy orders. "</p>
        <p>Health information administrators can use this tool to build such PPOs, which allow end users like
         Oncologists/Hematologists and Nurse Practitioners to make chemotherapy regimen prescriptions
         and customize the combo of medications based on the actual situation, for the patient to
         take to a pharmacy to dispense medications. Also, This tool also simplify the process of choosing a PPO based on  diagnoses.</p>
        <hr>

        <h3>License</h3>

        <p>ePPO is open-sourced software licensed under the MIT license</p>
        <hr>
        <h3>To Do List</h3>
        <ul class="list-group">
        <li class="list-group-item"><a href="{{route('ppos.create')}}">Use Case: build a ppo (almost done)</a></li>
        <li class="list-group-item"><a href="{{route('ppoitems.create')}}">Use Case: add dosing schedule to a ppo (almost done)</a></li>
        <li class="list-group-item"><a href="{{route('ppos.show',['id'=>1])}}">Use Case: view a ppo (done)</a></li>
        <li class="list-group-item"><a href="{{route('patients.show',['id'=>2])}}">Use Case: select a patient (done)</a></li>
        <li class="list-group-item"><a href="{{route('ppos.explore',['id'=>1])}}">Use Case: select a ppo (done) </a></li>
        <li class="list-group-item"><a href="{{route('prescriptions.create', ['ppoId'=>1,'diagnosisId'=>1])}}">Use Case: fill a ppo (almost done)</a></li>
        <li class="list-group-item">Use Case: validate a prescription input (in progress)</li>
        <li class="list-group-item">Use Case: save a prescription (done)</li>
        <li class="list-group-item"><a href="{{route('prescriptions.show', ['id'=>19])}}">Use Case: view a prescription (almost done)</a></li>
        <li class="list-group-item">Use Case: print prescription</li>
        <li class="list-group-item">Use Case: login and signup (in progress)</li>
        </ul>
    </div>
</div>
@endsection

