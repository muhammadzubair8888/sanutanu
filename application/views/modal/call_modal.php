<div id="callpopup" class="modal fade in" role="dialog">
	<div class="modal-dialog">
		
		<!-- Modal content-->
		<div class="modal-content row">
			<div class="custom-modal-header hide">
				<!-- <button type="button" class="close" data-dismiss="modal">×</button> -->
				<!-- <h4 class="modal-title">New Call from </h4> -->
			</div>
			<div class="modal-body" id="sanutanu_about_popup">
                <div style="display: flex;">
                    <div class="chatcallinfo"></div>
                    <div style="padding-left: 10px; font-weight: bold;">Request for <span class="chatcalltype">Video</span> call.</div>
                </div> 
                <hr>
				<div class="row">
    				<div class="col-md-12 sanutanu_about_form" style="text-align: center;" >
                        <a class="btn btn-success" onclick="callresponse(1);">Accept</a>
                        <a class="btn btn-danger" onclick="callresponse(0);">Reject</a>
                        <audio class="ringtone" id="ringtone" src="<?php echo base_url('ringtones/ring-basic.mp3'); ?>" loop></audio>
                    </div>
				</div>
			</div>
			
		</div>
		
	</div>
</div>

<style type="text/css">

#callpopup .modal-dialog {
    width: 400px;
    max-height: 100%;
    padding: 0px ;
    position: relative;
}
/* #callpopup .modal-dialog:before {
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

#callpopup .modal-dialog .close {
    z-index: 99999999;
    color: white;
    text-shadow: 0px 0px 0px;
    font-weight: normal;
    top: 4px;
    right: 6px;
    position: absolute;
    opacity: 1;
} */

.custom-modal-header .modal-title {
    /* font-weight: bold; */
    font-size: 18px;
}

.custom-modal-body {
	/*height: 700px;*/
}

/* #callpopup .modal-dialog:after {
    content: '';
    height: 0px;
    width: 0px;
    border-right: 50px solid rgba(255, 0, 0, 0.98);
    border-right: 50px solid #a41be3;
    border-bottom: 50px solid transparent;
    position: absolute;
    top: 1px;
    right: -14px;
    z-index: 999999;
} */

#callpopup .form-group {
    margin-bottom: 15px !important;
}

#callpopup .form-inline .form-control {
    display: inline-block;
    width: 100%;
    vertical-align: middle;
}
#callpopup .feed-comments-spot {
	max-height: 190px;
	overflow-y: auto;
}
</style>

<script type="text/javascript">
	function call_modal(userid, calltype)
	{
        $.ajax({
            url: '<?php echo site_url('chat/chatuser/'); ?>'+userid,
            type: 'GET',
            //dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
            //data: {param1: 'value1'},
            success: function(resp){
                $('.chatcallinfo').html(resp);
                $('.chatcalltype').text(calltype);
                $('.ringtone')[0].play();
                $('body').click();
            }
        });
        
		$('#callpopup').modal('show');
	}
</script>