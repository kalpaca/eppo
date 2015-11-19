<h4 class="modal-title" id="myModalLabel">Add New Medication</h4>
@include('partials.errors')
@include('partials.session_message')
{!! Form::model(new eppo\Medication, [
    'class'=>'form-inline',
    'id'=>'med-add-form',
    'role'=>'form'])
    !!}
@include('medications/partials/_form_body')
{!! Form::close() !!}
<script>
$('#med-sbt-btn').click(function(e){
    e.preventDefault();
    $('#med-add-form').submit();
})
</script>
