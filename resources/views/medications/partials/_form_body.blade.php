<div class="form-group">
    {!! Form::label('name','Name: ',['class' => 'control-label']) !!}
    {!! Form::text('name',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('instruction','Universal instruction: ',['class' => 'control-label']) !!}
    {!! Form::text('instruction',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::hidden('is_rev_aid', false) !!}
    {!! Form::checkbox('is_rev_aid', null) !!}
    {!! Form::label('is_rev_aid','Show RevAid input ', ['class' => 'control-label']) !!}
</div>
<div class="form-group">
    {!! Form::hidden('is_eap', false) !!}
    {!! Form::checkbox('is_eap', null) !!}
    {!! Form::label('is_eap','Show EAP approval input ', ['class' => 'control-label']) !!}
</div>
{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}