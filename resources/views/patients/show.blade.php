@extends('layouts.panel')
@section('panelHeading',$patient->fullname)
@section('panelBody')
<p class ="lead">Date of Birth: {{$patient->dob}}</h2>
<p>{!! link_to_route('ppos.explore', 'Create new Prescription', ['patientid' => $patient->id]) !!}</p>
@if(!$patient->prescriptions->count())
<p>No prescription in database.</p>
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
        </tr>
    </thead>
    <tbody>
        @foreach($patient->prescriptions as $prescription)
        <tr>
        <td>{{ $prescription->id }}</td>
        <td>{{ $prescription->regimen->code }}</td>
        <td>{{ $prescription->diagnosis->name }}</td>
        <td>{{ $prescription->author->name }}</td>
        <td>{{ $prescription->created_at }}</td>
        <td>{{ $prescription->updated_at }}</td>
        <td>
        {!! link_to_route('prescriptions.show', 'View', $prescription->id, array('class' => 'btn btn-info')) !!}
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection