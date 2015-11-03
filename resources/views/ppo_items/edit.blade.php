@extends('layouts.panel')
@section('title','PPO Items')
@section('panelHeading','Edit a PPO Items')
@section('panelBody')
{!! Form::model($item, [
        'method' => 'PATCH',
        'route'=>['ppoitems.update',
        $item->id],
        'class'=>'form-inline'
    ]) !!}
    @include('ppo_items/partials/_form_body')
{!! Form::close() !!}
@endsection
