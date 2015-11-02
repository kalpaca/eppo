<table class="table table-bordered ppo-rx">
<tbody>
<tr>
<td class="ppo-rx col-md-12">
    <p>
        <h3>Rx
        <sub>
        @if($ppo->is_start_date)
            {!! Form::label('start_date','Start Date/Day 1: ', ['class' => 'control-label']) !!}
            {!! Form::text('start_date', null, ['class' => 'form-control datetimepicker']) !!}
        @endif
        </sub>
        </h3>
    </p>
    <hr>
    <div class="ppo-items">
        <?php $index = 0;?>
        @foreach($ppo->ppoItems as $item)
            @if($item->ppo_section_id == 1)
                @include('ppo_items/partials/ppo_item_inputs', compact('index'))
            @endif
        @endforeach
    </div>

    @if($ppo->is_dose_reason)
    <div class='ppo-dose-reasons col-md-12'>
        <h6><strong>*Dose modification reason</strong></h6>
        @foreach($ppo->reasons as $reason)
            {!! Form::checkbox('reasons[]', $reason->id, null) !!}
            {!! Form::label('is_reason',$reason->name, ['class' => 'control-label']) !!}
        @endforeach
    </div>
    @endif
</td>
</tr>
</tbody>
</table>