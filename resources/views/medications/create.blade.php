@extends('layouts.panel')
@section('title','Medication')
@section('panelHeading','Add a New Medication')
@section('panelBody')
{!! Form::model(new eppo\Medication, [
    'route'=>'medications.store',
    'role'=>'form',
    'class'=>'col-md-6'])
    !!}
    @include('medications/partials/_form_body')
{!! Form::close() !!}
@endsection
