<!-- ajax modal to load things -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content clearfix">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body" id="myModalContent">
				<!-- the external content is loaded inside this tag -->
			</div>
		</div>
	</div>
</div>
<script>
/*
$(document).ready(function() {
	//respond to click event on anything with 'overlay' class
	$(".ajax-modal-link").click(function(event){
		event.preventDefault();
		//load content from href of link
		$('.modal-body').load($(this).attr("href"),function( response, status, xhr ){
			if ( status == "success" ) {
				$('#myModal').modal();
			}
		});
	});

});
*/
</script>