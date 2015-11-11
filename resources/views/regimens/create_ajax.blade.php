<h4 class="modal-title" id="myModalLabel">Add New Regimen</h4>
@include('partials.errors')
@include('partials.session_message')
{!! Form::model(new eppo\Regimen, [
    'route'=>'regimens.store',
    'class'=>''])
    !!}
    @include('regimens/partials/_form_body')
{!! Form::close() !!}


