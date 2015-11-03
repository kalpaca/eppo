@extends('layouts.panel')
@section('title','Dose Unit')
@section('panelHeading','Edit a Dose Unit')
@section('panelBody')
{!! Form::model($unit, [
        'method' => 'PATCH',
        'route'=>['doseunits.update',
        $unit->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('dose_units/partials/_form_body')
{!! Form::close() !!}
@endsection
