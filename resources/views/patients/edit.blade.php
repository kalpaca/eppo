@extends('layouts.panel')
@section('title','Patient')
@section('panelHeading','Edit a Patient')
@section('panelBody')
{!! Form::model($patient, [
        'method' => 'PATCH',
        'route'=>['patients.update',
        $patient->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('patients/partials/_form_body')
{!! Form::close() !!}
@endsection
