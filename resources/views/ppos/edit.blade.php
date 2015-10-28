@extends('layouts.form')
@section('title','PPO')
@section('formTitle','Edit a PPO')
@section('formContent')
{!! Form::model($ppo, [
        'method' => 'PATCH',
        'route'=>['ppos.update',
        $ppo->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('ppos/partials/_form_body')
{!! Form::close() !!}
@endsection
