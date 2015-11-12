@extends('layouts.master')
@section('title','PPO')
@section('content')
<h2>PPOs</h2>
<p>{!! link_to_route('ppos.create', 'Create PPO') !!}</p>

<div class="search">
{!! Form::model(null, ['route' => array('ppos.index'), 'class' => 'form-inline']) !!}
{!! Form::label('name','Partial regimen code or diagnosis: ',['class' => 'control-label']) !!}
{!! Form::text('name',null,['class'=>'form-control']) !!}
{!! Form::submit('Search', ['class' => 'btn btn-xs btn-primary']) !!}
{!! Form::close() !!}
</div>

@if(!$ppos->count())
<p>No PPO.</p>
@else
<table class="table">
    <thead>
        <tr>
            <th>Active</th>
            <th>#</th>
            <th>PPO Regimen</th>
            <th>PPO Diagnoses</th>
            <th>PPO Version</th>
            <th>Cycle Input</th>
            <th>Reason Input</th>
            <th>Start Date Input</th>
            <th>Created by</th>
            <th>Created Date</th>
            <th>Updated Date</th>
            <th>Open</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ppos as $ppo)
        <tr>
        <td>{{ $ppo->is_active }}</td>
        <td>{{ $ppo->id }}</td>
        <td>{{ $ppo->regimen->code }}</td>
        <td>
        @if(isset($ppo->diagnoses))
            @foreach($ppo->diagnoses as $diagnosis)
                <p>{{ $diagnosis->name }}</p>
            @endforeach
        @endif
        </td>
        <td>{{ $ppo->version }}</td>
        <td>{{ $ppo->is_cycle }}</td>
        <td>{{ $ppo->is_dose_reason }}</td>
        <td>{{ $ppo->is_start_date }}</td>
        <td>{{ $ppo->author->name }}</td>
        <td>{{ $ppo->created_at }}</td>
        <td>{{ $ppo->updated_at }}</td>
        <td>
        {!! link_to_route('ppos.show', 'View or Edit', $ppo->id, array('class' => 'btn btn-success')) !!}
        </td>
        <td>
        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('ppos.destroy', $ppo->id))) !!}
            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
        {!! Form::close() !!}
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $ppos->render() !!}
@endif
@endsection