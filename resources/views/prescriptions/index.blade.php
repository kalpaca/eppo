@extends('layouts.master')
@section('title','Prescriptions')
@section('content')
<h2>Prescriptions</h2>
<p>{!! link_to_route('patients.index', 'Select patient to create new prescription') !!}</p>
@if(!$prescriptions->count())
<p>You have no prescription</p>
@else
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Regimen</th>
            <th>Diagnosis</th>
            <th>Created by</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>View</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($prescriptions as $prescription)
        <tr>
        <td>{{ $prescription->id }}</td>
        <td>{{ $prescription->regimen->code }}</td>
        <td>{{ $prescription->diagnosis->name }}</td>
        <td>{{ $prescription->author->name }}</td>
        <td>{{ $prescription->created_at }}</td>
        <td>{{ $prescription->updated_at }}</td>
        <td>
        {!! link_to_route('prescriptions.show', 'View', $prescription->id, array('class' => 'btn btn-success')) !!}
        </td>
        <td>
        {!! link_to_route('prescriptions.edit', 'Update', $prescription->id, array('class' => 'btn btn-info')) !!}
        </td>
        <td>
        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('prescriptions.destroy', $prescription->id))) !!}
            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
        {!! Form::close() !!}
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $prescriptions->render() !!}
@endif
@endsection