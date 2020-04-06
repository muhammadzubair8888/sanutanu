<div id="aboutpopup" class="modal fade in" role="dialog">
	<div class="modal-dialog">
		
		<!-- Modal content-->
		<div class="modal-content row">
			<div class="custom-modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<!-- <h4 class="modal-title">Enquire Now</h4> -->
			</div>
			<div class="modal-body" id="sanutanu_about_popup">
				<div class="row">
					<div class="col-md-12 sanutanu_about_form" >
                                     
                    </div>
				</div>
			</div>
			
		</div>
		
	</div>
</div>

<style type="text/css">
	
#aboutpopup .modal-dialog {
    width: 70%;
    max-height: 100%;
    padding: 0px ;
    position: relative;
}
#aboutpopup .modal-dialog:before {
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

#aboutpopup .modal-dialog .close {
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

#aboutpopup .modal-dialog:after {
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

#aboutpopup .form-group {
    margin-bottom: 15px !important;
}

#aboutpopup .form-inline .form-control {
    display: inline-block;
    width: 100%;
    vertical-align: middle;
}
#aboutpopup .feed-comments-spot {
	max-height: 190px;
	overflow-y: auto;
}
</style>
<script type="text/javascript">
	function about_modal()
	{
		$.ajax({
		    url: global_base_url + 'user_settings/about_form/',
		    type: 'GET',
		    data: {
		    },
		    success: function(msg) {
		      $('.sanutanu_about_form').html(msg);
		      load_comments_popup(id);
		      /*$('#home_posts').jscroll({
		        nextSelector : '.load_next'
		      });*/
		     
		    }
		  })
		$('#aboutpopup').modal('show');
	}
</script>