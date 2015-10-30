@extends('layouts.master')
@section('title','PPO Items')
@section('content')
<h2>PPO Items</h2>
<p>{!! link_to_route('ppoitems.create', 'Create a new PPO item') !!}</p>
@if(!$items->count())
<p>No data.</p>
@else
    <div class='form-inline'>
        @foreach($items as $item)
            @include('ppo_items/partials/ppo_item_admin_view')
        @endforeach
    </div>
@endif
@endsection