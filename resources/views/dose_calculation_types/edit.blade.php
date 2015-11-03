@extends('layouts.panel')
@section('title','Dose Calculation Type')
@section('panelHeading','Edit a Dose Calculation Type')
@section('panelBody')
{!! Form::model($type, [
        'method' => 'PATCH',
        'route'=>['dosecalculationtypes.update',
        $type->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('dose_calculation_types/partials/_form_body')
{!! Form::close() !!}
@endsection
