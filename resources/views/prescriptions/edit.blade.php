@extends('layouts.panel')
@section('title','View prescription')
@section('panelHeading','View prescription')
@section('panelTopBar')
{!! link_to_route('prescriptions.show', 'Back to prescription', $prescription->id, array('class' => 'btn btn-default')) !!}
{!! link_to_route('patients.show', 'Back to patient', $prescription->patient_id, array('class' => 'btn btn-default')) !!}
@endsection
@section('panelBody')
{!! Form::model($prescription, [
    'method' => 'PATCH',
        'route'=>['prescriptions.update',$prescription->id],
        'class'=>'form-inline'
    ]) !!}
@include('patients/partials/patient_info_table')
@include('ppos/partials/ppo_inputs_all')
<div class="col-md-12">
{!! Form::submit('Submit', ['class' => 'btn btn-primary pull-right']) !!}
</div>
{!! Form::close() !!}
</div>
@endsection