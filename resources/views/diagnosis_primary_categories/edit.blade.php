@extends('layouts.panel')
@section('title','Diagnosis Primary Category')
@section('panelHeading','Edit a Diagnosis Primary Category')
@section('panelBody')
{!! Form::model($diagnosisPrimaryCategory, [
        'method' => 'PATCH',
        'route'=>['diagnosisprimarycategories.update',
        $diagnosisPrimaryCategory->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('diagnosis_primary_categories/partials/_form_body')
{!! Form::close() !!}
@endsection
