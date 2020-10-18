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
                      <img src="https://www.re-marriage.in/images/5-my_profile_statistics_sml.gif"><span style="padding-left: 20px; padding-top: 5px;"><a href="<?php echo site_url('marriage/marriageprofile_stats/').$marriageprofile->marriage_profile_id ?>">View Profile Statistics</a></span>
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
       <div style="margin-top: 20px; background-color: #efefef; padding: 5px; color: #b14343; font-weight: bold;">Hide & Delete the Profile</div>
      

       
      <div class="panelcustom">
           <b><?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> </b> Hide and Delete the profile
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
                <b>Delete Profile:</b> 
                 <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" style="    margin-left: 20px;">Delete</button>
                 </div>
                 <?php     //echo print_r($marriageprofile); ?>
               <div class="col-md-6  ">
                <b>Hide Profile : </b>
                <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#my_Modal" style="    margin-left: 20px;">Hide / Show</button>
                </div>

                
    <div class="modal fade" id="myModal" role="dialog">
     <div class="modal-dialog">
    
      <!-- Modal content for delete the profile-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete Profile</h4>
        </div>
        <div class="modal-body">
           <p> Are you sure you want to delete the profile?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <a href="<?php echo site_url('marriage/delete_profiles/').$marriageprofile->marriage_profile_id ?>"><button class="btn btn-danger  btn-md" >Delete</button></a>
        </div>
      </div>
       </div>
     </div>
   <!--   hide profile -->
   <div class="modal fade" id="my_Modal" role="dialog">
     <div class="modal-dialog">
    
      <!-- Modal content for Hide the profile-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hide and Show Profile</h4>
        </div>
        <div class="modal-body">
           <p> Are you sure you want to Hide the profile?</p>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="<?php echo site_url('marriage/hide_delete_profile/').$marriageprofile->marriage_profile_id ?>"><button class="btn btn-success btn-md" id="hidepage">Hide</button></a>

        <a href="<?php echo site_url('marriage/hide_delete_profile/').$marriageprofile->marriage_profile_id ?>"><button class="btn btn-primary btn-md" id="showpage">Show</button></a>
        </div>
      </div>
     </div>
     </div>




                  </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
 
 <script>
 $('#hidepage').click(function() {
    $.ajax({
      url:  "<?php echo site_url("marriage/hide_profile") ?>", 
            success: function(result){
         $('.current').removeClass('current').hide()
                .next().show().addClass('current');
            if ($('.current').hasClass('last')) {
                $('#hidepage').attr('disabled', true);
            }
            $('#showpage').attr('disabled', null);
    }});

});

$('#showpage').click(function() {
    $.ajax({
      url: "<?php echo site_url("marriage/show_profile") ?>", 
      success: function(result){
      $('.current').removeClass('current').hide()
     .prev().show().addClass('current');
      if ($('.current').hasClass('first')) {
        $('#showpage').attr('disabled', true);
    }
    $('#hidepage').attr('disabled', null);
    }});

   });
 </script>