@extends('layouts.panel')
@section('title','Diagnosis Primary Category')
@section('panelHeading','Add a New Diagnosis Primary Category')
@section('panelBody')
{!! Form::model(new eppo\DiagnosisPrimaryCategory, [
    'route'=>'diagnosisprimarycategories.store',
    'class'=>'col-md-6'])
    !!}
    @include('diagnosis_primary_categories/partials/_form_body')
{!! Form::close() !!}
@endsection
