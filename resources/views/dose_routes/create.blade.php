@extends('layouts.panel')
@section('title','Dose Route')
@section('panelHeading','Add a New Dose Route')
@section('panelBody')
{!! Form::model(new eppo\DoseRoute, [
    'route'=>'doseroutes.store',
    'class'=>'col-md-6'])
    !!}
    @include('dose_routes/partials/_form_body')
{!! Form::close() !!}
@endsection
