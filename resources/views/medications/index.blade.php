@extends('layouts.master')
@section('title','Medications')
@section('content')
<h2>Medications</h2>
<p>{!! link_to_route('medications.create', 'Add a New Medication') !!}</p>

<div class="search">
{!! Form::model(null, ['route' => array('medications.index'), 'class' => 'form-inline']) !!}
{!! Form::label('name','Medication Name: ',['class' => 'control-label']) !!}
{!! Form::text('name',null,['class'=>'form-control']) !!}
{!! Form::submit('Search', ['class' => 'btn btn-xs btn-primary']) !!}
{!! Form::close() !!}
</div>

@if(!$medications->count())
<p>No medication.</p>
@else
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Detail</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($medications as $medication)
        <tr>
        <td>{{ $medication->id }}</td>
        <td>{{ $medication->name }}</td>
        <td>{{ $medication->created_at }}</td>
        <td>{{ $medication->updated_at }}</td>
        <td>
        {!! link_to_route('medications.show', 'Detail', $medication->id, array('class' => 'btn btn-info')) !!}
        </td>
        <td>
        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('medications.destroy', $medication->id))) !!}
            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
        {!! Form::close() !!}
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $medications->render() !!}
@endif
@endsection