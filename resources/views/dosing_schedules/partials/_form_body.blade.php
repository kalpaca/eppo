<?php
$isActive = isset($schedule->is_active) ? $schedule->is_active : true;
$isMitteInput = isset($schedule->is_mitte_reason) ? $schedule->is_mitte_reason : true;
$isRepeatInput = isset($schedule->is_repeat_input) ? $schedule->is_repeat_input : true;
$defaultSelection = [''=>'Please Select'];
$medications = $defaultSelection + $medications->toArray();
$ppos = $defaultSelection + $ppos->toArray();
?>
<div class="form-group col-md-6">
    {!! Form::hidden('is_active', false) !!}
    {!! Form::checkbox('is_active', null, $isActive) !!}
    {!! Form::label('is_active','Active for ppo ', ['class' => 'control-label']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::label('medication_id','Medication: ',['class' => 'control-label']) !!}
    {!! Form::select('medication_id',$medications, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::label('ppo_id','PPO: ',['class' => 'control-label']) !!}
    {!! Form::select('ppo_id', $ppos, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::label('ppo_section_id','PPO section: ',['class' => 'control-label']) !!}
    {!! Form::select('ppo_section_id',$ppoSections, null, ['class'=>'form-control']) !!}
</div>
<div class="col-md-12">
<hr>
</div>
<div class="col-md-6">

<div class="form-group clearfix">
    {!! Form::label('dose_calculation_type_id','Dose Calculation Type: ',['class' => 'control-label']) !!}
    {!! Form::select('dose_calculation_type_id',$doseCalculationTypes, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group width_100_percent">
    {!! Form::label('dose_base','Dose Base (for % or BSA): ',['class' => 'control-label']) !!}
    {!! Form::text('dose_base', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group width_100_percent">
    {!! Form::label('fixed_dose_result','Dose Result (if fixed): ',['class' => 'control-label']) !!}
    {!! Form::text('fixed_dose_result', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group width_100_percent">
    {!! Form::label('dose_unit_id','Dose Unit: ',['class' => 'control-label']) !!}
    {!! Form::select('dose_unit_id',$doseUnits, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group width_100_percent hidden">
    {!! Form::label('dose_route_id','Dose Route: ',['class' => 'control-label']) !!}
    {!! Form::select('dose_route_id',$doseRoutes, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group width_100_percent">
    {!! Form::label('instruction','Fixed Instruction: ',['class' => 'control-label width_100_percent']) !!}
    {!! Form::textarea('instruction', null, ['class'=>'form-control width_100_percent', 'rows'=>"3"]) !!}
</div>
</div>

<div class="form-group col-md-6">
    {!! Form::hidden('is_instruction_input', false) !!}
    {!! Form::checkbox('is_instruction_input', null) !!}
    {!! Form::label('is_instruction_input','Show MD additional input ', ['class' => 'control-label']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::hidden('is_start_date', false) !!}
    {!! Form::checkbox('is_start_date', null) !!}
    {!! Form::label('is_start_date','Show start date input ', ['class' => 'control-label']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::hidden('is_frequency_input', false) !!}
    {!! Form::checkbox('is_frequency_input', null) !!}
    {!! Form::label('is_frequency_input','Show frequency input ', ['class' => 'control-label']) !!}
</div>


<div class="form-group col-md-6">
    {!! Form::hidden('is_duration_input', false) !!}
    {!! Form::checkbox('is_duration_input', null) !!}
    {!! Form::label('is_duration_input','Show duration input ', ['class' => 'control-label']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::hidden('is_mitte_input', false) !!}
    {!! Form::checkbox('is_mitte_input', null, $isMitteInput) !!}
    {!! Form::label('is_mitte_input','Show mitte input ', ['class' => 'control-label']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::hidden('is_repeat_input', false) !!}
    {!! Form::checkbox('is_repeat_input', null, $isRepeatInput) !!}
    {!! Form::label('is_repeat_input','Show repeat input ', ['class' => 'control-label']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::label('mitte_unit_id','Mitte Unit: ',['class' => 'control-label']) !!}
    {!! Form::select('mitte_unit_id', $mitteUnits, null, ['class'=>'form-control']) !!}
</div>

<div class="col-md-12">
{!! Form::submit('Submit', ['class' => 'btn btn-primary pull-right']) !!}
</div>
