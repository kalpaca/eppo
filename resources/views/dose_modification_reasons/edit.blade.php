@extends('layouts.form')
@section('title','Dose Modification Reason')
@section('formTitle','Edit a Dose Modification Reason')
@section('formContent')
{!! Form::model($reason, [
        'method' => 'PATCH',
        'route'=>['dosemodificationreasons.update',
        $reason->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('dose_modification_reasons/partials/_form_body')
{!! Form::close() !!}
@endsection