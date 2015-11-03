@extends('layouts.form')
@section('title','View prescription')
@section('formTitle','View prescription')
@section('formContent')
<?php
$ppo = $prescription->ppo;
?>

<table class="table table-bordered ppo-allergies">
<tbody>
<tr>
    <td class="col-md-12">
    <strong>Allergies: </strong>
    @if($prescription->is_allergies)
        {{$prescription->allergies}}
    @elseif(!$prescription->is_allergies)
        No allergies
    @elseif(!$prescription->is_allergies_unknown)
        Unknown
    @endif
    </td>
</tr>
</tbody>
</table>

<table class="table table-bordered ppo-protocol">
<tbody>
<tr>
    <td class="col-md-6">
        <p><strong>Regimen: </strong><span class="regimen-code">{{ $ppo->regimen->code }}</span></p>
        <p class="regimen-name">{{ $ppo->regimen->name }}</p>

        <p><strong>Diagnosis: </strong>
        @if(isset($diagnosis))
            <span class="diagnosis-name"><strong>{{ $diagnosis->name }}</strong></span>
        @else
            </p>
            @foreach($ppo->diagnoses as $diagnosis)
                <p class="diagnosis-name"><strong>{{ $diagnosis->name }}</strong></p>
            @endforeach
        @endif
    </td>
    <td class="col-md-6">
        @if($ppo->is_cycle)
        <div class="ppo-cycle">
            <strong>Cycle #: </strong>{{$prescription->cycle_id}}; Cycle repeats every {{ $prescription->cycle_days }} days
        </div>
        @endif
        @if($ppo->is_bsa)
        <div class="ppo-bsa">
            <p>
                <strong>Height: </strong> {{$prescription->height}} cm&nbsp;&nbsp;&nbsp;&nbsp;<strong>Weight: </strong> kg
            </p>
            <p>
                <strong>Body Surface Area (BSA): </strong> {{$prescription->bsa}} m<sup>2</sup>
            </p>
        </div>
        @endif
    </td>
</tr>
</tbody>
</table>

<?php $index = 0;?>
@if($rx->count()>0)
<table class="table table-bordered ppo-rx">
<tbody>
<tr>
<td class="ppo-rx col-md-12">
    <p>
        <h3>Rx
        <sub>
        @if($prescription->is_start_date)
            <strong>Start Date/Day 1: </strong>$prescription->start_date
        @endif
        </sub>
        </h3>
    </p>
    <hr>
    <div class="ppo-items">
        @foreach($rx as $item)
            @include('prescription_items/show', compact('index'))
            <?php $index++; ?>
        @endforeach
    </div>

    @if($prescription->is_dose_reason)
    <div class='ppo-dose-reasons col-md-12'>
        <h6><strong>*Dose modification reason</strong></h6>
        @foreach($ppo->reasons as $reason)
            <span class="unicode-checkbox">&#x2611;</span> {{ $reason->name }}&nbsp;&nbsp;&nbsp;&nbsp;
        @endforeach
    </div>
    @endif
</td>
</tr>
</tbody>
</table>
@endif
@if($suppotiveRx->count()>0)
<table class="table table-bordered ppo-rx">
<tbody>
<tr>
<td class="ppo-rx col-md-12">
    <p>
        <h3>Supportive Rx
        </h3>
    </p>
    <hr>
    <div class="ppo-items">
        @foreach($suppotiveRx as $item)
            @include('prescription_items/show', compact('index'))
            <?php $index++; ?>
        @endforeach
    </div>
    </td>
</tr>
</tbody>
</table>
@endif
@endsection