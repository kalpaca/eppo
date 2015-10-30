<?php
$index = isset($index)? $index : 0;
$modelIndex = 'PrescriptionItem.'.$index.'.';

$mutualExClass = 'mutualEx-' . $item->ppoSection->name . $item->medication_id;

$spanClass = 'ppo-item-detail '.$item->ppoSection->name . $index;
$itemLineClass = $spanClass.' col-md-12 margin_bottom_10';
$itemStartLineClass = 'start-'.$spanClass.' col-md-12 margin_bottom_10';
?>
<fieldset>
<div class="ppo-item clearfix" id="{{ $item->ppoSection->name.$index.'Div' }}">
	<!--start: ppo item hidden input-->
	{!! Form::hidden($modelIndex.'id', null) !!}
	{!! Form::hidden($modelIndex.'ppo_section_id', $item->ppoSection->id) !!}
	{!! Form::hidden($modelIndex.'ppo_item_id', $item->id) !!}
	{!! Form::hidden($modelIndex.'medication_id', $item->medication->id) !!}
	{!! Form::hidden($modelIndex.'medication_name', $item->medication->name) !!}
	{!! Form::hidden($modelIndex.'medication_instruction', $item->medication->instruction) !!}
	{!! Form::hidden($modelIndex.'is_duration_input', $item->is_duration_input) !!}
	{!! Form::hidden($modelIndex.'is_frequency_input', $item->is_frequency_input) !!}
	{!! Form::hidden($modelIndex.'is_mitte_input', $item->is_mitte_input) !!}
	{!! Form::hidden($modelIndex.'is_repeat_input', $item->is_repeat_input) !!}
	{!! Form::hidden($modelIndex.'is_start_date', $item->is_start_input) !!}
	{!! Form::hidden($modelIndex.'is_instruction_input', $item->is_instruction_input) !!}
	<!--end: ppo item hidden input-->
	<div class="{{ $itemStartLineClass }}">
		{!! Form::checkbox($modelIndex.'is_selected', null, null, ['class' => $mutualExClass.' ppo-item-checkbox']) !!}
		{!! Form::label($modelIndex.'is_selected', $item->medication->name, ['class'=>'control-label']) !!} 
		<span class = "{{ $spanClass }}"> 
			
			@if($item->dose_calculation_type_id == 1) {{-- Percentage --}}
				{{ $item->dose_base . $item->doseUnit->name }} x 
				{!! Form::text($modelIndex.'dose_percentage', null, ['class'=>'form-control integer-field', 'size' => 2]) !!}
				 % * = 
			@elseif($item->dose_calculation_type_id == 2) {{-- Percentage and BSA --}}
				{{ $item->dose_base . $item->doseUnit->name }}
				/m<sup>2</sup> x <span class='bsa_value'>BSA</span> x 
				{!! Form::text($modelIndex.'dose_percentage', null, ['class'=>'form-control integer-field', 'size' => 2]) !!}
				 % * = 		
			@elseif($item->dose_calculation_type_id == 4) {{-- Fixed dose --}}
				{{ $item->dose_base . $item->doseUnit->name }}
				{!! Form::hidden ( $modelIndex.'dose_result', $fixed_dose_result) !!}
			@endif
			{!! Form::text($modelIndex.'dose_result', null, ['class'=>'form-control decimal-field', 'size' => 6 ]) !!}
			 {{ $item->doseUnit->name . $item->instruction }}
		</span>

		@if($item->is_frequency_input)
			<span class = "{{ $spanClass }}"> 
				{!! Form::text($modelIndex.'frequency', null, ['class'=>'form-control', 'size' => 6]) !!} 
			</span>
		@endif

		@if($item->is_duration_input)
			<span class = "{{ $spanClass }}"> 
				{!! Form::text($modelIndex.'duration', null, ['class'=>'form-control', 'size' => 6]) !!} days	
			</span>
		@endif

		@if($item->medication->instruction)
			<span class = "{{ $spanClass }}"> 
				{{ $item->medication->instruction }}
			</span>
		@endif

		@if($item->is_instruction_input)
			<span class = "{{ $spanClass }}"> 
				{!! Form::text($modelIndex.'instruction_input', null, ['class'=>'form-control']) !!}	
			</span>
		@endif
	</div>	
	<div class="{{ $itemLineClass }}">
		@if($item->is_start_date)
			<span class = "{{ $spanClass }}"> 
				{!! Form::text($modelIndex.'start_date', null, ['class'=>'datetimepicker form-control']) !!}
			</span>
		@endif
	</div>	 
	<div class="{{ $itemLineClass }}">	
		@if($item->is_mitte_input)
			{!! Form::label($modelIndex.'mitte', 'Mitte: ', ['class'=>'control-label']) !!}
			{!! Form::text($modelIndex.'mitte', null, ['class'=>'form-control decimal-field', 'size' => 4]) !!} {{ $item->mitteUnit->name }}	
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		@endif
		
		@if($item->is_repeat_input)
			{!! Form::label($modelIndex.'repeat', 'Repeat: ', ['class'=>'control-label']) !!}
			{!! Form::text($modelIndex.'repeat', null, ['class'=>'form-control integer-field', 'size' => 4]) !!}
		@endif
	</div>
</div>
</fieldset>
