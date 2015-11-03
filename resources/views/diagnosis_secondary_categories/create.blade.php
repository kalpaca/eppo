@extends('layouts.panel')
@section('title','Diagnosis Secondary Category')
@section('panelHeading','Add a New Diagnosis Secondary Category')
@section('panelBody')
{!! Form::model(new eppo\DiagnosisSecondaryCategory, [
    'route'=>'diagnosissecondarycategories.store',
    'class'=>'col-md-6'])
    !!}
    @include('diagnosis_secondary_categories/partials/_form_body')
{!! Form::close() !!}
@endsection
