@extends('layouts.form')
@section('title','Diagnosis Secondary Category')
@section('formTitle','Edit a Diagnosis Secondary Category')
@section('formContent')
{!! Form::model($diagnosisSecondaryCategory, [
        'method' => 'PATCH',
        'route'=>['diagnosissecondarycategories.update',
        $diagnosisSecondaryCategory->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('diagnosis_secondary_categories/partials/_form_body');
{!! Form::close() !!}
@endsection