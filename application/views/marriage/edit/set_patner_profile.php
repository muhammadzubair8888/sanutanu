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
  <div class="col-md-4 col-xs-4">
    <?php include(APPPATH . "/views/marriage/sidebar.php"); ?>
    <div style="margin-top: 20px;">
      <a target="_blank" href="https://www.emailaudience.com/wp-content/uploads/2013/09/cusp-rules-of-cool.gif">
      <img style="height: 100%; width: 100%;" src="https://www.emailaudience.com/wp-content/uploads/2013/09/cusp-rules-of-cool.gif"></a>
    </div>
    <div style="margin-top: 20px;">
      <a target="_blank" href="https://infiniteingenuity.files.wordpress.com/2015/03/animation.gif">
      <img style="height: 100%; width: 100%;" src="https://infiniteingenuity.files.wordpress.com/2015/03/animation.gif"></a>
    </div>
    
  </div>
  <div class="col-md-8 col-xs-8">
    <div style="box-shadow: 0 0 6px rgba(0,0,0,.2); border-radius: 10px; padding: 10px;">
    <?php include(APPPATH . "/views/marriage/profileinformation.php"); ?>
      <div style="margin-top: 20px;">
        <div style="border:1px solid #DDD; border-radius: 10px; padding: 10px;">
          <div class="row">
            <div class="col-md-9">
              <div style="background-color: #efefef; padding: 5px; color: #b14343; font-weight: bold;">Manage <?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> Profile </div>
              <div style="padding: 10px;">
                <div class="row">
                  <div class="col-md-6">
                    <div>
                      <img src="https://www.re-marriage.in/images/5-add_contact_details_sml.gif"><span style="padding-left: 20px; padding-top: 5px;"><a href="<?php echo site_url('marriage/editbasics/').$marriageprofile->marriage_profile_id ?>">Edit Contact Details</a></span>
                    </div>
                    <div style="margin-top: 10px;">
                      <img src="https://www.re-marriage.in/images/5-profile_sml.gif"><span style="padding-left: 20px; padding-top: 5px;"><a href="<?php echo site_url('marriage/edit_personalprofile/').$marriageprofile->marriage_profile_id ?>">Edit Personal Profile</a></span>
                    </div>
                     <div style="margin-top: 10px;">
                      <img src="https://www.re-marriage.in/images/5-hide_delete_profile_sml.gif"><span style="padding-left: 20px; padding-top: 5px;"><a href="<?php echo site_url('marriage/hide_delete_profile/').$marriageprofile->marriage_profile_id ?>">Hide/Delete Profile</a></span>
                    </div>
                    <div style="margin-top: 10px;">
                      <img src="https://www.re-marriage.in/images/5-my_profile_statistics_sml.gif"><span style="padding-left: 20px; padding-top: 5px;"><a href="">View Profile Statistics</a></span>
                    </div>  
                  </div>
                  <div class="col-md-6">
                    <div>
                      <img src="https://www.re-marriage.in/images/5-add_contact_details_sml.gif"><span style="padding-left: 20px; padding-top: 5px;"><a href="<?php echo site_url('marriage/set_patner_profile/').$marriageprofile->marriage_profile_id ?>">Set Partner Profile</a></span>
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
       <div style="margin-top: 20px; background-color: #efefef; padding: 5px; color: #b14343; font-weight: bold;">My Preffered Patner</div>
      <div class="panelcustom">
           <b><?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> </b> Patner Profile
      </div>
     <?php if ($this->user->info->ID == $marriageprofile->users_id) { ?>
          <div style="margin-left: 543px;" class="col-md-6 ">
               <div id="showeditbutton">
                <a href="<?php echo site_url('marriage/edit_patner_profile/').$marriageprofile->marriage_profile_id ?>"><button class="btn btn-danger btn-xs" style="margin-top:-60px;">Edit</button></a>
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
                <span class="subspanclass"><?php echo $patnerprofile->maritalstatus  ?><?php echo $patnerprofile->havchildren ?>
                  
                </span>
              <?php  } ?>
              </div>
               <div style="padding: 10px;" class="row">
                      <div class="col-md-6">
                        <b>No Of Children : </b> <?php echo $patnerprofile->malechildren + $patnerprofile->femalechildren ?>
                      </div>
                     </div>
                  </div>
         
              <div style="padding: 10px;" class="row">
               <div class="col-md-6  ">
                <b>Height :</b>
                 <?php if(!empty($patnerprofile->height)){ ?>
                <span class="subspanclass"><?php echo $patnerprofile->height ?></span>
                <?php  } ?>
              </div>
              <div class="col-md-6">
                <b>Body type :</b>
                <?php if(!empty($patnerprofile->bodytype)){ ?>
                <span class="subspanclass"><?php echo $patnerprofile->bodytype ?></span>
                <?php  } ?>
              </div>
             </div>
             <div style="padding: 10px;" class="row">
                     
              <div class="col-md-6  ">
                <b>Complexion :</b>
                <?php if(!empty($patnerprofile->complexion)){ ?>
                <span class="subspanclass"><?php echo $patnerprofile->complexion ?></span>
                <?php  } ?>
               </div>

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
                 <?php  //echo '<pre>';print_r($patnerprofile);echo'</pre>'; ?>
                <?php if(!empty($patnerprofile->education_in)){ ?>
                <span class="subspanclass"><?php echo $patnerprofile->education_in ?>/<?php echo $patnerprofile->education_to ?></span>
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
                    <?php // echo '<pre>';print_r($patnerprofile);echo'</pre>'; ?>
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