@extends('layouts.panel')
@section('title','Patient')
@section('panelHeading','Add a New Patient')
@section('panelBody')

{!! Form::model(new eppo\Patient, [
    'route'=>'patients.store',
    'class'=>'col-md-6'])
    !!}
@include('patients/partials/_form_body')
{!! Form::close() !!}

@endsection