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
            {{ $item->dose_result }} {{ $item->doseUnit->name }} {{ $item->instruction }}

        @elseif($item->dose_calculation_type_id == 2) {{-- Percentage and BSA --}}
            {{ $item->dose_base }} {{ $item->doseUnit->name }}/m<sup>2</sup> x <span class='bsa_value'>BSA</span> x {{ $item->dose_percentage }} % * =
            {{ $item->dose_result }} {{ $item->doseUnit->name }} {{ $item->instruction }}

        @elseif($item->dose_calculation_type_id == 3) {{-- Fill in blank --}}
            {{ $item->dose_result }} {{ $item->doseUnit->name }} {{ $item->instruction }}

        @elseif($item->dose_calculation_type_id == 4) {{-- Fixed --}}
            {{ $item->instruction }}

        @elseif($item->dose_calculation_type_id == 5) {{-- Base and Percentage --}}
            {{ $item->dose_base }} {{ $item->doseUnit->name }} x {{ $item->dose_percentage }} % * =
            {{ $item->dose_result }} {{ $item->doseUnit->name }} {{ $item->instruction }}
        @endif
        {{-- Fixed dose or MD input dose --}}


        @if($item->is_frequency_input)
            {{ $item->frequency }}
        @endif

        @if($item->is_duration_input)
            {{ $item->duration }} days
        @endif

        @if($item->medication_common_instruction)
            {{ $item->medication_common_instruction }}
        @endif

        @if($item->is_instruction_input)
            {{ $item->instruction_input }}
        @endif
    </div>
    @if($item->note_to_md)
    <div class="{{ $itemLineClass }}">
        <strong>Note to MD: </strong> {{ $item->note_to_md }}
    </div>
    <div class="{{ $itemLineClass }}">
            Start date: {{ $item->start_date }}
    </div>
    @endif
    <div class="{{ $itemLineClass }}">
        @if($item->is_mitte_input)
            Mitte: {{ $item->mitte }} {{ $item->mitteUnit->name }}
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @endif

        @if($item->is_repeat_input)
            Repeat: {{ $item->repeat }}
        @endif
    </div>
    @if($item->is_eap_approval)
    <div class="{{ $itemLineClass }}">
        @if($item->is_eap_approval)
            <span class="unicode-checkbox">&#x2611;</span>EAP Approved
        @endif
    </div>
    @endif
    @if($item->is_rev_aid_enrolled)
    <div class="{{ $itemLineClass }}">
        @if($item->is_rev_aid_enrolled)
            <span class="unicode-checkbox">&#x2611;</span>Enrolled in RevAid
        @endif
    </div>
    @endif
    <div class="{{ $itemLineClass }}">
        @if($item->lucode_id)
            LU Code: {{$item->lucode->code}} {{$item->lucode->name}}
        @endif
    </div>
</div>

