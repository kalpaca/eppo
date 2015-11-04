@extends('layouts.master')
@section('title','About')
@section('content')
<div class="jumbotron">
  <div class="container">
    <h1>ePPO</h1>
    <p>Pre-Printed Orders for Take-Home Chemotherapy</p>
    <p>Developed by Steven Song Wang</p>
  </div>
</div>
<div class="container">
    <div class="col-md-12">
        <h3>Summary</h3>

        <p>This tool is made for Oncologists/Hematologists and Nurse Practitioners to enter, per the CancerCare Ontario PrePrinted Orders (PPOs) , prescribed medications based on disease, regimen for the patient to take to a pharmacy to dispense medications. Also a health information administrator can build a "combo" of medications based on chemotherapy regimen and diagosis, which allows end user to quickly determine a colletion of medications and make customization based on actual situation.
        </p>

        <h3>What are PrePrinted Orders (PPOs)?</h3>

        <a herf="https://www.cancercare.on.ca/cms/one.aspx?portalId=1377&pageId=322076">Check this page</a>

        <h3>License</h3>

        <p>ePPO is open-sourced software licensed under the MIT license</p>
    </div>
</div>
@endsection

