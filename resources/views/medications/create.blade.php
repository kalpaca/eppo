@extends('layouts.form')
@section('title','Medication')
@section('formTitle','Add a New Medication')
@section('formContent')
{!! Form::model(new App\Medication, [
    'route'=>'medications.store',
    'class'=>'col-md-6'])
    !!}
    @include('medications/partials/_form_body')
{!! Form::close() !!}
@endsection
