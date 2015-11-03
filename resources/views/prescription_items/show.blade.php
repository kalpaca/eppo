<?php
$index = isset($index)? $index : 0;
$ppoItemIndex = 'ppo-item-'.$item->ppo_section_id .'-'. $index;
$itemLineClass = 'ppo-item-line col-md-12';
?>
<div class="ppo-item clearfix" id="{{ $ppoItemIndex }}">
    <div class="{{ $itemLineClass }}">
        <span class="unicode-checkbox">&#x2611; </span><strong>{{ $item->medication->name }}</strong>

        @if($item->dose_calculation_type_id == 1) {{-- Percentage --}}
            {{ $item->dose_base }} {{ $item->doseUnit->name }} x {{ $item->dose_percentage }} % * =
        @elseif($item->dose_calculation_type_id == 2) {{-- Percentage and BSA --}}
            {{ $item->dose_base }} {{ $item->doseUnit->name }}/m<sup>2</sup> x <span class='bsa_value'>BSA</span> x {{ $item->dose_percentage }} % * =
        @endif
        {{-- Fixed dose or MD input dose --}}
        {{ $item->dose_result }} {{ $item->doseUnit->name }} {{ $item->instruction }}

        @if($item->is_frequency_input)
            {{ $item->frequency }}
        @endif

        @if($item->is_duration_input)
            {{ $item->duration }} days
        @endif

        @if($item->medication->instruction)
            {{ $item->medication->instruction }}
        @endif

        @if($item->is_instruction_input)
            {{ $item->instruction_input }}
        @endif
    </div>
    <div class="{{ $itemLineClass }}">
        @if($item->is_start_date)
            $item->start_date
        @endif
    </div>
    <div class="{{ $itemLineClass }}">
        @if($item->is_mitte_input)
            Mitte: {{ $item->mitte }} {{ $item->mitteUnit->name }}
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @endif

        @if($item->is_repeat_input)
            Repeat: {{ $item->repeat }}
        @endif
    </div>
</div>

