		<div style="padding: 10px; border-radius: 10px; border:1px solid #DDD;" >
			<div style=" border-bottom: 0px; background-color: #e70000;  border-top-left-radius: 5px;border-top-right-radius: 5px; padding: 5px; color: white; font-weight: bold;">
				SanuTanu Marriage
			</div>
			<div style="border:1px solid #DDD; border-top: 0px; background-color: #dddddd; padding: 10px;">
					<div><a style="text-decoration: none;" href="<?php echo site_url('marriage/view/').$marriageprofile->marriage_profile_id; ?>"><div> <span class="fa fa-dot-circle">  </span> <b> Profile </b></div></a></div>
					<div><a style="text-decoration: none;" href=""><div> <span class="fa fa-dot-circle">  </span>  Contact Details </div></a></div>
					<div><a style="text-decoration: none;" href=""><div> <span class="fa fa-dot-circle">  </span>  SanuTanu Gurrentee </div></a></div>
					<div><a style="text-decoration: none;" href=""><div> <span class="fa fa-dot-circle">  </span> SanuTanu Help </div></a></div>
			</div>
		</div>
		<div style="margin-top: 20px; padding: 10px; border-radius: 10px; border:1px solid #DDD;" >
			<div style=" border-bottom: 0px; background-color: #66920a;  border-top-left-radius: 5px;border-top-right-radius: 5px; padding: 5px; color: white; font-weight: bold;">
				<?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> Matches
			</div>
			<div style="border:1px solid #DDD; border-top: 0px; background-color: #dddddd; padding: 10px;">
					<!-- <div><a style="text-decoration: none;" href=""><div> <span class="fa fa-dot-circle">  </span>  Accepted Members </div></a></div> -->


					<div><a style="text-decoration: none;" href="<?php echo site_url('marriage/favourities/').$marriageprofile->marriage_profile_id; ?>"><div> <span class="fa fa-dot-circle">  </span>  Favourites </div></a></div>



					<!-- <div><a style="text-decoration: none;" href=""><div> <span class="fa fa-dot-circle">  </span>  Intrest Sent </div></a></div> -->

			</div>
		</div>
		<div style="margin-top: 20px; padding: 10px; border-radius: 10px; border:1px solid #DDD;" >
			<div style=" border-bottom: 0px; background-color: #e70000;  border-top-left-radius: 5px;border-top-right-radius: 5px; padding: 5px; color: white; font-weight: bold;">
				<?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> Requests
			</div>
			<div style="border:1px solid #DDD; border-top: 0px; background-color: #dddddd; padding: 10px;">
					<div><a style="text-decoration: none;" href="<?php echo site_url('marriage/allrequests/').$marriageprofile->marriage_profile_id ?>"><div> <span class="fa fa-dot-circle">  </span>  Contact Details Request Accepted </div></a></div>
					<div><a style="text-decoration: none;" href="<?php echo site_url('marriage/allrequests/').$marriageprofile->marriage_profile_id ?>"><div> <span class="fa fa-dot-circle">  </span>   Photo Request Recieved </div></a></div>
					
			</div>
		</div>
		<div style="margin-top: 20px; padding: 10px; border-radius: 10px; border:1px solid #DDD;" >
			<div style=" border-bottom: 0px; background-color: #66920a;  border-top-left-radius: 5px;border-top-right-radius: 5px; padding: 5px; color: white; font-weight: bold;">
				<?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> Recieved
			</div>
			<div style="border:1px solid #DDD; border-top: 0px; background-color: #dddddd; padding: 10px;">
					<div><a style="text-decoration: none;" href="<?php echo site_url('marriage/recievedphotos/').$marriageprofile->marriage_profile_id ?>"><div> <span class="fa fa-dot-circle">  </span>  Photos </div></a></div>
					<div><a style="text-decoration: none;" href="<?php echo site_url('marriage/recievedcontacts/').$marriageprofile->marriage_profile_id ?>"><div> <span class="fa fa-dot-circle">  </span>  Contact Lists </div></a></div>
			</div>
		</div>