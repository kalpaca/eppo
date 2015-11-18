<?php $patient = $prescription->patient; ?>
@extends('layouts.panel')
@section('title','View prescription')
@section('panelHeading','View prescription')
@section('panelTopBar')
@if(!$prescription->is_void || !$prescription->is_final)
{!! link_to_route('prescriptions.edit', 'Edit', $prescription->id, array('class' => 'btn btn-default')) !!}
@endif
{!! link_to_route('prescriptions.index', 'Back to Worklist', $prescription->author->id, array('class' => 'btn btn-default')) !!}
{!! link_to_route('patients.show', 'Back to Patient', $prescription->patient_id, array('class' => 'btn btn-default')) !!}
@endsection
@section('panelBody')
<!-- Patient information -->
@include('patients/partials/patient_info_table')
<!-- Watermark -->
<div id="background">
    <p id="bg-text" class="text-center">
    @if($prescription->is_void)
    Void
    @elseif(!$prescription->is_final){{--if NOT finalized--}}
    Draft
    @elseif($prescription->is_final)
    Final
    @endif
    </p>
</div>
<!-- Allergies -->
<table class="table table-bordered prescription-allergies">
<tbody>
<tr>
    <td class="col-md-12">
    <strong>Allergies: </strong>
    @if($prescription->is_allergies)
        {{$prescription->allergies}}
    @elseif($prescription->is_allergies_unknown)
        Unknown
    @elseif(!$prescription->is_allergies)
        No known allergies
    @endif
    </td>
</tr>
</tbody>
</table>
<!-- Regimen and diagnosis and cycle information -->
<table class="table table-bordered prescription-protocol">
<tbody>
<tr>
    <td class="col-md-6">
        <p><strong>Regimen: </strong><span class="regimen-code">{{ $prescription->regimen->code }}</span></p>
        <p class="regimen-name">{{ $prescription->regimen->name }}</p>

        <p><strong>Diagnosis: </strong>

        <span class="diagnosis-name"><strong>{{ $prescription->diagnosis->name }}</strong></span>
        </p>
    </td>
    <td class="col-md-6">
        @if($prescription->is_cycle)
        <div class="prescription-cycle">
            <strong>Cycle #: </strong>{{$prescription->cycle_id}}; Cycle repeats every {{ $prescription->cycle_days }} days
        </div>
        @endif
        @if($prescription->is_bsa)
        <div class="prescription-bsa">
            <p><strong>Height: </strong> {{$prescription->height}} cm&nbsp;&nbsp;&nbsp;&nbsp;<strong>Weight: </strong>  {{$prescription->weight}} kg
            </p>
            <p><strong>Body Surface Area (BSA): </strong> {{$prescription->bsa}} m<sup>2</sup>
            </p>
        </div>
        @endif
    </td>
</tr>
</tbody>
</table>
<!-- chemotherapy medicaiton protocol -->
<?php $index = 0;?>
@if($rx->count()>0)
<table class="table table-bordered prescription-rx">
<tbody>
<tr>
<td class="prescription-rx col-md-12">
    <p>
        <h3>Rx
        <sub>
        @if($prescription->is_start_date)
            <strong>Start Date/Day 1: </strong>{{$prescription->start_date}}
        @endif
        </sub>
        </h3>
    </p>
    <hr>
    <div class="prescription-items">
        @foreach($rx as $item)
            @include('prescription_items/show', compact('index'))
            <?php $index++; ?>
        @endforeach
    </div>

    @if($prescription->is_dose_reason)
    <div class='prescription-dose-reasons col-md-12'>
        <h6><strong>*Dose modification reason</strong></h6>
        @foreach($prescription->reasons as $reason)
            <span class="unicode-checkbox">&#x2611;</span> {{ $reason->name }}&nbsp;&nbsp;&nbsp;&nbsp;
        @endforeach
        @if($prescription->other_dose_modification_reason)
            <span class="unicode-checkbox">&#x2611;</span> Other: {{ $prescription->other_dose_modification_reason }}&nbsp;&nbsp;&nbsp;&nbsp;
        @endif
    </div>
    @endif
</td>
</tr>
</tbody>
</table>
@endif
<!-- supportive medications protocol -->
@if($supportiveRx->count()>0)
<table class="table table-bordered prescription-supportive-rx">
<tbody>
<tr>
<td class="prescription-rx col-md-12">
    <p>
        <h3>Supportive Rx
        </h3>
    </p>
    <hr>
    <div class="prescription-items">
        @foreach($supportiveRx as $item)
            @include('prescription_items/show', compact('index'))
            <?php $index++; ?>
        @endforeach
    </div>
    </td>
</tr>
</tbody>
</table>
@endif

<table class="table table-bordered prescription-supportive-rx">
<tbody>
<!-- Doctor information -->
<tr>
<td class="md-info">
<div class="md-name col-md-6">
<label>Physician Pint Name:</label> {{$prescription->author->name}}
</div>
<div class="md-sign col-md-6">
<label>Signature:</label> _____________________
</div>
</td>
</tr>

<tr>
<!-- Prescripiton status -->
<td class="status-info">
    @if($prescription->is_void)

    <div class="status-date col-md-12">
        <label>Void Datetime:</label> {{ $prescription->final_date }}
    </div>

    @elseif(!$prescription->is_final){{--if NOT finalized--}}

    <div class="final-btn col-md-6">
        {!! Form::open(array('class' => 'form-inline', 'method' => 'post', 'route' => array('prescriptions.finalize', $prescription->id))) !!}
        <button class="btn btn-success">Finalize</button>
        {!! Form::close() !!}
    </div>


    @elseif($prescription->is_final)

    <div class="col-md-6 inline">
        {!! Form::open(array('class'=>'inline', 'method' => 'post', 'route' => array('prescriptions.finalize', $prescription->id))) !!}
        <button class="btn btn-primary">Print</button>
        {!! Form::close() !!}
    </div>
    <div class="status-date col-md-5">
        <label>Final Datetime:</label> {{ $prescription->final_date }}
    </div>
    <div class="col-md-1 inline">
        {!! Form::open(array('class'=>'inline', 'method' => 'post', 'route' => array('prescriptions.void', $prescription->id))) !!}
        <button class="btn btn-danger">Void</button>
        {!! Form::close() !!}
    </div>
    @endif
</td>
</tr>

</tbody>
</table>
@endsection
