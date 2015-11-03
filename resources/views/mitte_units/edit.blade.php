@extends('layouts.panel')
@section('title','Mitte Unit')
@section('panelHeading','Edit a Mitte Unit')
@section('panelBody')
{!! Form::model($unit, [
        'method' => 'PATCH',
        'route'=>['mitteunits.update',
        $unit->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('mitte_units/partials/_form_body')
{!! Form::close() !!}
@endsection
