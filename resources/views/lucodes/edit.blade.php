@extends('layouts.panel')
@section('title','LU Code')
@section('panelHeading','Edit a LU Code')
@section('panelBody')
{!! Form::model($lucode, [
        'method' => 'PATCH',
        'role'=>'form',
        'route'=>['lucodes.update',
        $lucode->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('lucodes/partials/_form_body')
{!! Form::close() !!}
@endsection
