@extends('layouts.form')
@section('title','Medication')
@section('formTitle','Edit a Medication')
@section('formContent')
{!! Form::model($medication, [
        'method' => 'PATCH',
        'route'=>['medications.update',
        $medication->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('medications/partials/_form_body');
{!! Form::close() !!}
@endsection
