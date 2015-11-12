<div class="form-group">
    {!! Form::label('code','Code: ',['class' => 'control-label']) !!}
    {!! Form::text('code', null , ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('name','Description: ',['class' => 'control-label']) !!}
    {!! Form::text('name', null , ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('medication_id','Medication: ',['class' => 'control-label']) !!}
    {!! Form::hidden('medication_id', $medication->id) !!}
    {!! link_to_route('medications.show', $medication->name, $medication->id) !!}
</div>
<div class="form-group">
    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
</div>