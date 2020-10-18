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
  #requestphotos:hover{
  	text-decoration: underline;
  }
  #requestcontact:hover{
    text-decoration: underline;
  }
  #requestfavourite:hover{
    text-decoration: underline;
  }
</style>
<script type="text/javascript">
	$(document).ready(function(){
  	$("#requestphotos").click(function(){
       $("#requestcontactsshow").hide();
        $("#favouriteshow").hide();
        $("#requestphotosshow").fadeIn();
  });

    $("#requestcontact").click(function(){
      $("#requestphotosshow").hide();
      $("#favouriteshow").hide();
    $("#requestcontactsshow").fadeIn();
  });

  $("#requestfavourite").click(function(){
      $("#requestphotosshow").hide();
    $("#requestcontactsshow").hide();
     $("#favouriteshow").fadeIn();
  });  

    $("#marriageprofileid").change(function(){
      $("#errormessage").hide();
      $("#marriageprofileid").css("border-color", "green");
    });

    $("#marriageprofileidforcontact").change(function(){
      $("#errormessagecontact").hide();
      $("#marriageprofileidforcontact").css("border-color", "green");
    });


    $("#marriageprofileidforfavourite").change(function(){
      $("#errormessagefavourite").hide();
      $("#marriageprofileidforfavourite").css("border-color", "green");
    });

    
});

	function sendphotosrequest(id)
	{
		var msg = $('#messagephotos').val();
    var marriageprofileid = $('#marriageprofileid').val();
    if (marriageprofileid == "") {
      $("#marriageprofileid").css("border-color", "red");
      $("#errormessage").show();
    }else{
	 $.ajax({ 
	      url: '<?php echo site_url('marriage/sendrequestforphotos/'); ?>',
	      type: 'POST',
		  data: { message : msg, profileid : id , frommarriageid:marriageprofileid},
	      success: function(resp){
          $('#messagephotos').empty();
	      	swal(resp);
	      }
	    });
  }
	}
  function sendcontactsrequest(id)
  {
    var msg = $('#messagecontact').val();
    var marriageprofileid = $('#marriageprofileidforcontact').val();
    if (marriageprofileid == "") {
      $("#marriageprofileidforcontact").css("border-color", "red");
      $("#errormessagecontact").show();
    }else{
   $.ajax({ 
        url: '<?php echo site_url('marriage/sendrequestforcontact/'); ?>',
        type: 'POST',
      data: { message : msg, profileid : id , frommarriageid:marriageprofileid},
        success: function(resp){
          $('#messagecontact').empty();
          swal(resp);
        }
      });
  }
  }


  function addfavourite(id)
  {
    var marriageprofileid = $('#marriageprofileidforfavourite').val();
    if (marriageprofileid == "") {
      $("#marriageprofileidforfavourite").css("border-color", "red");
      $("#errormessagefavourite").show();
    }else{
   $.ajax({ 
        url: '<?php echo site_url('marriage/addfavourite/'); ?>',
        type: 'POST',
      data: { profileid : id , frommarriageid:marriageprofileid},
        success: function(resp){
          swal(resp);
        }
      });
  }
  }
</script>
<div  class="row">
	<div class="col-md-3">
		
	</div>
	<div style="margin-top: 20px;" class="col-md-9">
		<div style="box-shadow: 0 0 6px rgba(0,0,0,.2); border-radius: 10px; padding: 10px; margin-bottom: 20px; margin-top: 20px;">
			<div class="row">
				<div class="col-md-6">
					<span style="color: green; font-weight: bold;"><?php echo $marriageprofile->first_name.' '.$marriageprofile->last_name ?></span>
				</div>
				<div style="text-align: right;" class="col-md-6">
					<span style="color: green; font-weight: bold;">Profile Id: <span style="color: red;"><?php echo $marriageprofile->marriage_profile_id ?></span></span>
				</div>
			</div>
		</div>
		<div style="box-shadow: 0 0 6px rgba(0,0,0,.2); border-radius: 10px; padding: 10px;">
      <div class="row">
        <div class="col-md-6">
          <p>Created By: <b><?php echo $marriageprofile->profile_by ?></b> </p> 
        </div>
        <div style="text-align: right;" class="col-md-6">
          <p>Member Type: <b>Free</b> </p> 
        </div>
      </div> 
      <div style="margin-top: 20px;">
        <div style="border:1px solid #DDD; border-radius: 10px; padding: 10px;">
          <div class="row">
            <div class="col-md-9">
              <div style="padding: 10px;">
                    <div>
                      <i class="fa fa-mobile"></i><span style="padding-left: 20px; padding-top: 5px;"><span style="color: #337ab7; cursor: pointer;" id="requestcontact">Request Contact Details</span></span>
                    </div>
                    <div style="margin-top: 10px;">
                      <i class="fa fa-file"></i><span style="padding-left: 20px; padding-top: 5px;"><span style="color: #337ab7; cursor: pointer;" id="requestphotos">Request Photos</span></span>
                    </div>
                    <div style="margin-top: 10px;">
                      <i class="fa fa-heart"></i><span style="padding-left: 16px; padding-top: 5px;"><span style="color: #337ab7; cursor: pointer;" id="requestfavourite">Add To favourite Members</span></span>
                    </div>
              </div>  
            </div>
            <div class="col-md-3">
              <div style="border:1px solid #DDD; border-radius: 10px; padding: 5px;">
                  <img style="height: 100%; width: 100%;" src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $marriageprofile->profileimage ?>">
              </div> 
            </div>
          </div>












          <div id="requestphotosshow" style="display: none;">
            <span style="display: none; color: red;" id="errormessage">Please Select Marriage Profile First. <a href="<?php echo site_url('marriage/createnew/').rand(10000000 , 1000000000) ?>">Create Profile</a></span>
            <select id="marriageprofileid" style="margin-bottom: 10px; margin-top: 10px;" class="form-control">
                <option value="">Select Marriage Profile</option>
                <?php foreach ($this->marriage_model->getmarriageprofilebyuser()->result() as $key ) { ?>
                  <option value="<?php echo $key->marriage_profile_id; ?>"><?php echo $key->first_name." ".$key->last_name. " (".$key->marriage_profile_id.")";  ?></option>
                <?php } ?>
            </select>
            <div  >
              <textarea placeholder="Type Any Message........" rows="5" class="form-control" id="messagephotos"></textarea>
              <button style="margin-top: 10px;" onclick="sendphotosrequest(<?php echo $marriageprofile->marriage_profile_id ?>)" class="btn btn-success">Request Photos</button>
             </div>
          </div>










          <div id="requestcontactsshow" style="display: none;">
            <span style="display: none; color: red;" id="errormessagecontact">Please Select Marriage Profile First. <a href="<?php echo site_url('marriage/createnew/').rand(10000000 , 1000000000) ?>">Create Profile</a></span>
            <select id="marriageprofileidforcontact" style="margin-bottom: 10px; margin-top: 10px;" class="form-control">
                <option value="">Select Marriage Profile</option>
                <?php foreach ($this->marriage_model->getmarriageprofilebyuser()->result() as $key ) { ?>
                  <option value="<?php echo $key->marriage_profile_id; ?>"><?php echo $key->first_name." ".$key->last_name. " (".$key->marriage_profile_id.")";  ?></option>
                <?php } ?>
            </select>
            <div  >
              <textarea placeholder="Type Any Message........" rows="5" class="form-control" id="messagecontact"></textarea>
              <button style="margin-top: 10px;" onclick="sendcontactsrequest(<?php echo $marriageprofile->marriage_profile_id ?>)" class="btn btn-success">Request Contact Details</button>
             </div>
          </div>




          <div id="favouriteshow" style="display: none;">
            <span style="display: none; color: red;" id="errormessagefavourite">Please Select Marriage Profile First. <a href="<?php echo site_url('marriage/createnew/').rand(10000000 , 1000000000) ?>">Create Profile</a></span>
            <select id="marriageprofileidforfavourite" style="margin-bottom: 10px; margin-top: 10px;" class="form-control">
                <option value="">Select Marriage Profile</option>
                <?php foreach ($this->marriage_model->getmarriageprofilebyuser()->result() as $key ) { ?>
                  <option value="<?php echo $key->marriage_profile_id; ?>"><?php echo $key->first_name." ".$key->last_name. " (".$key->marriage_profile_id.")";  ?></option>
                <?php } ?>
            </select>
            <div  >
              <button style="margin-top: 10px;" onclick="addfavourite(<?php echo $marriageprofile->marriage_profile_id ?>)" class="btn btn-success">Add To Favourities</button>
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
      <div class="panelcustom">
           <b><?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> </b>Patner Profile 
      </div>
     <?php if ($this->user->info->ID == $marriageprofile->users_id) { ?>
          <div style="margin-left: 543px;" class="col-md-6 ">
               <div id="showeditbutton">
                <a href="<?php echo site_url('marriage/edit_familydescription/').$patnerprofile->marriage_profile_id ?>"><button class="btn btn-danger btn-xs" style="margin-top:-60px;">Edit</button></a>
              </div>
          </div>
          <?php } ?>
         <div  class="panelbodycustom">
         <div style="padding: 10px;" class="row">
              <div class="col-md-6">
                <b>Gender :</b> 
                <?php if(!empty($patnerprofile->gender)){ ?>
                <span class="subspanclass"><?php echo $patnerprofile->gender ?></span>

              <?php  } ?>
              </div>
              <div class="col-md-6  ">
                <b>Age Range :</b>
                  <?php if(!empty($patnerprofile->agerange)){ ?>
                <span class="subspanclass"><?php echo $patnerprofile->agerange ?></span>
              <?php  } ?>
              </div>
          </div>
          <div style="padding: 10px;" class="row">
              <div class="col-md-6">
                <b>Marital Status :</b> 
                <?php if(!empty($patnerprofile->maritalstatus  )){ ?>
                <span class="subspanclass"><?php echo $patnerprofile->maritalstatus  ?><?php echo $patnerprofile->havchildren ?></span>
              <?php  } ?>
              </div>
              <div class="col-md-6  ">
                <b>Height :</b>
                 <?php if(!empty($patnerprofile->height)){ ?>
                <span class="subspanclass"><?php echo $patnerprofile->height ?></span>
              <?php  } ?>
              </div>
          </div>
         
              <div style="padding: 10px;" class="row">
              <div class="col-md-6">
                <b>Body type :</b>
                <?php if(!empty($patnerprofile->bodytype)){ ?>
                <span class="subspanclass"><?php echo $patnerprofile->bodytype ?></span>
                <?php  } ?>
              </div>
              <div class="col-md-6  ">
                <b>Complexion :</b>
                <?php if(!empty($patnerprofile->complexion)){ ?>
                <span class="subspanclass"><?php echo $patnerprofile->complexion ?></span>
                <?php  } ?>
              </div>
             </div>
             <div style="padding: 10px;" class="row">
                      <div class="col-md-6 ">
                        <b>Special Cases  : </b> 
                         <?php if(!empty($patnerprofile->specialcases)){ ?>
                        <span class="subspanclass"><?php echo $patnerprofile->specialcases; ?></span>
                        <?php  } ?> 

                      </div>
                  </div>
        </div>
        <div class="panelcustom">
           <b><?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> </b> Partner's Religious & Social Background
        </div>
          <?php if ($this->user->info->ID == $marriageprofile->users_id) { ?>
          <div style="margin-left: 543px;" class="col-md-6 ">
               <div id="showeditbutton">
                <a href="<?php echo site_url('marriage/edit_p_social/').$marriageprofile->marriage_profile_id ?>"><button class="btn btn-danger btn-xs" style="margin-top:-60px;">Edit</button></a>
              </div>
          </div>
          <?php } ?>

           <div  class="panelbodycustom">
           <div style="padding: 10px;" class="row">
              <div class="col-md-6">
                <b>Religion :</b> 
                <?php //echo '<pre>';print_r($patnerprofile);echo'</pre>'; ?>
                <?php if(!empty($patnerprofile->relijion)){ ?>
                <span class="subspanclass"><?php echo $patnerprofile->relijion ?><?php echo $patnerprofile->comunity ?></span>
                <?php  } ?> 

                 
               
               </div>
               <div class="col-md-6  ">
                <b>Faimly Values : </b>
                  <?php if(!empty($patnerprofile->familyvalues)){ ?>
                <span class="subspanclass"><?php echo $patnerprofile->familyvalues ?></span>
              <?php  } ?>
              </div>
          </div>
      </div>
       <div class="panelcustom">
           <b><?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> </b> Partner's Education & Career
      </div>
     <?php if ($this->user->info->ID == $marriageprofile->users_id) { ?>
          <div style="margin-left: 543px;" class="col-md-6 ">
               <div id="showeditbutton">
                <a href="<?php echo site_url('marriage/edit_p_career/').$marriageprofile->marriage_profile_id ?>"><button class="btn btn-danger btn-xs" style="margin-top:-60px;">Edit</button></a>
              </div>
          </div>
          <?php } ?>
      <div  class="panelbodycustom">
         <div style="padding: 10px;" class="row">
              <div class="col-md-6">
                <b>Education : </b> 
                 <?php // echo '<pre>';print_r($patnerprofile);echo'</pre>'; ?>
                <?php if(!empty($patnerprofile->education)){ ?>
                <span class="subspanclass"><?php echo $patnerprofile->education ?></span>
              <?php  } ?>
              </div>
              <div class="col-md-6  ">
                <b>Ocupation : </b>
                  <?php if(!empty($patnerprofile->ocupation)){ ?>
                <span class="subspanclass"><?php echo $patnerprofile->ocupation ?></span>
              <?php  } ?>
              </div>
          </div>
      </div>
        <div class="panelcustom">
           <b><?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> </b> Partner's Lifestyle
      </div>
      <?php if ($this->user->info->ID == $marriageprofile->users_id) { ?>
          <div style="margin-left: 543px;" class="col-md-6 ">
               <div id="showeditbutton">
                <a href="<?php echo site_url('marriage/edit_p_lifestyle/').$marriageprofile->marriage_profile_id ?>"><button class="btn btn-danger btn-xs" style="margin-top:-60px;">Edit</button></a>
              </div>
    
          </div>
          <?php } ?>
      <div  class="panelbodycustom">
         <div style="padding: 10px;" class="row">
              <div class="col-md-6">
                <b>Diet  : </b> 
                <?php if(!empty($patnerprofile->diet)){ ?>
                <span class="subspanclass"><?php echo $patnerprofile->diet ?></span>
              <?php  } ?>
              </div>
              <div class="col-md-6  ">
                <b>Smoke : </b>
                  <?php if(!empty($patnerprofile->smoke)){ ?>
                <span class="subspanclass"><?php echo $patnerprofile->smoke ?></span>
              <?php  } ?>
              </div>
          </div>
          <div style="padding: 10px;" class="row">
              <div class="col-md-6">
                <b>Drink  : </b> 
                <?php if(!empty($patnerprofile->drink)){ ?>
                <span class="subspanclass"><?php echo $patnerprofile->drink ?></span>
              <?php  } ?>
              </div>
             
          </div>
      </div>

       <div class="panelcustom">
           <b><?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> </b> Partner's Location
      </div>
      <?php if ($this->user->info->ID == $marriageprofile->users_id) { ?>
          <div style="margin-left: 543px;" class="col-md-6 ">
               <div id="showeditbutton">
                <a href="<?php echo site_url('marriage/edit_p_location/').$marriageprofile->marriage_profile_id ?>"><button class="btn btn-danger btn-xs" style="margin-top:-60px;">Edit</button></a>
              </div>
          </div>
          <?php } ?>
      <div  class="panelbodycustom">
         <div style="padding: 10px;" class="row">
              <div class="col-md-6">
                <b>Country  : </b> 
                <?php if(!empty($patnerprofile->country)){ ?>
                <span class="subspanclass"><?php echo $patnerprofile->country ?></span>
              <?php  } ?>
              </div>
              <div class="col-md-6  ">
                <b>State : </b>
                  <?php if(!empty($patnerprofile->statename )){ ?>
                <span class="subspanclass"><?php echo $patnerprofile->statename ?></span>
              <?php  } ?>
              </div>
          </div>
          <div style="padding: 10px;" class="row">
              <div class="col-md-6">
                <b>City : </b> 
                <?php if(!empty($patnerprofile->cityname )){ ?>
                <span class="subspanclass"><?php echo $patnerprofile->cityname ?></span>
              <?php  } ?>
              </div>
             
          </div>
      </div>
          
    


        </div>
      </div>
    </div>
	</div>
</div>