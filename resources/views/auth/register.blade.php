@extends('layouts.panel')
@section('title','Register')
@section('panelHeading','Register')
@section('panelBody')
<form method="POST" action="/auth/register" class='col-md-4 col-md-offset-4'>
    {!! csrf_field() !!}

    <div class="form-group">
        Your full name
        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
    </div>

    <div class="form-group">
        Email
        <input type="email" name="email" value="{{ old('email') }}" class="form-control">
    </div>

    <div class="form-group">
        Password
        <input type="password" name="password" class="form-control">
    </div>

    <div class="form-group">
        Confirm Password
        <input type="password" name="password_confirmation" class="form-control">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary pull-right">Register</button>
    </div>
</form>
@endsection
