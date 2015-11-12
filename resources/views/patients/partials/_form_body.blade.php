<div class="form-group">
    {!! Form::label('fullname','Full Name (John Smith): ',['class' => 'control-label']) !!}
    {!! Form::text('fullname',null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('dob','Date of Birth: ',['class' => 'control-label']) !!}
    {!! Form::text('dob',null,['class'=>'form-control datepicker']) !!}
</div>

{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}

<script>$('.datepicker').datepicker();</script>