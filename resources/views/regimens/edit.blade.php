@extends('layouts.panel')
@section('title','Regimen')
@section('panelHeading','Edit a Regimen')
@section('panelBody')
{!! Form::model($regimen, [
        'method' => 'PATCH',
        'route'=>['regimens.update',
        $regimen->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('regimens/partials/_form_body')
{!! Form::close() !!}
@endsection
