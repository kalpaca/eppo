<div class="form-group">
    {!! Form::label('name','Name: ',['class' => 'control-label']) !!}
    {!! Form::text('name',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('instruction','Universal instruction: ',['class' => 'control-label']) !!}
    {!! Form::text('instruction',null,['class'=>'form-control']) !!}
</div>

{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}