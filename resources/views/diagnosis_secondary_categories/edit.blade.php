@extends('layouts.panel')
@section('title','Diagnosis Secondary Category')
@section('panelHeading','Edit a Diagnosis Secondary Category')
@section('panelBody')
{!! Form::model($diagnosisSecondaryCategory, [
        'method' => 'PATCH',
        'route'=>['diagnosissecondarycategories.update',
        $diagnosisSecondaryCategory->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('diagnosis_secondary_categories/partials/_form_body')
{!! Form::close() !!}
@endsection