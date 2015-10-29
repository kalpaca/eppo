@extends('layouts.master')
@section('title','Dose Modification Reasons')
@section('content')
<h2>Dose Modification Reasons</h2>
<p>{!! link_to_route('dosemodificationreasons.create', 'Create a Dose Modification Reason') !!}</p>
@if(!$reasons->count())
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
        @foreach($reasons as $reason)
        <tr>
        <td>{{ $reason->id }}</td>
        <td>{{ $reason->name }}</td>
        <td>{{ $reason->created_at }}</td>
        <td>{{ $reason->updated_at }}</td>
        <td>
        {!! link_to_route('dosemodificationreasons.edit', 'Update', $reason->id, array('class' => 'btn btn-info')) !!}
        </td>
        <td>
        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('dosemodificationreasons.destroy', $reason->id))) !!}
            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
        {!! Form::close() !!}
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
@endsection