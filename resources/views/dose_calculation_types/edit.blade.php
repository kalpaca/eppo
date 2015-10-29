@extends('layouts.form')
@section('title','Dose Calculation Type')
@section('formTitle','Edit a Dose Calculation Type')
@section('formContent')
{!! Form::model($type, [
        'method' => 'PATCH',
        'route'=>['dosecalculationtypes.update',
        $type->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('dose_calculation_types/partials/_form_body')
{!! Form::close() !!}
@endsection
