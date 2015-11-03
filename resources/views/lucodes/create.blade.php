@extends('layouts.panel')
@section('title','LU Code')
@section('panelHeading','Add a New LU Code')
@section('panelBody')
{!! Form::model(new eppo\Lucode, [
    'route'=>'lucodes.store',
    'class'=>'col-md-6'])
    !!}
    @include('lucodes/partials/_form_body')
{!! Form::close() !!}
@endsection
