<?php
// posted prescription items index by ppo item id
$index = $item->id;

$postDataIndex = 'prescriptionItems['.$index.'][';
$ppoItemIndex = 'ppo-item-'.$item->ppo_section_id .'-'. $index;
$ppoItemInput = $ppoItemIndex.'-input form-control ';
$itemLineClass = 'ppo-item-line col-md-12';
?>
<fieldset>
<div class="ppo-item clearfix" id="{{ $ppoItemIndex }}">
	<!--start: ppo item hidden input-->
	{!! Form::hidden($postDataIndex.'id]', null) !!}
	{!! Form::hidden($postDataIndex.'ppo_section_id]', $item->ppo_section_id) !!}
	{!! Form::hidden($postDataIndex.'ppo_item_id]', $item->id) !!}
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
		{!! Form::checkbox($postDataIndex.'is_selected]', null, null, ['id' => $ppoItemIndex.'-checkbox', 'class' => 'med-'.$item->medication->id . ' ppo-item-checkbox']) !!}
		{!! Form::label($postDataIndex.'is_selected]', $item->medication->name, ['class'=>'control-label']) !!}

		{{-- Formula for Percentage; Percentage and BSA --}}
		@if($item->dose_calculation_type_id == 1) {{-- Percentage --}}
			{!! Form::hidden($postDataIndex.'dose_base]', $item->dose_base) !!}
			{{ $item->dose_base . $item->doseUnit->name }} x
			{!! Form::text($postDataIndex.'dose_percentage]', null, ['class'=>$ppoItemInput.'integer-field', 'size' => 2]) !!}
			 % * =
		@elseif($item->dose_calculation_type_id == 2) {{-- Percentage and BSA --}}
			{!! Form::hidden($postDataIndex.'dose_base]', $item->dose_base) !!}
			{{ $item->dose_base . $item->doseUnit->name }}
			/m<sup>2</sup> x <span class='bsa_value'>BSA</span> x
			{!! Form::text($postDataIndex.'dose_percentage]', null, ['class'=>$ppoItemInput.'integer-field', 'size' => 2]) !!}
			 % * =
		@elseif($item->dose_calculation_type_id == 5) {{-- Base dose and then Percentage --}}
			{!! Form::text($postDataIndex.'dose_base]', null, ['class'=>$ppoItemInput.'integer-field', 'size' => 2]) !!}
			{{ $item->doseUnit->name }} x
			{!! Form::text($postDataIndex.'dose_percentage]', null, ['class'=>$ppoItemInput.'integer-field', 'size' => 2]) !!}
			 % * =
		@endif

		{{-- Percentage; Percentage and BSA; MD dose input--}}
		@if($item->dose_calculation_type_id != 4)
		{!! Form::text($postDataIndex.'dose_result]', null, ['class'=>$ppoItemInput.'decimal-field', 'size' => 6 ]) !!}
		 {{ $item->doseUnit->name }}

		{{-- Fixed dose --}}
		@elseif($item->dose_calculation_type_id == 4)
			{!! Form::hidden($postDataIndex.'dose_base]', 0) !!}
			{!! Form::hidden ( $postDataIndex.'dose_result]', $item->dose_result) !!}
		@endif

		 {{$item->instruction}}

		@if($item->is_frequency_input)
		 {!! Form::text($postDataIndex.'frequency]', null, ['class'=>$ppoItemInput, 'size' => 6]) !!}
		@endif

		@if($item->is_duration_input)
		 {!! Form::text($postDataIndex.'duration]', null, ['class'=>$ppoItemInput, 'size' => 6]) !!} days
		@endif

		@if($item->medication->instruction)
		 {{ $item->medication->instruction }}
		@endif

		@if($item->is_instruction_input)
		 {!! Form::text($postDataIndex.'instruction_input]', null, ['class'=>$ppoItemInput]) !!}
		@endif
	</div>
	<div class="{{ $itemLineClass }}">
		@if($item->is_start_date)
			{!! Form::text($postDataIndex.'start_date]', null, ['class'=>$ppoItemInput.'datepicker']) !!}
		@endif
	</div>
	<div class="{{ $itemLineClass }}">
		@if($item->is_mitte_input)
			{!! Form::label($postDataIndex.'mitte]', 'Mitte: ', ['class'=>'control-label']) !!}
			{!! Form::text($postDataIndex.'mitte]', null, ['class'=>$ppoItemInput.'decimal-field', 'size' => 4]) !!} {{ $item->mitteUnit->name }}
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		@endif

		@if($item->is_repeat_input)
			{!! Form::label($postDataIndex.'repeat]', 'Repeat: ', ['class'=>'control-label']) !!}
			{!! Form::text($postDataIndex.'repeat]', null, ['class'=>$ppoItemInput.'integer-field', 'size' => 4]) !!}
		@endif
	</div>
	<div class="{{ $itemLineClass }}">
	<?php $lucodes = $item->lucodes->lists('detail','id'); ?>
		@if(count($lucodes)>0)
    	{!! Form::label($postDataIndex.'lucode_id]','LU Code: ',['class' => 'control-label']) !!}
    	{!! Form::select($postDataIndex.'lucode_id]', $lucodes, null, ['class'=>'form-control width_100_percent']) !!}
		@endif
	</div>
	<div class="col-md-12">
		{{-- TO DO: implement user role --}}
		@if( isset($isAdminView) && $isAdminView )
		{!! link_to_route('ppoitems.edit', 'Update', $item->id, array('class' => 'btn btn-xs btn-primary')) !!}
		@endif
	</div>
</div>
</fieldset>
