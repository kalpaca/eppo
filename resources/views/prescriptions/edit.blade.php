@extends('layouts.form')
@section('title','View prescription')
@section('formTitle','View prescription')
@section('formContent')
<?php
$ppo = $prescription->ppo;
?>
{!! Form::model($prescription, [
    'method' => 'PATCH',
        'route'=>'prescriptions.update',
        'class'=>'form-inline'
    ]) !!}
@include('ppos/partials/ppo_inputs_all')
<div class="col-md-12">
{!! Form::submit('Submit', ['class' => 'btn btn-primary pull-right']) !!}
</div>
{!! Form::close() !!}
</div>
@endsection