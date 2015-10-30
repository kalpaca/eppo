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
            <div class="col-md-12 margin_bottom_10 bs-callout">
                @include('partials/ppo_item_inputs')    
                <div class="col-md-12">
                    <small>Schedule #</small>
                    <span>{{ $item->id }}</span>
                    <small>PPO ID</small>
                    <span>{{ $item->ppo_id }}</span> - 
                    <span>{!! link_to_route('ppos.show', $item->ppo->name, $item->ppo_id, array('class' => '')) !!}</span> - 
                    <span>{{ $item->ppoSection->name }}</span>
                </div>
                <div class="col-md-12 margin_bottom_10">
                
                    <small>Created at</small>
                    <span>{{ $item->created_at }}</span>
                    <small>Updated at</small>
                    <span>{{ $item->updated_at }}</span>
                </div>
                <div class="col-md-12 margin_bottom_10">
                {!! link_to_route('ppoitems.edit', 'Update', $item->id, array('class' => 'btn btn-xs btn-primary')) !!}
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection