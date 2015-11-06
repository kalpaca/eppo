@extends('layouts.master')
@section('title','LU Codes')
@section('content')
<h2>LU Codes</h2>
<p>{!! link_to_route('lucodes.create', 'Add new LU Code') !!}</p>
@if(!$lucodes->count())
<p>No data.</p>
@else
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Code</th>
            <th>Name</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lucodes as $lucode)
        <tr>
        <td>{{ $lucode->id }}</td>
        <td>{{ $lucode->code }}</td>
        <td>{{ $lucode->name }}</td>
        <td>{{ $lucode->created_at }}</td>
        <td>{{ $lucode->updated_at }}</td>
        <td>
        {!! link_to_route('lucodes.edit', 'Update', $lucode->id, array('class' => 'btn btn-info')) !!}
        </td>
        <td>
        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('lucodes.destroy', $lucode->id))) !!}
            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
        {!! Form::close() !!}
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $lucodes->render() !!}
@endif
@endsection