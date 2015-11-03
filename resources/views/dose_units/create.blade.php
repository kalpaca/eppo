@extends('layouts.panel')
@section('title','Dose Unit')
@section('panelHeading','Add a New Dose Unit')
@section('panelBody')
{!! Form::model(new eppo\DoseUnit, [
    'route'=>'doseunits.store',
    'class'=>'col-md-6'])
    !!}
    @include('dose_units/partials/_form_body')
{!! Form::close() !!}
@endsection
