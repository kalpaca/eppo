@extends('layouts.panel')
@section('title','Diagnosis')
@section('panelHeading','Add a New Diagnosis')
@section('panelBody')

{!! Form::model(new eppo\Diagnosis, [
    'route'=>'diagnoses.store',
    'class'=>'col-md-6'])
    !!}
@include('diagnoses/partials/_form_body')
{!! Form::close() !!}

@endsection