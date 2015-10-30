@extends('layouts.form')
@section('title','PPO Items')
@section('formTitle','Add a New PPO Item')
@section('formContent')
{!! Form::model(new eppo\PpoItem, [
    'route'=>'ppoitems.store',
    'class'=>'col-md-12 form-inline'])
    !!}
    @include('ppo_items/partials/_form_body')
{!! Form::close() !!}
@endsection
