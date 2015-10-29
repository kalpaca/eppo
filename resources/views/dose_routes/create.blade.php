@extends('layouts.form')
@section('title','Dose Route')
@section('formTitle','Add a New Dose Route')
@section('formContent')
{!! Form::model(new eppo\DoseRoute, [
    'route'=>'doseroutes.store',
    'class'=>'col-md-6'])
    !!}
    @include('dose_routes/partials/_form_body')
{!! Form::close() !!}
@endsection
