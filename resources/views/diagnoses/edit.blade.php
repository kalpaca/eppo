@extends('layouts.form')
@section('title','Diagnosis')
@section('formTitle','Edit a Diagnosis')
@section('formContent')
{!! Form::model($diagnosis, [
        'method' => 'PATCH',
        'route'=>['diagnoses.update',
        $diagnosis->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('diagnoses/partials/_form_body')
{!! Form::close() !!}
@endsection
