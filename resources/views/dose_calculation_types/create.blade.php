@extends('layouts.form')
@section('title','Dose Calculation Type')
@section('formTitle','Add a New Dose Calculation Type')
@section('formContent')
{!! Form::model(new App\DoseCalculationType, [
    'route'=>'dosecalculationtypes.store',
    'class'=>'col-md-6'])
    !!}
    @include('dose_calculation_types/partials/_form_body')
{!! Form::close() !!}
@endsection
