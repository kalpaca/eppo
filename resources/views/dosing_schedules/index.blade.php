@extends('layouts.master')
@section('title','Dosing Schedules')
@section('content')
<h2>Dosing Schedules</h2>
<p>{!! link_to_route('dosingschedules.create', 'Create a new schedule') !!}</p>
@if(!$schedules->count())
<p>No data.</p>
@else
    <div class='form-inline'>
        @foreach($schedules as $schedule)
            <div class="col-md-12 margin_bottom_10 bs-callout">
                @include('partials/ppo_item')    
                <div class="col-md-12">
                    <small>Schedule #</small>
                    <span>{{ $schedule->id }}</span>
                    <small>PPO ID</small>
                    <span>{{ $schedule->ppo_id }}</span> - 
                    <span>{!! link_to_route('ppos.show', $schedule->ppo->name, $schedule->ppo_id, array('class' => '')) !!}</span> - 
                    <span>{{ $schedule->ppoSection->name }}</span>
                </div>
                <div class="col-md-12 margin_bottom_10">
                
                    <small>Created at</small>
                    <span>{{ $schedule->created_at }}</span>
                    <small>Updated at</small>
                    <span>{{ $schedule->updated_at }}</span>
                </div>
                <div class="col-md-12 margin_bottom_10">
                {!! link_to_route('dosingschedules.edit', 'Update', $schedule->id, array('class' => 'btn btn-xs btn-primary')) !!}
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection