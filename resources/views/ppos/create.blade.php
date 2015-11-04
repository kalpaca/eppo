@extends('layouts.panel')
@section('title','ppo')
@section('panelHeading','Add a New PPO')
@section('panelBody')
{!! Form::model(new eppo\Ppo, [
    'route'=>'ppos.store',
    'class'=>'col-md-6'])
    !!}
    @include('ppos/partials/_form_body')
{!! Form::close() !!}
@endsection
