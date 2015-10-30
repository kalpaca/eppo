<?php
$index = isset($index)? $index : 0;
$modelIndex = 'PrescriptionItem.'.$index.'.';

$section = $schedule->ppoSection->name;
$mutualExClass = 'mutualEx-' . $section . $schedule->medication_id;
$spanClass = 'ppo-item-detail '.$section . $index;
$itemLineClass = $spanClass.' col-md-12 margin_bottom_10';
$itemFirstLineClass = 'start-'.$spanClass.' col-md-12 margin_bottom_10';
?>
<fieldset>
<div class="ppo-item clearfix" id="{{ $section.$index.'Div' }}">

	{!! Form::hidden($modelIndex.'id', null) !!}
	{!! Form::hidden($modelIndex.'ppo_section_id', $schedule->ppoSection->id) !!}
	{!! Form::hidden($modelIndex.'dosing_schedule_id', $schedule->id) !!}
	{!! Form::hidden($modelIndex.'medication_id', $schedule->medication->id) !!}
	{!! Form::hidden($modelIndex.'medication_name', $schedule->medication->name) !!}
	{!! Form::hidden($modelIndex.'medication_instruction', $schedule->medication->instruction) !!}
	{!! Form::hidden($modelIndex.'is_duration_input', $schedule->is_duration_input) !!}
	{!! Form::hidden($modelIndex.'is_frequency_input', $schedule->is_frequency_input) !!}
	{!! Form::hidden($modelIndex.'is_mitte_input', $schedule->is_mitte_input) !!}
	{!! Form::hidden($modelIndex.'is_repeat_input', $schedule->is_repeat_input) !!}
	{!! Form::hidden($modelIndex.'is_start_date', $schedule->is_start_input) !!}
	{!! Form::hidden($modelIndex.'is_instruction_input', $schedule->is_instruction_input) !!}

	<div class="{{ $itemFirstLineClass }}">
		{!! Form::checkbox($modelIndex.'is_selected', null, null, ['class' => $mutualExClass.' schedule-checkbox']) !!}
		{!! Form::label($modelIndex.'is_selected', $schedule->medication->name, ['class'=>'control-label']) !!} 
		<span class = "{{ $spanClass }}"> 
			
			@if($schedule->dose_calculation_type_id == 1) {{-- Percentage --}}
				{{ $schedule->dose_base }} {{ $schedule->doseUnit->name }} x 
				{!! Form::text($modelIndex.'dose_percentage', null, ['class'=>'form-control integer-field', 'size' => 2]) !!}
				 % * = 
			@elseif($schedule->dose_calculation_type_id == 2) {{-- Percentage and BSA --}}
				{{ $schedule->dose_base }} {{ $schedule->doseUnit->name }}
				/m<sup>2</sup> x <span class='bsa_value'>BSA</span> x 
				{!! Form::text($modelIndex.'dose_percentage', null, ['class'=>'form-control integer-field', 'size' => 2]) !!}
				 % * = 		
			@elseif($schedule->dose_calculation_type_id == 4) {{-- Fixed dose --}}
				{{ $schedule->dose_base }} {{ $schedule->doseUnit->name }}
				{!! Form::hidden ( $modelIndex.'dose_result', $fixed_dose_result) !!}
			@endif
			{!! Form::text($modelIndex.'dose_result', null, ['class'=>'form-control decimal-field', 'size' => 6 ]) !!}
			 {{ $schedule->doseUnit->name }} {{ $schedule->instruction }}


		</span>

		@if($schedule->is_frequency_input)
			<span class = "{{ $spanClass }}"> 
				{!! Form::text($modelIndex.'frequency', null, ['class'=>'form-control', 'size' => 6]) !!} 
			</span>
		@endif

		@if($schedule->is_duration_input)
			<span class = "{{ $spanClass }}"> 
				{!! Form::text($modelIndex.'duration', null, ['class'=>'form-control', 'size' => 6]) !!} days	
			</span>
		@endif

		@if($schedule->medication->instruction)
			<span class = "{{ $spanClass }}"> 
				{{ $schedule->medication->instruction }}
			</span>
		@endif

		@if($schedule->is_instruction_input)
			<span class = "{{ $spanClass }}"> 
				{!! Form::text($modelIndex.'instruction_input', null, ['class'=>'form-control']) !!}	
			</span>
		@endif
	</div>	
	<div class="{{ $itemLineClass }}">
		@if($schedule->is_start_date)
			<span class = "{{ $spanClass }}"> 
				{!! Form::text($modelIndex.'start_date', null, ['class'=>'datetimepicker form-control']) !!}
			</span>
		@endif
	</div>	 
	<div class="{{ $itemLineClass }}">	
		@if($schedule->is_mitte_input)
			{!! Form::label($modelIndex.'mitte', 'Mitte: ', ['class'=>'control-label']) !!}
			{!! Form::text($modelIndex.'mitte', null, ['class'=>'form-control decimal-field', 'size' => 4]) !!} {{ $schedule->mitteUnit->name }}	
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		@endif
		
		@if($schedule->is_repeat_input)
			{!! Form::label($modelIndex.'repeat', 'Repeat: ', ['class'=>'control-label']) !!}
			{!! Form::text($modelIndex.'repeat', null, ['class'=>'form-control integer-field', 'size' => 4]) !!}
		@endif
	</div>
</div>
</fieldset>
