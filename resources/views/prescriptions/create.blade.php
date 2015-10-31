@extends('layouts.form')
@section('title',$ppo->name)
@section('formTitle','Create new prescription')
@section('formContent')
{!! Form::model(new eppo\prescription, [
        'route'=>'prescriptions.store',
        'class'=>'form-inline'
    ]) !!}
    @include('ppos/partials/ppo_inputs_head')
    @include('ppos/partials/ppo_inputs_rx')
    @include('ppos/partials/ppo_inputs_suppotive_rx')
    @include('ppos/partials/ppo_inputs_tail')
{!! Form::close() !!}
</div>
@endsection