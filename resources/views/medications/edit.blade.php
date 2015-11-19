@extends('layouts.panel')
@section('title','Medication')
@section('panelHeading','Edit a Medication')
@section('panelBody')
{!! Form::model($medication, [
        'method' => 'PATCH',
        'route'=>['medications.update',
        $medication->id],
        'role'=>'form',
        'class'=>'col-md-6'
    ]) !!}
    @include('medications/partials/_form_body')
{!! Form::close() !!}
@endsection
