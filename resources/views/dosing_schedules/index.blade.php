@extends('layouts.master')
@section('title','Dosing Schedules')
@section('content')
<h2>Dosing Schedules</h2>
<p>{!! link_to_route('dosingschedules.create', 'Create a new schedule') !!}</p>
@if(!$schedules->count())
<p>No data.</p>
@else
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($schedules as $schedule)
        <tr>
        <td>{{ $schedule->id }}</td>
        <td>{{ $schedule->medication }}</td>
        <td>{{ $schedule->created_at }}</td>
        <td>{{ $schedule->updated_at }}</td>
        <td>
        {!! link_to_route('dosingschedules.edit', 'Update', $schedule->id, array('class' => 'btn btn-info')) !!}
        </td>
        <td>
        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('dosingschedules.destroy', $schedule->id))) !!}
            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
        {!! Form::close() !!}
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection