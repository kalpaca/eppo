@extends('layouts.form')
@section('title','Dose Routes')
@section('formTitle','Edit a Dose Route')
@section('formContent')
{!! Form::model($route, [
        'method' => 'PATCH',
        'route'=>['doseroutes.update',
        $route->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('dose_routes/partials/_form_body')
{!! Form::close() !!}
@endsection
