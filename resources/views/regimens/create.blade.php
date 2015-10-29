@extends('layouts.form')
@section('title','Regimen')
@section('formTitle','Add a New Regimen')
@section('formContent')
{!! Form::model(new eppo\Regimen, [
    'route'=>'regimens.store',
    'class'=>'col-md-6'])
    !!}
    @include('regimens/partials/_form_body')
{!! Form::close() !!}
@endsection
