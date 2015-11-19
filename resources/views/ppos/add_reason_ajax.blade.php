<h4 class="modal-title" id="myModalLabel">Add New Reason</h4>
@include('partials.errors')
@include('partials.session_message')
{!! Form::model(new eppo\DoseModificationReason, [
    'class'=>'',
    'role'=>'form',
    'id'=>'reason-add-form'])
    !!}
@include('dose_modification_reasons/partials/_form_body')
{!! Form::close() !!}
<script>
$('#reason-sbt-btn').click(function(e){
    e.preventDefault();
    $('#reason-add-form').submit();
})
</script>
