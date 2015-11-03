@extends('layouts.panel')
@section('title','Dose Calculation Type')
@section('panelHeading','Add a New Dose Calculation Type')
@section('panelBody')
{!! Form::model(new eppo\DoseCalculationType, [
    'route'=>'dosecalculationtypes.store',
    'class'=>'col-md-6'])
    !!}
    @include('dose_calculation_types/partials/_form_body')
{!! Form::close() !!}
@endsection
