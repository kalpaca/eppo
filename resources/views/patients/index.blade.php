@extends('layouts.master')
@section('title','Patients')
@section('content')
<h2>Patients</h2>
<p>{!! link_to_route('patients.create', 'Create patient') !!}</p>
@if(!$patients->count())
<p>You have no patient</p>
@else
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Date of Birth</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>View</th>
        </tr>
    </thead>
    <tbody>
        @foreach($patients as $patient)
        <tr>
        <td>{{ $patient->id }}</td>
        <td>{{ $patient->name }}</td>
        <td>{{ $patient->dob }}</td>
        <td>{{ $patient->created_at }}</td>
        <td>{{ $patient->updated_at }}</td>
        <td>
        {!! link_to_route('patients.show', 'View', $patient->id, array('class' => 'btn btn-success')) !!}
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection