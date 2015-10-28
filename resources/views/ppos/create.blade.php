@extends('layouts.form')
@section('title','ppo')
@section('formTitle','Add a New PPO')
@section('formContent')
{!! Form::model(new App\ppo, [
    'route'=>'ppos.store',
    'class'=>'col-md-6'])
    !!}
    @include('ppos/partials/_form_body')
{!! Form::close() !!}
@endsection
