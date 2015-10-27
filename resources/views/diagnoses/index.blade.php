@extends('layouts.master')
@section('title','Diagnoses')
@section('content')
<h2>Diagnoses</h2>
<p>{!! link_to_route('diagnoses.create', 'Create Diagnosis') !!}</p>
@if(!$diagnoses->count())
<p>No diagnosis in database.</p>
@else
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Secondary Cat.</th>
            <th>Priamry Cat.</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($diagnoses as $diagnosis)
        <tr>
        <td>{{ $diagnosis->id }}</td>
        <td>{{ $diagnosis->name }}</td>
        <td>{{ $diagnosis->secondaryCat->name}}</td>
        <td>{{ $diagnosis->primaryCat->name}}</td>
        <td>{{ $diagnosis->created_at }}</td>
        <td>{{ $diagnosis->updated_at }}</td>
        <td>
        {!! link_to_route('diagnoses.edit', 'Update', $diagnosis->id, array('class' => 'btn btn-info')) !!}
        </td>
        <td>
        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('diagnoses.destroy', $diagnosis->id))) !!}
            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
        {!! Form::close() !!}
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection