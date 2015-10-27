@extends('layouts.form')
@section('title','Regimen')
@section('formTitle','Edit a Regimen')
@section('formContent')
{!! Form::model($regimen, [
        'method' => 'PATCH',
        'route'=>['regimens.update',
        $regimen->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('regimens/partials/_form_body');
{!! Form::close() !!}
@endsection
