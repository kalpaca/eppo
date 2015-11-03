@extends('layouts.panel')
@section('title','Mitte Unit')
@section('panelHeading','Add a New Mitte Unit')
@section('panelBody')
{!! Form::model(new eppo\MitteUnit, [
    'route'=>'mitteunits.store',
    'class'=>'col-md-6'])
    !!}
    @include('mitte_units/partials/_form_body')
{!! Form::close() !!}
@endsection
