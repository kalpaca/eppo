@extends('layouts.panel')
@section('title','Regimen')
@section('panelHeading','Add a New Regimen')
@section('panelBody')
{!! Form::model(new eppo\Regimen, [
    'route'=>'regimens.store',
    'class'=>'col-md-6'])
    !!}
    @include('regimens/partials/_form_body')
{!! Form::close() !!}
@endsection
