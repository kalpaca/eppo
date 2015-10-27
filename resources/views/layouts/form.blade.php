@extends('layouts.master')
@section('content')
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <span class="lead">@yield('formTitle')</span>
    </div>
    <div class="panel-body">
    @yield('formContent')
    </div>
</div>
@endsection