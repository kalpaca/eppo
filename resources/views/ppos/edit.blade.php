@extends('layouts.panel')
@section('title','PPO')
@section('panelHeading','Edit a PPO')
@section('panelBody')
{!! Form::model($ppo, [
        'method' => 'PATCH',
        'role'=>'form',
        'route'=>['ppos.update',
        $ppo->id],
        'class'=>'col-md-6'
    ]) !!}
    @include('ppos/partials/_form_body')
{!! Form::close() !!}
@endsection
