@extends('layouts.form')
@section('title','Dose Modification Reasons')
@section('formTitle','Add a NewDose Modification Reason')
@section('formContent')
{!! Form::model(new eppo\DiagnosisPrimaryCategory, [
    'route'=>'dosemodificationreasons.store',
    'class'=>'col-md-6'])
    !!}
    @include('dose_modification_reasons/partials/_form_body')
{!! Form::close() !!}
@endsection
