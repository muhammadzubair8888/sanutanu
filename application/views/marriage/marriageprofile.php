<div style="margin-top: 20px;" class="row">
	<div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">
		<?php include(APPPATH . "/views/marriage/sidebar.php"); ?>
	</div>
	<div class="col-md-8 col-xs-8 col-sm-8">
		<div style="box-shadow: 0 0 6px rgba(0,0,0,.2); border-radius: 10px; padding: 10px;">
			<p>Welcome Member (Profile ID : <b><?php echo $marriageprofile->marriage_profile_id ?></b> )</p> 
			<p> This page displays your account summary, profile status, membership status, matchmaking tools and things to do to help you find your life partner. </p>
			<div style="margin-top: 20px;">
				<div style="border:1px solid #DDD; border-radius: 10px; padding: 10px;">
					<div class="row">
						<div class="col-md-9">
							<div style="background-color: #efefef; padding: 5px; color: #b14343; font-weight: bold;"><?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> Profile Summary</div>
							<div style="padding: 10px;">
								<div>
								<span class="fa fa-arrow-circle-right"></span> Contact Details request Sent <span style="padding-left: 55px;"> <i style="color: red; " class="fa fa-address-book"></i></span><a style="padding-left: 20px;" href=""><?php echo $this->marriage_model->getcontactrequestsent($marriageprofile->marriage_profile_id); ?> New</a>
								<a href=""> (<?php echo $this->marriage_model->getcontactrequestsentold($marriageprofile->marriage_profile_id); ?> Old)</a>
								</div>
								<div style="margin-top: 10px;">
								<span class="fa fa-arrow-circle-right"></span> Contact Details request received <span style="padding-left: 29px;"> <i style="color: red; " class="fa fa-address-book"></i></span><a style="padding-left: 20px;" href="<?php echo site_url('marriage/allrequests/').$marriageprofile->marriage_profile_id ?>"><?php echo $this->marriage_model->getcontactrequestrecieved($marriageprofile->marriage_profile_id); ?> New</a>
								<a href="<?php echo site_url('marriage/allrequests/').$marriageprofile->marriage_profile_id ?>"> (<?php echo $this->marriage_model->getcontactrequestrecievedold($marriageprofile->marriage_profile_id); ?> Old)</a>
								</div>
								<div style="margin-top: 10px;">
								<span class="fa fa-arrow-circle-right"></span> Photo request received <span style="padding-left: 90px;"> <i style="color: red; " class="fa fa-file-image"></i></span><a style="padding-left: 20px;" href="<?php echo site_url('marriage/allrequests/').$marriageprofile->marriage_profile_id ?>"><?php echo $this->marriage_model->getphotorequestrecieved($marriageprofile->marriage_profile_id); ?> New</a>
								<a href="<?php echo site_url('marriage/allrequests/').$marriageprofile->marriage_profile_id ?>"> (<?php echo $this->marriage_model->getphotorequestrecievedold($marriageprofile->marriage_profile_id); ?> Old)</a>
								</div>
								<div style="margin-top: 10px;">
								<span class="fa fa-arrow-circle-right"></span> Photo request Sent <span style="padding-left:116px;"> <i style="color: red; " class="fa fa-file-image"></i></span><a style="padding-left: 20px;" href=""><?php echo $this->marriage_model->getphotorequestsent($marriageprofile->marriage_profile_id); ?> New</a>
								<a href=""> (<?php echo $this->marriage_model->getphotorequestsentold($marriageprofile->marriage_profile_id); ?> Old)</a>
								</div>
							</div>	
						</div>
						<div class="col-md-3">
							<div style="border:1px solid #DDD; border-radius: 10px; padding: 5px;">
									<img style="height: 100%; width: 100%;" src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $marriageprofile->profileimage ?>">
							</div>
							<div style="text-align: center; margin-top: 10px;">
								<b>Profile Views</b><br>
								<b><?php if (empty($marriageprofile->profileviews)) {
									echo "0";
								}else{ echo $marriageprofile->profileviews;} ?></b>
							</div>	
						</div>
					</div>
				</div>
				<div style="margin-top: 20px; background-color: #efefef; padding: 5px; color: #b14343; font-weight: bold;"><?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> Profile Status</div>
				<div style="margin-top: 20px;">
					<?php if ($marriageprofile->profile_status_step == 2) { ?>
						<b>Your Profile is 30% Complete</b>
					  <div class="progress">
					    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:30%;  ">
					    </div>
					  </div>
					  	<div style="margin-top: 20px; margin-bottom: 20px;">
					  		<div><a href="<?php echo site_url('marriage/createnew/').$marriageprofile->marriage_profile_id ?>">Add Correspondence Contact Details</a></div>
					  		<div><a href="<?php echo site_url('marriage/createnew/').$marriageprofile->marriage_profile_id ?>">Add More About Yourself</a></div>
					  		<div><a href="<?php echo site_url('marriage/createnew/').$marriageprofile->marriage_profile_id ?>">Add Hobbies and Intrests</a></div>
					  		<div><a href="<?php echo site_url('marriage/createnew/').$marriageprofile->marriage_profile_id ?>">Add Partners Profile</a></div>
					  </div>
					<?php }elseif ($marriageprofile->profile_status_step == 3) { ?>
						<b>Your Profile is 50% Complete</b>
					  <div class="progress">
					    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:50%;  ">
					    </div>
					  </div>
					  <div style="margin-top: 20px; margin-bottom: 20px;">
					  		<div><a href="<?php echo site_url('marriage/createnew/').$marriageprofile->marriage_profile_id ?>">Add More About Yourself</a></div>
					  		<div><a href="<?php echo site_url('marriage/createnew/').$marriageprofile->marriage_profile_id ?>">Add Hobbies and Intrests</a></div>
					  		<div><a href="<?php echo site_url('marriage/createnew/').$marriageprofile->marriage_profile_id ?>">Add Partners Profile</a></div>
					  </div>
					<?php }elseif ($marriageprofile->profile_status_step == 4) { ?>
						<b>Your Profile is 70% Complete</b>
					  <div class="progress">
					    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%;  ">
					    </div>
					  </div>
					  <div style="margin-top: 20px; margin-bottom: 20px;">
					  		<div><a href="<?php echo site_url('marriage/createnew/').$marriageprofile->marriage_profile_id ?>">Add Hobbies and Intrests</a></div>
					  		<div><a href="<?php echo site_url('marriage/createnew/').$marriageprofile->marriage_profile_id ?>">Add Partners Profile</a></div>
					  </div>
					<?php }else { ?>
						<b>Your Profile is 100% Complete</b>
					  <div class="progress">
					    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%;  ">
					    </div>
					  </div>
					<?php } ?> 
					<b><?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> Profiles Was Last Updated On: <span style="color: red;"><?php echo $marriageprofile->updatedat; ?></span></b>
				</div>
			</div>
		</div>
	</div>
</div>