<style type="text/css">
  .panelcustom{
    border-top:1px solid #DDD;
    border-left:1px solid #DDD;
    border-right:1px solid #DDD;
    padding: 10px;
    background-color: #efefef;
    margin-top: 10px;
  }
  .panelbodycustom{
    border-bottom:1px solid #DDD;
    border-left:1px solid #DDD;
    border-right:1px solid #DDD;
    padding: 10px;
  }
</style>
<div style="margin-top: 20px;" class="row">
	<div class="col-md-4">
		<div style="padding: 10px; border-radius: 10px; border:1px solid #DDD;" >
			<div style=" border-bottom: 0px; background-color: #e70000;  border-top-left-radius: 5px;border-top-right-radius: 5px; padding: 5px; color: white; font-weight: bold;">
				SanuTanu Marriage
			</div>
			<div style="border:1px solid #DDD; border-top: 0px; background-color: #dddddd; padding: 10px;">
					<div><a style="text-decoration: none;" href=""><div> <span class="fa fa-dot-circle">  </span> <?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> Profile </div></a></div>
					<div><a style="text-decoration: none;" href=""><div> <span class="fa fa-dot-circle">  </span> <?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> Contact Details </div></a></div>
					<div><a style="text-decoration: none;" href=""><div> <span class="fa fa-dot-circle">  </span>  SanuTanu Gurrentee </div></a></div>
					<div><a style="text-decoration: none;" href=""><div> <span class="fa fa-dot-circle">  </span> SanuTanu Help </div></a></div>
			</div>
		</div>
		<div style="margin-top: 20px; padding: 10px; border-radius: 10px; border:1px solid #DDD;" >
			<div style=" border-bottom: 0px; background-color: #66920a;  border-top-left-radius: 5px;border-top-right-radius: 5px; padding: 5px; color: white; font-weight: bold;">
				<?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> Matches
			</div>
			<div style="border:1px solid #DDD; border-top: 0px; background-color: #dddddd; padding: 10px;">
					<div><a style="text-decoration: none;" href=""><div> <span class="fa fa-dot-circle">  </span> <?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> Accepted Members </div></a></div>
					<div><a style="text-decoration: none;" href=""><div> <span class="fa fa-dot-circle">  </span> <?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> Favourites </div></a></div>
					<div><a style="text-decoration: none;" href=""><div> <span class="fa fa-dot-circle">  </span> <?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> Intrest Sent </div></a></div>

			</div>
		</div>
		<div style="margin-top: 20px; padding: 10px; border-radius: 10px; border:1px solid #DDD;" >
			<div style=" border-bottom: 0px; background-color: #e70000;  border-top-left-radius: 5px;border-top-right-radius: 5px; padding: 5px; color: white; font-weight: bold;">
				<?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> Requests
			</div>
			<div style="border:1px solid #DDD; border-top: 0px; background-color: #dddddd; padding: 10px;">
					<div><a style="text-decoration: none;" href=""><div> <span class="fa fa-dot-circle">  </span> <?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> Contact Details Request Accepted </div></a></div>
					<div><a style="text-decoration: none;" href=""><div> <span class="fa fa-dot-circle">  </span> <?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> Contact Details Request Sent </div></a></div>
					<div><a style="text-decoration: none;" href=""><div> <span class="fa fa-dot-circle">  </span> <?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> Photo Request Sent </div></a></div>
					<div><a style="text-decoration: none;" href=""><div> <span class="fa fa-dot-circle">  </span>  <?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> Photo Request Recieved </div></a></div>
					
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div style="box-shadow: 0 0 6px rgba(0,0,0,.2); border-radius: 10px; padding: 10px;">
			<div class="row">
				<div class="col-md-6">
					<p>Profile ID: <b><?php echo $marriageprofile->marriage_profile_id ?></b> </p> 
					<p>Created By: <b><?php echo $marriageprofile->profile_by ?></b> </p> 
					<p>Profile Status: <b style="color: red;">Inactive</b> </p>	
				</div>
				<div style="text-align: right;" class="col-md-6">
					<p>Profile Name: <b><?php echo $marriageprofile->first_name.' '.$marriageprofile->last_name ?></b> </p> 
					<p>Member Type: <b>Free</b> </p> 
				</div>
			</div> 
			<div style="margin-top: 20px;">
				<div style="border:1px solid #DDD; border-radius: 10px; padding: 10px;">
					<div class="row">
						<div class="col-md-9">
							<div style="background-color: #efefef; padding: 5px; color: #b14343; font-weight: bold;">Manage <?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> Profile </div>
							<div style="padding: 10px;">
								<div class="row">
									<div class="col-md-6">
										<div>
											<img src="https://www.re-marriage.in/images/5-add_contact_details_sml.gif"><span style="padding-left: 20px; padding-top: 5px;"><a href="">Edit Contact Details</a></span>
										</div>
										<div style="margin-top: 10px;">
											<img src="https://www.re-marriage.in/images/5-profile_sml.gif"><span style="padding-left: 20px; padding-top: 5px;"><a href="">Edit Personal Profile</a></span>
										</div>
										<div style="margin-top: 10px;">
											<img src="https://www.re-marriage.in/images/5-hide_delete_profile_sml.gif"><span style="padding-left: 20px; padding-top: 5px;"><a href="">Hide/Delete Profile</a></span>
										</div>
										<div style="margin-top: 10px;">
											<img src="https://www.re-marriage.in/images/5-my_profile_statistics_sml.gif"><span style="padding-left: 20px; padding-top: 5px;"><a href="">View Profile Statistics</a></span>
										</div>	
									</div>
									<div class="col-md-6">
										<div>
											<img src="https://www.re-marriage.in/images/5-add_contact_details_sml.gif"><span style="padding-left: 20px; padding-top: 5px;"><a href="">Set Partner Profile</a></span>
										</div>	
									</div>
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
				<div style="margin-top: 20px; background-color: #efefef; padding: 5px; color: #b14343; font-weight: bold;">About <?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?></div>
				<div style="margin-top: 20px;">
					  <div class="panelcustom">
				        <div class="row">
				          <div class="col-md-6">
				             <b><?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> Basics </b> 
				          </div>
				          <?php if ($this->user->info->ID == $marriageprofile->users_id) { ?>
				          <div style="text-align: right;" class="col-md-6 col-xs-6">
				               <div id="showeditbutton">
				                <a href="<?php echo site_url('marriage/editbasics/').$marriageprofile->marriage_profile_id ?>"><button class="btn btn-danger btn-xs">Edit</button></a>
				              </div>
				          </div>
				          <?php } ?>
				        </div>
				      </div>
				      <div  class="panelbodycustom">
				          <div style="padding: 10px;" class="row">
				              <div class="col-md-6 ">
				                <b>Name : </b> <?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?>
				              </div>
				              <div class="col-md-6">
				                <b>Age : </b><?php
				                    echo $marriageprofile->age;
				                ?> Years
				              </div>
				          </div>
				          <div style="padding: 10px;" class="row">
				              <div class="col-md-6  ">
				                <b>Gender : </b> <?php echo $marriageprofile->gender ?> 
				              </div>
				              <div class="col-md-6  ">
				                <b>Date Of Birth : </b><?php echo $marriageprofile->day_of_birth."/".$marriageprofile->month_of_birth."/".$marriageprofile->year_of_birth; ?> 
				              </div>
				          </div>
				          <div style="padding: 10px;" class="row">
				              <div class="col-md-6  ">
				                <b>Marital Status : </b> <?php echo $marriageprofile->marital_status ?> 
				              </div>
				              <div class="col-md-6  ">
				                <b>Have Children : </b> <?php echo $marriageprofile->having_children; ?> 
				              </div>
				          </div>
				          <div style="padding: 10px;" class="row">
				              <div class="col-md-6">
				                <b>No Of Children : </b> <?php echo $marriageprofile->male_children+$marriageprofile->female_children ?> 
				              </div>
				              <div class="col-md-6">
				                <b>Height : </b> <?php echo $marriageprofile->height; ?>
				              </div>
				          </div>
				          <div style="padding: 10px;" class="row">
				              <div class="col-md-6  ">
				                <b>Weight : </b> <?php echo $marriageprofile->weight ?> 
				              </div>
				              <div class="col-md-6">
				                <b>Blood Group : </b> <?php echo $marriageprofile->blood_group; ?> 
				              </div>
				          </div>
				          <div style="padding: 10px;" class="row">
				              <div class="col-md-6">
				                <b>Body Type : </b> <?php echo $marriageprofile->body_type ?> 
				              </div>
				              <div class="col-md-6">
				                <b>Complexion : </b> <?php echo $marriageprofile->complexion; ?> 
				              </div>
				          </div>
				      </div>
				      <div class="panelcustom">
				           <b><?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> Religious & Social Background</b> 
				      </div>
				      <?php if ($this->user->info->ID == $marriageprofile->users_id) { ?>
				          <div style="margin-left: 543px;" class="col-md-6 ">
				               <div id="showeditbutton">
				                <a href="<?php echo site_url('marriage/edit_social/').$marriageprofile->marriage_profile_id ?>"><button class="btn btn-danger btn-xs" style="margin-top:-60px;">Edit</button></a>
				              </div>
				          </div>
				          <?php } ?>
				      <div  class="panelbodycustom">
				          <div style="padding: 10px;" class="row">
				              <div class="col-md-6">
				                <b>Religion: </b> <?php if(!empty($marriageprofile->country_of_birth)){ ?>
				                <?php echo $this->marriage_model->getreligionname($marriageprofile->relegion)->row()->name; ?> 
				              <?php } ?>
				              </div>
				              <div class="col-md-6">
				                <b>Comunity : </b> <?php if(!empty($marriageprofile->relegion_comunity)){ ?>
				                <?php echo $this->marriage_model->getcomunityname($marriageprofile->relegion_comunity)->row()->name; ?> 
				              <?php } ?>
				              </div>
				          </div>
				          <div style="padding: 10px;" class="row">
				              <div class="col-md-6  ">
				                <b>Cast : </b> <?php echo $marriageprofile->other_caste ?> 
				              </div>
				              <div class="col-md-6  ">
				                <b>Family Values : </b> <?php echo $marriageprofile->family_values; ?> 
				              </div>
				          </div>
				          <div style="padding: 10px;" class="row">
				              <div class="col-md-6  ">
				                <b>Mother Tounge : </b>  <?php echo $marriageprofile->mother_tounge ?> 
				              </div>
				          </div>         
				      </div>
				      <div class="panelcustom">
           <b><?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> </b> Horoscope Information
      </div>
      <?php if ($this->user->info->ID == $marriageprofile->users_id) { ?>
          <div style="margin-left: 543px;" class="col-md-6 ">
               <div id="showeditbutton">
                <a href="<?php echo site_url('marriage/horscope/').$marriageprofile->marriage_profile_id ?>"><button class="btn btn-danger btn-xs" style="margin-top:-60px;">Edit</button></a>
              </div>
          </div>
          <?php } ?>
          
      <div  class="panelbodycustom">
          <div style="padding: 10px;" class="row">
              <div class="col-md-6  ">
                <b>Country Of Birth:</b> <?php if(!empty($marriageprofile->country_of_birth)){ ?>
                <?php echo $this->marriage_model->getcountryname($marriageprofile->country_of_birth)->row()->name; ?> 
                 <?php } ?>
              </div>
              <div class="col-md-6  ">
                <b>State Of Birth : </b> <?php if(!empty($marriageprofile->state_of_birth)){ ?>
                <?php echo $this->marriage_model->getstatename($marriageprofile->state_of_birth)->row()->name;  ?> 
              <?php } ?>
              </div>
          </div>
          <div style="padding: 10px;" class="row">
              <div class="col-md-6  ">
                <b>City Of Birth : </b> <?php if(!empty($marriageprofile->city_of_birth)){ ?>
                <?php echo $this->marriage_model->getcityname($marriageprofile->city_of_birth)->row()->name; ?> 
                <?php } ?>
              </div>
              <div class="col-md-6  ">
                <b>Star : </b> <?php echo $marriageprofile->star; ?> 
              </div>
          </div>
          <div style="padding: 10px;" class="row">
              <div class="col-md-6  ">
                <b>Manglik  :</b> <?php echo $marriageprofile->manglink ?>
              </div>
              <div class="col-md-6  ">
                <b>Moon sign : </b> <?php echo $marriageprofile->moon_sign ?>
              </div>
          </div>
      </div>

      <div class="panelcustom">
           <b><?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> </b> Education & Career
      </div>
      <?php if ($this->user->info->ID == $marriageprofile->users_id) { ?>
          <div style="margin-left: 543px;" class="col-md-6 ">
               <div id="showeditbutton">
                <a href="<?php echo site_url('marriage/edit_career/').$marriageprofile->marriage_profile_id ?>"><button class="btn btn-danger btn-xs" style="margin-top:-60px;">Edit</button></a>
              </div>
          </div>
          <?php } ?>
      <div  class="panelbodycustom">
          <div style="padding: 10px;" class="row">
              <div class="col-md-3  ">
                <b>Education</b>
              </div>
              <div class="col-md-9  ">
                <?php echo $marriageprofile->education_in." IN ".$marriageprofile->education_to ?> 
              </div>
          </div>
          <div style="padding: 10px;" class="row">
              <div class="col-md-3 col-xs-3">
                <b>Education Description</b>
              </div>
              <div class="col-md-9 col-xs-12">
                <?php echo $marriageprofile->education_description ?> 
              </div>
          </div>
          <div style="padding: 10px;" class="row">
              <div class="col-md-3  ">
                <b>Occupation:</b>
              </div>
              <div class="col-md-6  ">
                <?php echo $marriageprofile->occupation ?> 
              </div>
          </div>
          <div style="padding: 10px;" class="row">
              <div class="col-md-3  ">
                <b>Occupation Description</b>
              </div>
              <div class="col-md-6  ">
                <?php echo $marriageprofile->occupation_description ?> 
              </div>
          </div>
          <div style="padding: 10px;" class="row">
              <div class="col-md-3  ">
                <b>Anual Income</b>
              </div>
              <div class="col-md-6  ">
                <?php echo $marriageprofile->anual_income ?> 
              </div>
          </div>
          <div style="padding: 10px;" class="row">
              <div class="col-md-3  ">
                <b>Assets</b>
              </div>
              <div class="col-md-6  ">
                <?php echo $marriageprofile->assets ?> 
              </div>
          </div>
      </div>
      <div class="panelcustom">
           <b><?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> </b> Life Style
      </div>
      <?php if ($this->user->info->ID == $marriageprofile->users_id) { ?>
          <div style="margin-left: 543px;" class="col-md-6 ">
               <div id="showeditbutton">
                <a href="<?php echo site_url('marriage/edit_lifestyle/').$marriageprofile->marriage_profile_id ?>"><button class="btn btn-danger btn-xs" style="margin-top:-60px;">Edit</button></a>
              </div>
          </div>
          <?php } ?>
      <div  class="panelbodycustom">
          <div style="padding: 10px;" class="row">
              <div class="col-md-3  ">
                <b>Diet</b>
              </div>
              <div class="col-md-3  ">
                <?php echo $marriageprofile->diet ?> 
              </div>
              <div class="col-md-3  ">
                <b>Smoke</b>
              </div>
              <div class="col-md-3  ">
                <?php echo $marriageprofile->smoke ?> 
              </div>
          </div>
          <div style="padding: 10px;" class="row">
              <div class="col-md-3  ">
                <b>Drink</b>
              </div>
              <div class="col-md-3  ">
                <?php echo $marriageprofile->drink ?> 
              </div>
          </div>
      </div>
      <div class="panelcustom">
           <b><?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> </b> Location and Contact Details
      </div>
      <?php if ($this->user->info->ID == $marriageprofile->users_id) { ?>
          <div style="margin-left: 543px;" class="col-md-6 ">
               <div id="showeditbutton">
                <a href="<?php echo site_url('marriage/edit_location/').$marriageprofile->marriage_profile_id ?>"><button class="btn btn-danger btn-xs" style="margin-top:-60px;">Edit</button></a>
              </div>
          </div>
          <?php } ?>
      <div  class="panelbodycustom">
          <div style="padding: 10px;" class="row">
              <div class="col-md-3  ">
                <b>Country</b>
              </div>
              <div class="col-md-3  ">
                 <?php if(!empty($marriageprofile->country_of_resedence)){ ?>
                <?php echo $this->marriage_model->getcountryname($marriageprofile->country_of_resedence)->row()->name; ?>
              <?php } ?>
             
              </div>
              <div class="col-md-3  ">
                <b>State</b>
              </div>
              <div class="col-md-3  ">
                  <?php if(!empty($marriageprofile->state_of_resedence)){ ?>
                  <?php echo $this->marriage_model->getstatename($marriageprofile->state_of_resedence)->row()->name;  ?> 
                  <?php } ?>
              </div>
          </div>
          <div style="padding: 10px;" class="row">
              <div class="col-md-3  ">
                <b>City</b>
              </div>
              <div class="col-md-3  ">
                <?php if(!empty($marriageprofile->city_of_resedence)){ ?>
                <?php echo $marriageprofile->city_of_resedence ?>
                     <?php } ?>
              </div>
          </div>
        <div style="padding: 10px;" class="row">
              <div class="col-md-3  ">
                <b>Zip</b>
              </div>
              <div class="col-md-3  ">
                <?php if(!empty($marriageprofile->zip_code )){ ?>
                <?php echo $marriageprofile->zip_code  ?>
                     <?php } ?>
              </div>
          </div>
        <div style="padding: 10px;" class="row">
              <div class="col-md-3  ">
                <b>Address Line 1 :</b>
              </div>
              <div class="col-md-3  ">
                <?php if(!empty($marriageprofile->address_line_1 )){ ?>
                <?php echo $marriageprofile->address_line_1  ?>
                     <?php } ?>
              </div>
          </div>
          <div style="padding: 10px;" class="row">
              <div class="col-md-3  ">
                <b>Address Line 2 :</b>
              </div>
              <div class="col-md-3  ">
                <?php if(!empty($marriageprofile->address_line_2 )){ ?>
                <?php echo $marriageprofile->address_line_2  ?>
                     <?php } ?>
              </div>
          </div>
      </div>
      <div class="panelcustom">
           <b><?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> </b> Hobbies & Intrest
      </div>
      <?php if ($this->user->info->ID == $marriageprofile->users_id) { ?>
          <div style="margin-left: 543px;" class="col-md-6 ">
               <div id="showeditbutton">
                <a href="<?php echo site_url('marriage/edit_hobbies/').$marriageprofile->marriage_profile_id ?>"><button class="btn btn-danger btn-xs" style="margin-top:-60px;">Edit</button></a>
              </div>
          </div>
          <?php } ?>
      <div  class="panelbodycustom">
          <div style="padding: 10px;" class="row">
              <div class="col-md-3">
                <b>Hobbies</b>
              </div>
              <div class="col-md-9">
                <?php if(!empty($marriageprofile->hobies)){ ?>
                <?php   $hobbies = json_decode($marriageprofile->hobies);
                  $i=0;
                  foreach($hobbies as $hobby)
                  {
                    if($i>0)
                    {
                      echo ', '.$hobby;
                    }
                    else
                    {
                      echo $hobby;
                    }
                    $i++;
                  }
                }
                 ?> 
              </div>
          </div>
          <div style="padding: 10px;" class="row">
              <div class="col-md-3">
                <b>Intrests</b>
              </div>
              <div class="col-md-9 ">
                <?php if(!empty($marriageprofile->intrests)){ ?>
                <?php   $intrests = json_decode($marriageprofile->intrests);
                  $e=0;
                  foreach($intrests as $r)
                  {
                    if($e>0)
                    {
                      echo ', '.$r;
                    }
                    else
                    {
                      echo $r;
                    }
                    $e++;
                  }
                }
                 ?> 
              </div>
          </div>
          <div style="padding: 10px;" class="row">
              <div class="col-md-3">
                <b>Prefferd Dress</b>
              </div>
              <div class="col-md-9 ">
                <?php   echo $marriageprofile->prefferddress;  ?> 
              </div>
          </div>
      </div>
      <div class="panelcustom">
           <b><?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> </b> Personality, Life Goals, Partner Expectations, etc
      </div>
      <div  class="panelbodycustom">
          <div style="padding: 10px;">
             <?php   echo $marriageprofile->describepersonality;  ?> 
          </div>
      </div> 
      <div class="panelcustom">
           <b><?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> </b> Family Background 
      </div>
<?php if ($this->user->info->ID == $marriageprofile->users_id) { ?>
          <div style="margin-left: 543px;" class="col-md-6 ">
               <div id="showeditbutton">
                <a href="<?php echo site_url('marriage/edit_family/').$marriageprofile->marriage_profile_id ?>"><button class="btn btn-danger btn-xs" style="margin-top:-60px;">Edit</button></a>
              </div>
          </div>
          <?php } ?>
      <div  class="panelbodycustom">
          <div style="padding: 10px;" class="row">
              <div class="col-md-3  ">
                <b>Family Status</b>
              </div>
            
              <div class="col-md-6  ">
                <?php echo $marriageprofile->familystatus ?> 
              </div>
          </div>
          <div style="padding: 10px;" class="row">
              <div class="col-md-6">
                <b>Father Details</b>
              </div>
              <div class="col-md-6  ">
                <b>Mother Details</b>
              </div>
          </div>
          <div style="padding: 10px;" class="row">
              <div class="col-md-6">
                <b>Name: </b><span class="subspanclass"><?php echo $marriageprofile->fathername; ?></span>
              </div>
              <div class="col-md-6  ">
                <b>Name: </b><span class="subspanclass"><?php echo $marriageprofile->mothername; ?></span>
              </div>
          </div>
          <div style="padding: 10px;" class="row">
              <div class="col-md-6">
                <b>Occupation: </b><span class="subspanclass"><?php echo $marriageprofile->father_occup; ?></span>
              </div>
              <div class="col-md-6  ">
                <b>Occupation: </b><span class="subspanclass"><?php echo $marriageprofile->mother_occup; ?></span>
              </div>
          </div>
          <div style="padding: 10px;" class="row">
              <div class="col-md-6">
                <b>Brothers Details</b>
              </div>
              <div class="col-md-6  ">
                <b>Sisters Details</b>
              </div>
          </div>
          <div style="padding: 10px;" class="row">
              <div class="col-md-6">
                <?php if(!empty($marriageprofile->havebrothers)){
                  echo "Have Brothers ";
                  echo $marriageprofile->marriedbrother+$marriageprofile->unmarriedbrother." of Which Married ".$marriageprofile->marriedbrother;
                } ?>
              </div>
              <div class="col-md-6  ">
                <?php if(!empty($marriageprofile->havesisters)){
                  echo "Have Sisters ";
                 echo $marriageprofile->unmarriedsister+$marriageprofile->marriedsister." of Which Married ".$marriageprofile->marriedsister;
                } ?>
              </div>
          </div>                              
      </div>
      <div class="panelcustom">
          About  <b><?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> </b> Family 
      </div>
      <?php if ($this->user->info->ID == $marriageprofile->users_id) { ?>
          <div style="margin-left: 543px;" class="col-md-6 ">
               <div id="showeditbutton">
                <a href="<?php echo site_url('marriage/edit_familydescription/').$marriageprofile->marriage_profile_id ?>"><button class="btn btn-danger btn-xs" style="margin-top:-60px;">Edit</button></a>
              </div>
          </div>
          <?php } ?>
      <div  class="panelbodycustom">
          <div style="padding: 10px;">
             <?php   echo $marriageprofile->describefamily;  ?> 
          </div>
      </div>
				</div>
			</div>
		</div>
	</div>
</div>