<h4 class="modal-title" id="myModalLabel">Add New Diagnosis</h4>
@include('partials.errors')
@include('partials.session_message')
{!! Form::model(new eppo\Diagnosis, [
    'route'=>'diagnoses.store',
    'class'=>''])
    !!}
@include('diagnoses/partials/_form_body')
{!! Form::close() !!}


	


