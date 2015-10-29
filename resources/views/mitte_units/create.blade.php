@extends('layouts.form')
@section('title','Mitte Unit')
@section('formTitle','Add a New Mitte Unit')
@section('formContent')
{!! Form::model(new eppo\MitteUnit, [
    'route'=>'mitteunits.store',
    'class'=>'col-md-6'])
    !!}
    @include('mitte_units/partials/_form_body')
{!! Form::close() !!}
@endsection
