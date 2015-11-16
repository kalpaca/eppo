<?php $patient = $prescription->patient; ?>
@extends('layouts.panel')
@section('title','View prescription')
@section('panelHeading','View prescription')
@section('panelTopBar')
{!! link_to_route('prescriptions.edit', 'Edit', $prescription->id, array('class' => 'btn btn-default')) !!}
{!! link_to_route('patients.show', 'Back to patient', $prescription->patient_id, array('class' => 'btn btn-default')) !!}
@endsection
@section('panelBody')

@include('patients/partials/patient_info_table')

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
<tr>
<td class="md-info">
<div class="md-name col-md-4">
<label>Physician Pint Name:</label> {{$prescription->author->name}}
</div>
<div class="md-sign col-md-4">
<label>Signature:</label> _____________________
</div>
<div class="md-date col-md-4">
<label>Date:</label> <?php echo date("F d, Y, g:i a");?>
</div>
</td>
</tr>
</tbody>
</table>
@endsection
