
<div class="form-group">
    {!! Form::label('name','Name: ',['class' => 'control-label']) !!}
    {!! Form::text('name',null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('diagnosis_primary_category_id','Diagnosis Category',['class' => 'control-label']) !!}
    {!! Form::select('diagnosis_primary_category_id',$primaryCats,['class'=>'form-control']) !!}
</div>

{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}