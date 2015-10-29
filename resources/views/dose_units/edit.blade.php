@extends('layouts.form')
@section('title','Dose Unit')
@section('formTitle','Edit a Dose Unit')
@section('formContent')
{!! Form::model($unit, [
        'method' => 'PATCH',
        'route'=>['doseunits.update',
        $unit->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('dose_units/partials/_form_body')
{!! Form::close() !!}
@endsection
