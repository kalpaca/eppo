@extends('layouts.form')
@section('title','Diagnosis')
@section('formTitle','Add a New Diagnosis')
@section('formContent')

        {!! Form::open(['route'=>'diagnoses.store']) !!}
            @include('diagnoses/partials/_form_body');

        {!! Form::close() !!}
    </div>
</div>
@endsection