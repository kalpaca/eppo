@extends('layouts.form')
@section('title','Diagnosis Primary Category')
@section('formTitle','Edit a Diagnosis Primary Category')
@section('formContent')
{!! Form::model($diagnosisPrimaryCategory, [
        'method' => 'PATCH',
        'route'=>['diagnosisprimarycategories.update',
        $diagnosisPrimaryCategory->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('diagnosis_primary_categories/partials/_form_body')
{!! Form::close() !!}
@endsection
