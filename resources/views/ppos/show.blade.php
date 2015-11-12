@extends('layouts.panel')
@section('title',$ppo->name)
@section('panelHeading','PPO Admin View')
@section('panelBody')
<div class="form-inline">
    @include('ppos/partials/ppo_inputs_all')
</div>
@endsection
@section('panelTopBar')
{!! link_to_route('ppos.edit', 'Edit', $ppo->id, array('class' => 'btn btn-default')) !!}
@endsection