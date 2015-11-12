<div class="form-group">
    {!! Form::label('code','Code: ',['class' => 'control-label']) !!}
    {!! Form::text('code', null , ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('description','Description: ',['class' => 'control-label']) !!}
    {!! Form::text('description', null , ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('medication_id','Medication: ',['class' => 'control-label']) !!}
    @if($medication)
    {!! Form::hidden('medication_id', $medication->id) !!}
    {!! link_to_route('medications.show', $medication->name, $medication->id) !!}
    @else
    {!! Form::select('medication_id', $medications, null) !!}
    @endif
</div>
<div class="form-group">
    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
</div>