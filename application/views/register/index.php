<style>
	@media (max-width: 414px){
.mail-place{
      width: 96% !important;
      height: 22px !important;
      padding: 3px 26px !important;
      font-size: 2vw !important;
}
.cisco{
	width: 40% !important;
	float: left !important;
 }
 .form-control{
 	font-size: 2vw !important;
 	height: 26px !important;
 	padding-right: 5px !important;
 }
 .glyphicon{
 	font-size: 2vw !important;
 }
 .feed{
 	margin-left: 47px !important;
 }

#countries{
  width: 40% !important;
  float: left !important;
}
#cities{
  width: 40% !important;
  float: left !important;

 margin-left: 47px !important;
}
.form-control-feedback{
	line-height: 28px !important;
}
.alert {
font-size: 2vw !important;
padding: 9px !important;
width: 96% !important;
}
.btn-flat-login{
	width: 96% !important;
}
.last{
	padding-left: 59px !important;
}


}

</style>
<div class="container">

    <div class="row ">
    <div class="col-md-6 center-block-e">

      

      <div class="login-form">
      	<div class="login-form-inner">
 		<p class="login-form-intro"><img src="<?php echo base_url() ?>images/ava2.png" width="100"></p>


		<?php if(!empty($fail)) : ?>
			<div class="alert alert-danger"><?php echo $fail ?></div>
		<?php endif; ?>

    		<?php echo form_open(site_url("register"), array("id" => "register_form")) ?>
    			<input type="hidden" name="code" value="<?php if(isset($code)) echo $code ?>">
				<div class="form-group login-form-area has-feedback">
					<input type="text" class="form-control mail-place" name="email" placeholder="<?php echo lang("ctn_214") ?>" id="email" value="<?php if(isset($email)) echo $email; ?>">
		            <i class="glyphicon glyphicon-envelope form-control-feedback login-icon-color icon" id="login-icon-email"></i>
		        </div>
		        <div class="form-group login-form-area has-feedback">
					<input type="text" class="form-control mail-place" name="username" id="username" placeholder="<?php echo lang("ctn_215") ?>" value="<?php if(isset($username)) echo $username; ?>">
		            <i class="glyphicon glyphicon-user form-control-feedback login-icon-color icon" id="login-icon-username"></i>
		        </div>
		        <div class="row">
		        	<div class="col-sm-6">
		        		<div class="form-group login-form-area has-feedback cisco ">
							<input type="password" class="form-control index" name="password" placeholder="<?php echo lang("ctn_216") ?>">
				            <i class="glyphicon glyphicon-lock form-control-feedback login-icon-color"></i>
				        </div>
		        	</div>
		        	<div class="col-sm-6">
		        		<div class="form-group login-form-area has-feedback cisco
		        		feed">
							<input type="password" class="form-control index" name="password2" placeholder="<?php echo lang("ctn_217") ?>">
				            <i class="glyphicon glyphicon-lock form-control-feedback login-icon-color"></i>
				        </div>
		        	</div>
		        </div>

		        
		        
		        <div class="row">
		        	<div class=" col-sm-6">
		        		<div class="form-group login-form-area has-feedback cisco">
							<input type="text" class="form-control" name="first_name" placeholder="<?php echo lang("ctn_29") ?>">
				            <i class="glyphicon glyphicon-user form-control-feedback login-icon-color"></i>
				        </div>
		        	</div>
		        	<div class=" col-sm-6">
		        		<div class="form-group login-form-area has-feedback cisco">
							<input type="text" class="form-control feed" name="last_name" placeholder="<?php echo lang("ctn_30") ?>">
				            <i class="glyphicon glyphicon-user form-control-feedback login-icon-color last"></i>
				        </div>
		        	</div>
			        
		        </div>

		        <div class="row">
              <div class=" col-sm-6">
                <select style="font-size: 15px;height: 35px;" class="form-control" id="countries" name="countries">
                            <option value="">Select Country</option>
                            <?php foreach ($this->db->get('countries')->result() as $c) { ?>
                                <option value="<?php echo $$c->name ?>"><?php echo $c->name; ?></option>
                            <?php } ?>
                        </select>
              </div>
              <div class=" col-sm-6">
                <select style="font-size: 15px; height: 35px;" class="form-control" id="cities" name="cities">
                            <option value="">Select City</option>
                           
                        </select>
              </div>
              
            </div>
		        
			  	<?php foreach($fields->result() as $r) : ?>
			  	<div class="form-group login-form-area clearfix">

					    <div class="col-md-3 label-heading"><?php echo $r->name ?> <?php if($r->required) : ?>*<?php endif; ?></div>
					    <div class="col-md-9">
					    	<?php if($r->type == 0) : ?>
					    		<input type="text" class="form-control" id="name-in" name="cf_<?php echo $r->ID ?>" value="<?php if(isset($_POST['cf_'. $r->ID])) echo $_POST['cf_' . $r->ID] ?>">
					    	<?php elseif($r->type == 1) : ?>
					    		<textarea name="cf_<?php echo $r->ID ?>" rows="8" class="form-control"><?php if(isset($_POST['cf_'. $r->ID])) echo $_POST['cf_' . $r->ID] ?></textarea>
					    	<?php elseif($r->type == 2) : ?>
					    		 <?php $options = explode(",", $r->options); ?>
					            <?php if(count($options) > 0) : ?>
					                <?php foreach($options as $k=>$v) : ?>
					                <div class="form-group"><input type="checkbox" name="cf_cb_<?php echo $r->ID ?>_<?php echo $k ?>" value="1" <?php if(isset($_POST['cf_cb_' . $r->ID . "_" . $k])) echo "checked" ?>> <?php echo $v ?></div>
					                <?php endforeach; ?>
					            <?php endif; ?>
					    	<?php elseif($r->type == 3) : ?>
					    		<?php $options = explode(",", $r->options); ?>
					            <?php if(count($options) > 0) : ?>
					                <?php foreach($options as $k=>$v) : ?>
					                <div class="form-group"><input type="radio" name="cf_radio_<?php echo $r->ID ?>" value="<?php echo $k ?>" <?php if(isset($_POST['cf_radio_' . $r->ID]) && $_POST['cf_radio_' . $r->ID] == $k) echo "checked" ?>> <?php echo $v ?></div>
					                <?php endforeach; ?>
					            <?php endif; ?>
					    	<?php elseif($r->type == 4) : ?>
					    		<?php $options = explode(",", $r->options); ?>
					            <?php if(count($options) > 0) : ?>
					                <select name="cf_<?php echo $r->ID ?>" class="form-control">
					                <?php foreach($options as $k=>$v) : ?>
					                <option value="<?php echo $k ?>" <?php if(isset($_POST['cf_' . $r->ID]) && $_POST['cf_'.$r->ID] == $k) echo "selected" ?>><?php echo $v ?></option>
					                <?php endforeach; ?>
					                </select>
					            <?php endif; ?>
					    	<?php endif; ?>
					    	<span class="help-text"><?php echo $r->help_text ?></span>
					    </div>
			  	</div>
			  	<?php endforeach; ?>

			  	<?php if(!$this->settings->info->disable_captcha) : ?>
		  		<div class="form-group login-form-area">
				    	<p><?php echo $cap['image'] ?></p>
						<input type="text" class="form-control" id="captcha-in" name="captcha" placeholder="<?php echo lang("ctn_306") ?>" value="">
				</div>
		  		<?php endif; ?>

		  		<?php if($this->settings->info->google_recaptcha) : ?>
		  			<div class="form-group login-form-area">
				    <div class="g-recaptcha" data-sitekey="<?php echo $this->settings->info->google_recaptcha_key ?>"></div> 
		  		</div>
		  		<?php endif ?>

				<label><?php echo lang("ctn_954") ?></label><!-- Birthday -->
		  		<div class="form-group login-form-area has-feedback">
		  			<div class="input-group">
		  				<select class="form-control" style="width: inherit;" name="dob_day">
		  					<?php 
		  					$d=1; 
		  					for($d=1; $d<=31; $d++): ?>
		  					<option value="<?php echo $d; ?>" <?php if($d==18){ echo 'selected'; } ?>><?php echo $d; ?></option>
		  				<?php endfor; ?>
		  				</select>
		  				<select class="form-control" style="width: inherit;" name="dob_month">
		  					<?php 
		  					$m=1; 
		  					for($m=1; $m<=12; $m++): ?>
		  					<option value="<?php echo $m; ?>" <?php if($m==4){ echo 'selected'; } ?>><?php echo date('M', strtotime('2001-'.$m.'-01')); ?></option>
		  				<?php endfor; ?>
		  				</select>
		  				<select class="form-control" style="width: inherit;" name="dob_year">
		  					<?php 
		  					$y=date('Y');
		  					for($y=date('Y'); $y>=1905; $y--): ?>
		  					<option value="<?php echo $y; ?>" <?php if($y==1995){ echo 'selected'; } ?>><?php echo $y; ?></option>
		  				<?php endfor; ?>
		  				</select>
		  			</div>
		        </div>


		        <label><?php echo lang("ctn_951") ?></label><!-- Gender -->
		  		<div class="form-group login-form-area has-feedback">
		  			<input type="radio" name="gender" id="male" value="Male" checked />
		  			<label for="gender" onclick="$('#male').click();" ><?php echo lang("ctn_952") ?></label>
		  			&nbsp; &nbsp; &nbsp;
		  			<input type="radio" name="gender" id="female" value="Female" />
		  			<label for="gender"  onclick="$('#female').click();" ><?php echo lang("ctn_953") ?></label>
		        </div>

		  		<div class="form-group login-form-area has-feedback">
		  			<input type="hidden" name="allow_newsletter" id="allow_newsletter" value="1" />
					<input type="checkbox" class="" name="getnewsletter" id="getnewsletter" onclick="cheknewsletter();" checked >
		            <label for="getnewsletter"><?php echo lang("ctn_955"); ?></label>
		        </div>


		        <div class="form-group login-form-area has-feedback">
		        	<input type="hidden" name="allow_privacypolicy" id="allow_privacypolicy" value="1" />
					<input type="checkbox" class="" name="acceptprivacypolicy" id="acceptprivacypolicy" onclick="chekprivacypolicy();" checked >
		            <label for="acceptprivacypolicy"><?php echo lang("ctn_979"); ?></label>
		        </div>


		  		<input type="submit" name="s" class="btn btn-flat-login form-control" value="<?php echo lang("ctn_221") ?>" />

		  		<hr>

		  			<p><?php echo lang("ctn_222") ?></p>
		  		</div>


		  		<div class="login-form-bottom">
		  		


		  		 <?php if(!$this->settings->info->disable_social_login) : ?>
		          <div class="text-center decent-margin-top">
		          <?php if(!empty($this->settings->info->twitter_consumer_key) && !empty($this->settings->info->twitter_consumer_secret)) : ?>
		          <div class="btn-group">
		            <a href="<?php echo site_url("login/twitter_login") ?>" class="btn btn-flat-social-twitter" >
		              <img src="<?php echo base_url() ?>images/social/twitter.png" height="20" class='social-icon' />
		             Twitter</a>
		          </div>
		          <?php endif; ?>
		          <?php if(!empty($this->settings->info->facebook_app_id) && !empty($this->settings->info->facebook_app_secret)) : ?>
		          <div class="btn-group">
		            <a href="<?php echo site_url("login/facebook_login") ?>" class="btn btn-flat-social-facebook" >
		              <img src="<?php echo base_url() ?>images/social/facebook.png" height="20" class='social-icon' />
		             Facebook</a>
		          </div>
		          <?php endif; ?>

		          <?php if(!empty($this->settings->info->google_client_id) && !empty($this->settings->info->google_client_secret)) : ?>
		          <div class="btn-group">
		            <a href="<?php echo site_url("login/google_login") ?>" class="btn btn-flat-social-google" >
		              <img src="<?php echo base_url() ?>images/social/google.png" height="20" class='social-icon' />
		             Google</a>
		          </div>
		          <?php endif; ?>
		          </div>
		          <?php endif; ?>

		  		<p class="decent-margin align-center"><a href="<?php echo site_url("login") ?>"><?php echo lang("ctn_834") ?></a></p>

		  	<?php echo form_close() ?>
		  </div>
</div>

</div>
</div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    var form = "register_form";
    $('#'+form + ' input').on("focus", function(e) {
      clearerrors();
    });

    $('#username').on("change", function() {
    	$.ajax({
	        url : global_base_url + "register/check_username",
	        type : 'GET',
	        data : {
	          username : $(this).val(),
	        },
	        dataType: 'JSON',
	        success: function(data) {
	        	if(data.success) {
	        		$("#login-icon-username").css("color", "green");
	        	} else {
	        		$("#login-icon-username").css("color", "#a0a0a0");
	        		if(data.field_errors) {
			            var errors = data.fieldErrors;
			            for (var property in errors) {
			                if (errors.hasOwnProperty(property)) {
			                    // Find form name
			                    var field_name = '#' + form + ' input[name="'+property+'"]';
			                    $(field_name).addClass("errorField");
			                    if(errors[property]) {
				                    // Get input group of field
				                    $(field_name).parent().closest('.form-group').after('<div class="form-error-no-margin">'+errors[property]+'</div>');
				                }
			                    

			                }
			            }
			          }
	        	}
	        }
	    });
    });

    $('#email').on("change", function() {
    	$.ajax({
	        url : global_base_url + "register/check_email",
	        type : 'GET',
	        data : {
	          email : $(this).val(),
	        },
	        dataType: 'JSON',
	        success: function(data) {
	        	if(data.success) {
	        		$("#login-icon-email").css("color", "green");
	        	} else {
	        		$("#login-icon-email").css("color", "#a0a0a0");
	        		if(data.field_errors) {
			            var errors = data.fieldErrors;
			            for (var property in errors) {
			                if (errors.hasOwnProperty(property)) {
			                    // Find form name
			                    var field_name = '#' + form + ' input[name="'+property+'"]';
			                    $(field_name).addClass("errorField");
			                    if(errors[property]) {
				                    // Get input group of field
				                    $(field_name).parent().closest('.form-group').after('<div class="form-error-no-margin">'+errors[property]+'</div>');
				                }
			                    

			                }
			            }
			          }
	        	}
	        }
	    });
    });

    $('#'+form).on("submit", function(e) {

      e.preventDefault();
      // Ajax check
      var data = $(this).serialize();
      $.ajax({
        url : global_base_url + "register/ajax_check_register",
        type : 'POST',
        data : {
          formData : data,
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash() ?>'
        },
        dataType: 'JSON',
        success: function(data) {
          if(data.error) {
            $('#'+form).prepend('<div class="form-error">'+data.error_msg+'</div>');
          }
          if(data.success) {
            // allow form submit
            $('#'+form).unbind('submit').submit();
          }
          if(data.field_errors) {
            var errors = data.fieldErrors;
            for (var property in errors) {
                if (errors.hasOwnProperty(property)) {
                	//alert(property);
                    // Find form name
                    var field_name = '#' + form + ' input[name="'+property+'"]';
                    $(field_name).addClass("errorField");
                    if(errors[property]) {
	                    // Get input group of field
	                    $(field_name).parent().closest('.form-group').after('<div class="form-error-no-margin">'+errors[property]+'</div>');
	                }
                    

                }
            }
          }
        }
      });

      return false;


    });
  });

  function clearerrors() 
  {
    console.log("Called");
    $('.form-error').remove();
    $('.form-error-no-margin').remove();
    $('.errorField').removeClass('errorField');
  }
  function cheknewsletter()
  {
  	var chk = document.getElementById('getnewsletter').checked;
  	if(chk==true)
  	{
  		$('#allow_newsletter').val(1);
  	}
  	else
  	{
  		$('#allow_newsletter').val(0);
  	}
  }

  function chekprivacypolicy()
  {
  	var chk = document.getElementById('acceptprivacypolicy').checked;
  	if(chk==true)
  	{
  		$('#allow_privacypolicy').val(1);
  	}
  	else
  	{
  		$('#allow_privacypolicy').val(0);
  	}
  }

  $('#countries').on('change',function(){
    $id = $('#countries').val();
    $.ajax({
      url: global_base_url + 'Login/get_city_id',
      data: {id: $id},
    })
    .done(function(res) {
      // console.log(res);
      $('#cities').html(res);

    })
   
    
  });

</script>