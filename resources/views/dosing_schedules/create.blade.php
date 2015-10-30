@extends('layouts.form')
@section('title','Dosing Schedules')
@section('formTitle','Add a New Dosing Schedule')
@section('formContent')
{!! Form::model(new eppo\DosingSchedule, [
    'route'=>'dosingschedules.store',
    'class'=>'col-md-12 form-inline'])
    !!}
    @include('dosing_schedules/partials/_form_body')
{!! Form::close() !!}
@endsection
