@extends('layouts.form')
@section('title','PPO Item')
@section('formTitle','PPO Admin View')
@section('formContent')
<div class="form-inline">
    @include('ppos/partials/ppo_inputs_head')
    @include('ppos/partials/ppo_inputs_rx')
    @include('ppos/partials/ppo_inputs_tail')
    @include('ppos/partials/ppo_inputs_suppotive_rx')
    </div>
</div>
@endsection