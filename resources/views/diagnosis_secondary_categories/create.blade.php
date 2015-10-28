@extends('layouts.form')
@section('title','Diagnosis Secondary Category')
@section('formTitle','Add a New Diagnosis Secondary Category')
@section('formContent')
{!! Form::model(new App\DiagnosisSecondaryCategory, [
    'route'=>'diagnosissecondarycategories.store',
    'class'=>'col-md-6'])
    !!}
    @include('diagnosis_secondary_categories/partials/_form_body')
{!! Form::close() !!}
@endsection
