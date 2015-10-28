<?php
$isCycle = isset($ppo->is_cycle) ? $ppo->is_cycle : true;
$isReason = isset($ppo->is_reason) ? $ppo->is_reason : true;
$isStartDate = isset($ppo->is_start_date) ? $ppo->is_start_date : true;
?>

<div class="form-group">
    {!! Form::label('regimen_id','Regimen: ',['class' => 'control-label']) !!}
    {!! Form::select('regimen_id',$regimens, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('diagnoses[]','Diagnoses: ',['class' => 'control-label']) !!}
    {!! Form::select('diagnoses[]',$diagnoses, null, ['class'=>'form-control','multiple'=>'multiple']) !!}
</div>

<div class="form-group">
    {!! Form::label('version','Version: ',['class' => 'control-label']) !!}
    {!! Form::text('version', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::checkbox('is_cycle', $isCycle, $isCycle) !!}
    {!! Form::label('is_cycle','Show cycle infomation input ', ['class' => 'control-label']) !!}
</div>

<div class="form-group">
    {!! Form::checkbox('is_reason', $isReason, $isReason) !!}
    {!! Form::label('is_reason','Show Dose modification reasons selection ', ['class' => 'control-label']) !!}
</div>

<div class="form-group">
    {!! Form::checkbox('is_start_date', $isStartDate, $isStartDate) !!}
    {!! Form::label('is_start_date','Show start date input ', ['class' => 'control-label']) !!}
</div>

{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}