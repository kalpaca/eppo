@extends('layouts.master')
@section('title','Diagnosis Secondary Categories')
@section('content')
<h2>Diagnosis Secondary Categories</h2>
<p>{!! link_to_route('diagnosissecondarycategories.create', 'Create Category') !!}</p>
@if(!$cats->count())
<p>You have no diagnosis secondary categories.</p>
@else
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Priamry Cat.</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cats as $cat)
        <tr>
        <td>{{ $cat->id }}</td>
        <td>{{ $cat->name }}</td>
        <td>{{ $cat->primaryCat->name}}</td>
        <td>{{ $cat->created_at }}</td>
        <td>{{ $cat->updated_at }}</td>
        <td>
        {!! link_to_route('diagnosissecondarycategories.edit', 'Update', $cat->id, array('class' => 'btn btn-info')) !!}
        </td>
        <td>
        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('diagnosissecondarycategories.destroy', $cat->id))) !!}
            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
        {!! Form::close() !!}
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection