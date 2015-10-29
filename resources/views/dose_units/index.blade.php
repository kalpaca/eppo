@extends('layouts.master')
@section('title','Dose Units')
@section('content')
<h2>Dose Units</h2>
<p>{!! link_to_route('doseunits.create', 'Create new unit') !!}</p>
@if(!$units->count())
<p>You have no dose units.</p>
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
        @foreach($units as $unit)
        <tr>
        <td>{{ $unit->id }}</td>
        <td>{{ $unit->name }}</td>
        <td>{{ $unit->created_at }}</td>
        <td>{{ $unit->updated_at }}</td>
        <td>
        {!! link_to_route('doseunits.edit', 'Update', $unit->id, array('class' => 'btn btn-info')) !!}
        </td>
        <td>
        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('doseunits.destroy', $unit->id))) !!}
            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
        {!! Form::close() !!}
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection