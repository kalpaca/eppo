@extends('layouts.form')
@section('title','LU Code')
@section('formTitle','Edit a LU Code')
@section('formContent')
{!! Form::model($lucode, [
        'method' => 'PATCH',
        'route'=>['lucodes.update',
        $lucode->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('lucodes/partials/_form_body')
{!! Form::close() !!}
@endsection
