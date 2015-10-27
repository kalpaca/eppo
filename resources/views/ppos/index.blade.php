<!-- Stored in resources/views/child.blade.php -->
@extends('layouts.master')
@section('title','PPO Index')
@section('content')
<h2>PPOs</h2>
@if(!$ppos->count())
<p>You have no ppo</p>
@else
<table class="table">
    <thead>
        <tr>
            <th>Active</th>
            <th>#</th>
            <th>PPO Regimen</th>
            <th>PPO Diagnoses</th>
            <th>PPO Version</th>
            <th>Created Date</th>
            <th>Modified Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ppos as $ppo)
        <tr>
        <td>{{ $ppo->is_active }}</td>
        <td>{{ $ppo->id }}</td>
        <td>{{ $ppo->regimen }}</td>
        <td></td>
        <td>{{ $ppo->version }}</td>
        <td>{{ $ppo->created_at }}</td>
        <td>{{ $ppo->updated_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection