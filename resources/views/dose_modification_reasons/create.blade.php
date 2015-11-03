@extends('layouts.panel')
@section('title','Dose Modification Reasons')
@section('panelHeading','Add a NewDose Modification Reason')
@section('panelBody')
{!! Form::model(new eppo\DiagnosisPrimaryCategory, [
    'route'=>'dosemodificationreasons.store',
    'class'=>'col-md-6'])
    !!}
    @include('dose_modification_reasons/partials/_form_body')
{!! Form::close() !!}
@endsection
