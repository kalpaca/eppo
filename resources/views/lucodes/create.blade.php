@extends('layouts.form')
@section('title','LU Code')
@section('formTitle','Add a New LU Code')
@section('formContent')
{!! Form::model(new eppo\Lucode, [
    'route'=>'lucodes.store',
    'class'=>'col-md-6'])
    !!}
    @include('lucodes/partials/_form_body')
{!! Form::close() !!}
@endsection
