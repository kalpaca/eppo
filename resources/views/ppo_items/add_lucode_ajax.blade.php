<h4 class="modal-title" id="myModalLabel">Add New LU Code</h4>
@include('partials.errors')
@include('partials.session_message')
{!! Form::model(new eppo\Lucode, [
    'class'=>'form-inline',
    'id'=>'lucode-add-form',
    'role'=>'form'])
    !!}
@include('lucodes/partials/_form_body')
{!! Form::close() !!}
<script>
$('#lucode-sbt-btn').click(function(e){
    e.preventDefault();
    $('#lucode-add-form').submit();
})
</script>