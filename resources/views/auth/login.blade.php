@extends('layouts.panel')
@section('title','Login')
@section('panelHeading','Login')
@section('panelBody')
<form method="POST" action="/auth/login" class='col-md-4 col-md-offset-4'>
    {!! csrf_field() !!}

    <div class="form-group">
        Email
        <input type="email" name="email" value="{{ old('email') }}" class="form-control">
    </div>

    <div class="form-group">
        Password
        <input type="password" name="password" id="password" class="form-control">
    </div>

    <div class="form-group">
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary pull-right">Login</button>
    </div>
</form>
@endsection
