@extends('layouts.master')
@section('content')
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <span class="lead">@yield('panelHeading')</span>
        <span class="pull-right btn-group">@yield('panelTopBar')</span>
    </div>
    <div class="panel-body">
    @yield('panelBody')
    </div>
</div>
@endsection