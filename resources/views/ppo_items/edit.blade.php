@extends('layouts.form')
@section('title','PPO Items')
@section('formTitle','Edit a PPO Items')
@section('formContent')
{!! Form::model($item, [
        'method' => 'PATCH',
        'route'=>['ppoitems.update',
        $item->id],
        'class'=>'form-inline'
    ]) !!}
    @include('ppo_items/partials/_form_body')
{!! Form::close() !!}
@endsection
