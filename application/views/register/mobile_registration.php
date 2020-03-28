<div class="container">
    <div class="row">
	    <div class="col-md-5 center-block-e">
			<div class="login-form">
				<div class="login-form-inner">
					<p class="login-form-intro"><img src="<?php echo base_url() ?>images/ava2.png" width="100"></p>
					<!-- Start Form -->
					<form class="from-group" id="otp_from">
						<h4 style="border-bottom: 1px solid lightgray;">Please enter your OTP from your SMS Message</h4>
						<div class="form-group login-form-area has-feedback row">
							<div class="alert alert-danger" role="alert" style="margin-left: 4%;" hidden="true">
							</div>
							<div class="col-sm-1"  style="margin-top: 11%; font-size: 18px;">
								<p>ST-</p>
							</div>
							<div class="col-sm-5" style="margin-top: 10%;">
								<input type="text" class="form-control" name="otpnumber" id="otpnumber" placeholder="OTP"/>
							</div>
							<div class="col-sm-1" style="margin-top: 11%;">
								<span style="color:gray;font-size: 16px; padding: 10px;" id="timer">60</span>
							</div>
						</div>
						<div class="modal-footer" style="margin-top: 25%;">
							<div class="row">
								<div class="col-sm-8 text-left">
									<a name="again_send" id="again_send" style="color: #a41be3; text-decoration: none; cursor: pointer;"  onclick="resend_otp()">Resend OTP again</a>
								</div>
								<div class="col-sm-4">
									<input style="background-color: #a41be3;color: #FFF;" type="button" id="otp_submit" class="btn" value="Continue" onclick="submit_otp(this.form.id)"/>
								</div>
							</div>
						</div>
					</form>
				<!-- End Form  -->
				</div>
			</div>

	    	<!-- Container Start -->
    <div style="width:100%;margin-top:10%; background-color: rgb(231, 180, 231);">
        
    </div>
    <!-- End Container -->
    
		</div>
	</div>
</div>
<!-- ================================================================ -->
    <!-- Start Modal  -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header" style="background-color:#a41be3;padding: 10px; color: white;">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Account Confirmed</h4>
		</div>
      <div class="modal-body" id="m_body" style="padding: 25px;">
        
      </div>
      <div class="modal-footer" style="padding: 3px; background-color: #dee2e6;">
        <button type="button" class="btn" data-dismiss="modal" style="background-color:#a41be3; color: white;">OK</button>
      </div>
    </div>
    
  </div>
</div>
    <!-- End Modal -->
    <!-- Start Modal Script -->
<script>
	$(document).ready(function(){
		$(".projects-wrap").hide();
		var counter = 60;
		var interval = setInterval(function() {
		    counter--;
		    // Display 'counter' wherever you want to display it.
		    if (counter <= 0) {
		     		clearInterval(interval);
		      	$('#timer').text("Expired");  
		        return;
		    }else{
		    	$('#timer').text(counter);
		      console.log("Timer --> " + counter);
		    }
		}, 1000);
	});
	function submit_otp(id){
		var otp_value = $("#otpnumber").val();
		$.ajax({
	        url : global_base_url + "register/otp_varification",
	        type : 'GET',
	        data : $("#"+id).serialize(),
	        success: function(data) {
	        	if(data == "success" ){
	        		window.location.href = global_base_url +"login";
	        	}else{
	        		$(".alert-danger").html("<p>"+data+"</p>");
	        		$(".alert-danger").show();
	        	}
	        }
	    });
	}

	function resend_otp(){
		$.ajax({
	        url : global_base_url + "register/resend_otp",
	        type : 'GET',
	        success: function(data) {
	        	window.location.reload();
	        }
	    });
	}

	$("#otpnumber").on("focus", function(){
		$(".alert-danger").hide();
	});
</script>
    <!-- End Modal Script -->