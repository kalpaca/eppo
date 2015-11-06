@extends('layouts.master')
@section('title','Regimens')
@section('content')
<h2>Regimens</h2>
<p>{!! link_to_route('regimens.create', 'Create Regimen') !!}</p>
@if(!$regimens->count())
<p>No regimen in database.</p>
@else
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Code</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($regimens as $regimen)
        <tr>
        <td>{{ $regimen->id }}</td>
        <td>{{ $regimen->name }}</td>
        <td>{{ $regimen->code}}</td>
        <td>{{ $regimen->created_at }}</td>
        <td>{{ $regimen->updated_at }}</td>
        <td>
        {!! link_to_route('regimens.edit', 'Update', $regimen->id, array('class' => 'btn btn-info')) !!}
        </td>
        <td>
        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('regimens.destroy', $regimen->id))) !!}
            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
        {!! Form::close() !!}
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $regimens->render() !!}
@endif
@endsection