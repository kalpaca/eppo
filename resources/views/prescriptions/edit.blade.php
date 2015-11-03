@extends('layouts.panel')
@section('title','View prescription')
@section('panelHeading','View prescription')
@section('panelBody')
{!! Form::model($prescription, [
    'method' => 'PATCH',
        'route'=>['prescriptions.update',$prescription->id],
        'class'=>'form-inline'
    ]) !!}
@include('ppos/partials/ppo_inputs_all')
<div class="col-md-12">
{!! Form::submit('Submit', ['class' => 'btn btn-primary pull-right']) !!}
</div>
{!! Form::close() !!}
</div>
@endsection