@extends('layouts.master')
@section('title','Dose Calculation Types')
@section('content')
<h2>Dose Calculation Types</h2>
<p>{!! link_to_route('dosecalculationtypes.create', 'Create a new type') !!}</p>
@if(!$types->count())
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
        @foreach($types as $type)
        <tr>
        <td>{{ $type->id }}</td>
        <td>{{ $type->name }}</td>
        <td>{{ $type->created_at }}</td>
        <td>{{ $type->updated_at }}</td>
        <td>
        {!! link_to_route('dosecalculationtypes.edit', 'Update', $type->id, array('class' => 'btn btn-info')) !!}
        </td>
        <td>
        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('dosecalculationtypes.destroy', $type->id))) !!}
            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
        {!! Form::close() !!}
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection