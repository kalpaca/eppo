<h4 class="modal-title" id="myModalLabel">Add New Diagnosis</h4>
@include('partials.errors')
@include('partials.session_message')
{!! Form::model(new eppo\Diagnosis, [
    'class'=>'',
    'role'=>'form',
    'id'=>'dignosis-add-form'])
    !!}
@include('diagnoses/partials/_form_body')
{!! Form::close() !!}
<script>
$('#diagnosis-sbt-btn').click(function(e){
    e.preventDefault();
    $('#dignosis-add-form').submit();
})
</script>


