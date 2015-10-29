@extends('layouts.master')
@section('title','Dose Routes')
@section('content')
<h2>Dose Routes</h2>
<p>{!! link_to_route('doseroutes.create', 'Create a route') !!}</p>
@if(!$routes->count())
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
        @foreach($routes as $route)
        <tr>
        <td>{{ $route->id }}</td>
        <td>{{ $route->name }}</td>
        <td>{{ $route->created_at }}</td>
        <td>{{ $route->updated_at }}</td>
        <td>
        {!! link_to_route('doseroutes.edit', 'Update', $route->id, array('class' => 'btn btn-info')) !!}
        </td>
        <td>
        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('doseroutes.destroy', $route->id))) !!}
            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
        {!! Form::close() !!}
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection