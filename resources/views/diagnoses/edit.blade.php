@extends('layouts.panel')
@section('title','Diagnosis')
@section('panelHeading','Edit a Diagnosis')
@section('panelBody')
{!! Form::model($diagnosis, [
        'method' => 'PATCH',
        'route'=>['diagnoses.update',
        $diagnosis->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('diagnoses/partials/_form_body')
{!! Form::close() !!}
@endsection
