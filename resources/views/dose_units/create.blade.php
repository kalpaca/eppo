@extends('layouts.form')
@section('title','Dose Unit')
@section('formTitle','Add a New Dose Unit')
@section('formContent')
{!! Form::model(new eppo\DoseUnit, [
    'route'=>'doseunits.store',
    'class'=>'col-md-6'])
    !!}
    @include('dose_units/partials/_form_body')
{!! Form::close() !!}
@endsection
