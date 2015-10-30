<table class="table table-bordered ppo-allergies">
<tbody>
<tr>
    <td class="col-md-12">
    {!! Form::label('is_allergies','Allergies ', ['class' => 'control-label']) !!}
    {!! Form::radio('is_allergies',null) !!}
    {!! Form::label('is_allergies','Yes ', ['class' => 'control-label']) !!}
    {!! Form::radio('is_allergies',null) !!}
    {!! Form::label('is_allergies','No ', ['class' => 'control-label']) !!}
    {!! Form::radio('is_allergies_unknown',null) !!}
    {!! Form::label('is_allergies_unknown','Unknown', ['class' => 'control-label']) !!}
    <p>
        {!! Form::textarea('allergies', null, ['class'=>'form-control width_100_percent', 'rows'=>"3"]) !!}
    </p>
    </td>
</tr>
</tbody>
</table>

<table class="table table-bordered ppo-protocol">
<tbody>
<tr>
    <td class="col-md-6">
        <p><strong>Regimen: </strong><span class="regimen-code">{{ $ppo->regimen->code }}</span></p>
        <p class="regimen-name">{{ $ppo->regimen->name }}</p>

        <p><strong>Diagnosis: </strong>
        @if(isset($diagnosisSelect))
            <span class="diagnosis-name"><strong>{{ $ppo->diagnoses->name }}</strong></span>
        @else
            </p>
            @foreach($ppo->diagnoses as $diagnosis)
                <p class="diagnosis-name"><strong>{{ $diagnosis->name }}</strong></p>
            @endforeach
        @endif
    </td>
    <td class="col-md-6">
        @if($ppo->is_cycle)
        <div class="ppo-cycle">
            {!! Form::label('cycle_days','Cycle #: ', ['class' => 'control-label']) !!}
            {!! Form::text('cycle_days', null, ['class' => 'form-control', 'size'=> 2]) !!}
             Cycle repeats every {{ $ppo->cycle_days }} days
        </div>
        @endif
        @if($ppo->is_bsa)
        <div class="ppo-bsa">
            <p>
                {!! Form::label('height','Height: ', ['class' => 'control-label']) !!}
                {!! Form::text('height', null, ['class' => 'form-control', 'size'=> 6]) !!} cm&nbsp;&nbsp;&nbsp;&nbsp;
                {!! Form::label('weight','Weight: ', ['class' => 'control-label']) !!}
                {!! Form::text('weight', null, ['class' => 'form-control', 'size'=> 6]) !!} kg
            </p>
            <p>
                {!! Form::label('bsa','Body Surface Area (BSA): ', ['class' => 'control-label']) !!}
                {!! Form::text('bsa', null, ['class' => 'form-control', 'size'=> 6]) !!} m<sup>2</sup>
            </p>
        </div>
        @endif
    </td>
</tr>
</tbody>
</table>
