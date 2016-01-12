@extends('layouts.master')
@section('title','About')
@section('content')
<div class="jumbotron">
  <div class="container">
    <h1>ePPO</h1>
    <p>Pre-Printed Orders for Take-Home Chemotherapy</p>
    <p>Developed by Steven Song Wang</p><p>Powered by Laravel, Bootstrap and JQuery frameworks</p>
    <a href="https://github.com/swangxyz/eppo" class="btn btn-primary">GitHub</a></p>
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
         take to a pharmacy to dispense medications. This tool also simplifies the process of choosing a PPO based on  diagnoses.</p>
        <hr>

        <h3>Demo User name: </h3>
        <p>For ordinary user as a physician, you can just create your own account. or use this one</p>
        <p><code>username: test2@gmail.com</code></p>
        <p><code>password: testtest</code></p>
        <p>Admin demo account:</p>
        <p><code>username: test@gmail.com</code></p>
        <p><code>password: testtest</code></p>
        <hr>

        <h3>License</h3>
        <p>ePPO is open-sourced software licensed under the MIT license</p>
        <hr>

        <h3>Disclaimer</h3>
        <p>This application works on IE browser version >= 8, Safari version > 5.1 and other "evergreen" updated browsers.</p>
        <p>This database is not endorsed or approved by the any organizations. </p>
        <p>I cannot be held liable for any problems caused by its content.</p>
        <p>Please refer to the CancerCare Ontario and related authorities for additional information.</p>
        <hr>


    </div>
</div>
@endsection


