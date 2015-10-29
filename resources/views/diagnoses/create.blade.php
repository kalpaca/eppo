@extends('layouts.form')
@section('title','Diagnosis')
@section('formTitle','Add a New Diagnosis')
@section('formContent')

{!! Form::model(new eppo\Diagnosis, [
    'route'=>'diagnoses.store',
    'class'=>'col-md-6'])
    !!}
@include('diagnoses/partials/_form_body')
{!! Form::close() !!}

@endsection