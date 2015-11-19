<h4 class="modal-title" id="myModalLabel">Add New Regimen</h4>
@include('partials.errors')
@include('partials.session_message')
{!! Form::model(new eppo\Regimen, [
    'class'=>'',
    'role'=>'form',
    'id'=>'regimen-add-form'])
    !!}
@include('regimens/partials/_form_body')
{!! Form::close() !!}
<script>
$('#regimen-sbt-btn').click(function(e){
    e.preventDefault();
    $('#regimen-add-form').submit();
})
</script>


