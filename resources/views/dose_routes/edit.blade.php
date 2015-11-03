@extends('layouts.panel')
@section('title','Dose Routes')
@section('panelHeading','Edit a Dose Route')
@section('panelBody')
{!! Form::model($route, [
        'method' => 'PATCH',
        'route'=>['doseroutes.update',
        $route->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('dose_routes/partials/_form_body')
{!! Form::close() !!}
@endsection
