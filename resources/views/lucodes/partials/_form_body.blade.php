<div class="form-group">
    {!! Form::label('code','Code: ',['class' => 'control-label']) !!}
    {!! Form::text('code', null , ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('name','Name: ',['class' => 'control-label']) !!}
    {!! Form::text('name', null , ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
</div>