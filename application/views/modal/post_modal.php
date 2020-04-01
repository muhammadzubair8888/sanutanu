<div id="postpopup" class="modal fade in" role="dialog">
	<div class="modal-dialog">
		
		<!-- Modal content-->
		<div class="modal-content row">
			<div class="custom-modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<!-- <h4 class="modal-title">Enquire Now</h4> -->
			</div>
			<div class="modal-body" id="sanutanu_post_popup">
				<div class="row">
					<div class="col-md-8"></div>
					<div class="col-md-4"></div>
				</div>
			</div>
			
		</div>
		
	</div>
</div>

<style type="text/css">
	
#postpopup .modal-dialog {
    width: 70%;
    max-height: 100%;
    padding: 0px ;
    position: relative;
}
#postpopup .modal-dialog:before {
    content: '';
    height: 0px;
    width: 0px;
    border-left: 50px solid #a41be3;
    border-right: 50px solid transparent;
    border-bottom: 50px solid transparent;
    position: absolute;
    top: 1px;
    left: -14px;
    z-index: 99;
}

.custom-modal-header {
    text-align: center;
    color: #a41be3;
    text-transform: uppercase;
    letter-spacing: 2px;
    border-top: 4px solid;
}

#postpopup .modal-dialog .close {
    z-index: 99999999;
    color: white;
    text-shadow: 0px 0px 0px;
    font-weight: normal;
    top: 4px;
    right: 6px;
    position: absolute;
    opacity: 1;
}

.custom-modal-header .modal-title {
    /* font-weight: bold; */
    font-size: 18px;
}

.custom-modal-body {
	height: 700px;
}

#postpopup .modal-dialog:after {
    content: '';
    height: 0px;
    width: 0px;
    /* border-right: 50px solid rgba(255, 0, 0, 0.98); */
    border-right: 50px solid #a41be3;
    border-bottom: 50px solid transparent;
    position: absolute;
    top: 1px;
    right: -14px;
    z-index: 999999;
}

#postpopup .form-group {
    margin-bottom: 15px !important;
}

#postpopup .form-inline .form-control {
    display: inline-block;
    width: 100%;
    vertical-align: middle;
}
#postpopup .feed-comments-spot {
	max-height: 190px;
	overflow-y: auto;
}
</style>
<script type="text/javascript">
	function post_modal(id)
	{
		$.ajax({
		    url: global_base_url + 'feed/load_single_post_popup/'+id,
		    type: 'GET',
		    data: {
		    },
		    success: function(msg) {
		      $('#sanutanu_post_popup').html(msg);
		      load_comments_popup(id);
		      /*$('#home_posts').jscroll({
		        nextSelector : '.load_next'
		      });*/
		     
		    }
		  })
		$('#postpopup').modal('show');
	}
</script>