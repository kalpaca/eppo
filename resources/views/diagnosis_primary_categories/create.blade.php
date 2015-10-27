@extends('layouts.form')
@section('title','Diagnosis Primary Category')
@section('formTitle','Add a New Diagnosis Primary Category')
@section('formContent')
{!! Form::model(new App\DiagnosisPrimaryCategory, [
    'route'=>'diagnosisprimarycategories.store',
    'class'=>'col-md-6'])
    !!}
    @include('diagnosis_primary_categories/partials/_form_body');
{!! Form::close() !!}
@endsection
