<?php
$index = isset($index)? $index : 0;
$postDataIndex = 'prescriptionItems['.$index.'][';
$ppoItemIndex = 'ppo-item-'.$item->ppo_section_id .'-'. $index;
$itemLineClass = 'ppo-item-line col-md-12';
?>
<fieldset>
<div class="ppo-item clearfix" id="{{ $ppoItemIndex }}">
	<!--start: ppo item hidden input-->
	{!! Form::hidden($postDataIndex.'id]', null) !!}
	{!! Form::hidden($postDataIndex.'ppo_section_id]', $item->ppoSection->id) !!}
	{!! Form::hidden($postDataIndex.'ppo_item_id]', $item->id) !!}
	{!! Form::hidden($postDataIndex.'dose_base]', $item->dose_base) !!}
	{!! Form::hidden($postDataIndex.'dose_unit_id]', $item->dose_unit_id) !!}
	{!! Form::hidden($postDataIndex.'mitte_unit_id]', $item->mitte_unit_id) !!}
	{!! Form::hidden($postDataIndex.'dose_calculation_type_id]', $item->dose_calculation_type_id) !!}
	{!! Form::hidden($postDataIndex.'dose_route_id]', $item->dose_route_id) !!}
	{!! Form::hidden($postDataIndex.'medication_id]', $item->medication->id) !!}
	{!! Form::hidden($postDataIndex.'medication_name]', $item->medication->name) !!}
	{!! Form::hidden($postDataIndex.'medication_common_instruction]', $item->medication->instruction) !!}
	{!! Form::hidden($postDataIndex.'instruction]', $item->instruction) !!}
	{!! Form::hidden($postDataIndex.'is_duration_input]', $item->is_duration_input) !!}
	{!! Form::hidden($postDataIndex.'is_frequency_input]', $item->is_frequency_input) !!}
	{!! Form::hidden($postDataIndex.'is_mitte_input]', $item->is_mitte_input) !!}
	{!! Form::hidden($postDataIndex.'is_repeat_input]', $item->is_repeat_input) !!}
	{!! Form::hidden($postDataIndex.'is_start_date]', $item->is_start_input) !!}
	{!! Form::hidden($postDataIndex.'is_instruction_input]', $item->is_instruction_input) !!}
	<!--end: ppo item hidden input-->
	<div class="{{ $itemLineClass }}">
		{!! Form::hidden($postDataIndex.'is_selected]', false) !!}
		{!! Form::checkbox($postDataIndex.'is_selected]', null, null, ['class' => 'mutualEx-' . $ppoItemIndex .' ppo-item-checkbox']) !!}
		{!! Form::label($postDataIndex.'is_selected]', $item->medication->name, ['class'=>'control-label']) !!}

		@if($item->dose_calculation_type_id == 1) {{-- Percentage --}}
			{{ $item->dose_base . $item->doseUnit->name }} x
			{!! Form::text($postDataIndex.'dose_percentage]', null, ['class'=>'form-control integer-field', 'size' => 2]) !!}
			 % * =
		@elseif($item->dose_calculation_type_id == 2) {{-- Percentage and BSA --}}
			{{ $item->dose_base . $item->doseUnit->name }}
			/m<sup>2</sup> x <span class='bsa_value'>BSA</span> x
			{!! Form::text($postDataIndex.'dose_percentage]', null, ['class'=>'form-control integer-field', 'size' => 2]) !!}
			 % * =
		@elseif($item->dose_calculation_type_id == 4) {{-- Fixed dose --}}
			{{ $item->dose_base . $item->doseUnit->name }}
			{!! Form::hidden ( $postDataIndex.'dose_result]', $fixed_dose_result) !!}
		@endif
		{{-- MD dose input--}}
		{!! Form::text($postDataIndex.'dose_result]', null, ['class'=>'form-control decimal-field', 'size' => 6 ]) !!}
		 {{ $item->doseUnit->name . $item->instruction }}


		@if($item->is_frequency_input)
			{!! Form::text($postDataIndex.'frequency]', null, ['class'=>'form-control', 'size' => 6]) !!}
		@endif

		@if($item->is_duration_input)
			{!! Form::text($postDataIndex.'duration]', null, ['class'=>'form-control', 'size' => 6]) !!} days
		@endif

		@if($item->medication->instruction)
			{{ $item->medication->instruction }}
		@endif

		@if($item->is_instruction_input)
			{!! Form::text($postDataIndex.'instruction_input]', null, ['class'=>'form-control']) !!}
		@endif
	</div>
	<div class="{{ $itemLineClass }}">
		@if($item->is_start_date)
			{!! Form::text($postDataIndex.'start_date]', null, ['class'=>'datetimepicker form-control']) !!}
		@endif
	</div>
	<div class="{{ $itemLineClass }}">
		@if($item->is_mitte_input)
			{!! Form::label($postDataIndex.'mitte]', 'Mitte: ', ['class'=>'control-label']) !!}
			{!! Form::text($postDataIndex.'mitte]', null, ['class'=>'form-control decimal-field', 'size' => 4]) !!} {{ $item->mitteUnit->name }}
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		@endif

		@if($item->is_repeat_input)
			{!! Form::label($postDataIndex.'repeat]', 'Repeat: ', ['class'=>'control-label']) !!}
			{!! Form::text($postDataIndex.'repeat]', null, ['class'=>'form-control integer-field', 'size' => 4]) !!}
		@endif
	</div>
	<div class="col-md-12">
		{{-- TO DO: implement user role --}}
		{!! link_to_route('ppoitems.edit', 'Update', $item->id, array('class' => 'btn btn-xs btn-primary')) !!}
	</div>
</div>
</fieldset>
