<div id="report_abuse_popup" class="modal fade in" role="dialog">
	<div class="modal-dialog">
		
		<!-- Modal content-->
		<div class="modal-content row">
			<div class="custom-modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<!-- <h4 class="modal-title">Please select a problem to continue</h4> -->
			</div>
			<div class="modal-body" id="sanutanu_report_abuse_popup">
				<div class="row">
					<div class="col-md-12 sanutanu_report_abuse_form" >
                                     
                    </div>
				</div>
			</div>
			
		</div>
		
	</div>
</div>

<style type="text/css">
	
#report_abuse_popup .modal-dialog {
    width: 400px;
    max-height: 100%;
    padding: 0px ;
    position: relative;
}
#report_abuse_popup .modal-dialog:before {
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

#report_abuse_popup .custom-modal-header {
    text-align: center;
    color: #a41be3;
    text-transform: uppercase;
    letter-spacing: 2px;
    border-top: 4px solid;
}

#report_abuse_popup .modal-dialog .close {
    z-index: 99999999;
    color: white;
    text-shadow: 0px 0px 0px;
    font-weight: normal;
    top: 4px;
    right: 6px;
    position: absolute;
    opacity: 1;
}

#report_abuse_popup .custom-modal-header .modal-title {
    /* font-weight: bold; */
    font-size: 18px;
}

/*#report_abuse_popup .custom-modal-body {
	height: 700px;
}*/

#report_abuse_popup .modal-dialog:after {
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

#report_abuse_popup .form-group {
    margin-bottom: 15px !important;
}

#report_abuse_popup .form-inline .form-control {
    display: inline-block;
    width: 100%;
    vertical-align: middle;
}
#report_abuse_popup .feed-comments-spot {
	max-height: 190px;
	overflow-y: auto;
}
</style>
<script type="text/javascript">
	function report_abuse_modal(postid)
	{
		$.ajax({
		    url: global_base_url + 'user_settings/report_abuse_form/'+postid,
		    type: 'GET',
		    data: {
		    },
		    success: function(msg) {
		      $('.sanutanu_report_abuse_form').html(msg);
		    }
		  })
		$('#report_abuse_popup').modal('show');
	}
</script>