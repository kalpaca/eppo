@extends('layouts.form')
@section('title','Mitte Unit')
@section('formTitle','Edit a Mitte Unit')
@section('formContent')
{!! Form::model($unit, [
        'method' => 'PATCH',
        'route'=>['mitteunits.update',
        $unit->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('mitte_units/partials/_form_body')
{!! Form::close() !!}
@endsection
