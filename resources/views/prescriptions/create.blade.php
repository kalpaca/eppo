@extends('layouts.form')
@section('title',$ppo->name)
@section('formTitle','Create new prescription')
@section('formContent')
{!! Form::model(new eppo\Prescription, [
        'route'=>'prescriptions.store',
        'class'=>'form-inline'
    ]) !!}
@include('ppos/partials/ppo_inputs_all')
<div class="col-md-12">
	{!! Form::submit('Submit', ['class' => 'btn btn-primary pull-right']) !!}
</div>

{!! Form::close() !!}
</div>
@endsection