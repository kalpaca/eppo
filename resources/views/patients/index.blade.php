@extends('layouts.master')
@section('title','Patients')
@section('content')
<h2>Patients</h2>
<p>{!! link_to_route('patients.create', 'Create patient') !!}</p>

<div class="search">
{!! Form::model(null, ['route' => array('patients.index'), 'class' => 'form-inline']) !!}
{!! Form::label('name','Patient name: ',['class' => 'control-label']) !!}
{!! Form::text('fullname',null,['class'=>'form-control']) !!}
{!! Form::submit('Search', ['class' => 'btn btn-xs btn-primary']) !!}
{!! Form::close() !!}
</div>

@if(!$patients->count())
<p>No patient.</p>
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
            <th>New Prescription</th>
        </tr>
    </thead>
    <tbody>
        @foreach($patients as $patient)
        <tr>
        <td>{{ $patient->id }}</td>
        <td>{{ $patient->fullname }}</td>
        <td>{{ $patient->dob }}</td>
        <td>{{ $patient->created_at }}</td>
        <td>{{ $patient->updated_at }}</td>
        <td>
        {!! link_to_route('patients.show', 'View', $patient->id, array('class' => 'btn btn-success')) !!}
        </td>
        <td>
        {!! link_to_route('ppos.explore', 'Select', ['patientid' => $patient->id], array('class' => 'btn btn-primary')) !!}
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $patients->render() !!}
@endif
@endsection