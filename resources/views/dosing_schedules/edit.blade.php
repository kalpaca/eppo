@extends('layouts.form')
@section('title','Dosing Schedules')
@section('formTitle','Edit a Dosing Schedules')
@section('formContent')
{!! Form::model($schedule, [
        'method' => 'PATCH',
        'route'=>['dosingschedules.update',
        $schedule->id],
        'class'=>'form-inline'
    ]) !!}
    @include('dosing_schedules/partials/_form_body')
{!! Form::close() !!}
@endsection
