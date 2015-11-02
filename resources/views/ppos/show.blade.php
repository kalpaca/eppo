@extends('layouts.form')
@section('title',$ppo->name)
@section('formTitle','PPO Admin View')
@section('formContent')
<div class="form-inline">
    @include('ppos/partials/ppo_inputs_all')
</div>
@endsection