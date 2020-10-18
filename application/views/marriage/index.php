<div class="row">
   <div class="col-md-12">
      <div class="profile-header" id="profile_cover_image" style="background: url(<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative . "/" . $user->profile_header ?>) center center; background-size: cover; cursor: pointer;">
         <div class="profile-header-avatar">
            <?php if($this->user->info->ID==$user->ID){
               ?>
            <img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $user->avatar ?>">
            <?php
               }else{
                 ?>
            <img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $user->avatar ?>">
            <?php
               } ?>
         </div>
      </div>
      <div class="profile-header-bar clearfix">
         <ul>
            <li style="font-weight: bold;"><?php echo $user->first_name ; ?> <?php echo $user->last_name; ?></li>
         </ul>
         <div class="pull-right profile-friend-box">
            <?php if($this->user->loggedin) : ?>
            <?php if($user->ID != $this->user->info->ID) : ?>
            <?php
               /************************ Message Button Start by Tanveer 29/03/2020 *************************/
               ?>
            <?php if($user->chat_option==0)
               { ?>
            <button type="button" class="btn btn-post btn-sm" id="start_chat_button" onClick="chat_with(<?php echo $user->ID; ?>);"><?php echo lang("ctn_12"); ?></button>
            <?php
               }
               else
               {
                 if($friend_flag)
                 {
                   ?>
            <button type="button" class="btn btn-post btn-sm" id="start_chat_button" onClick="chat_with(<?php echo $user->ID; ?>);"><?php echo lang("ctn_12"); ?></button>
            <?php
               }
               }
               ?>
            <?php
               /************************ Message Button End by Tanveer 29/03/2020 *************************/
               ?>
            <?php if(!$user->allow_friends) : ?>
            <button type="button" class="btn btn-success btn-sm" onclick="add_friend(<?php echo $user->ID ?>)" id="friend_button_<?php echo $user->ID ?>"><?php echo lang("ctn_602") ?></button>
            <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>
            <a href="<?php echo site_url('marriage/createnew/').rand(10000000 , 1000000000) ?>"><button type="button" class="btn btn-success btn-sm" >Create Profile</button></a>
         </div>
      </div>
      <div class="row ">
        <?php foreach ($merrageprofiles->result() as $r) { ?>
          <div style="margin-top: 20px;" class="col-md-4">
            <div style="border: 1px solid #DDD">
              <div style="width: 100%;  height: 250px;" >
                  <img style="width: 100%; height: 100%; object-fit: contain;" src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->profileimage ?>">
              </div>
              <div style="padding: 20px;">
                  <div style="padding: 3px;"><b>Created By: </b> <?php echo $r->profile_by; ?></div>
                  <div style="padding: 3px;"><b>Age & Height:</b> <?php echo $r->age; ?> Yrs & <?php echo $r->height ?></div>
                  <div style="padding: 3px;"><b>Religion:</b> <?php echo $r->name; ?></div>
                  <div style="padding: 3px;"><b>Country:</b><?php if(!empty($r->country)){ ?>
                   <?php echo $this->marriage_model->getcountryname($r->country)->row()->name ; }else{echo " N/A ";}?></div>
                  <div style="padding: 3px;"><b>City:</b> <?php echo $r->city; ?></div>
              </div>
              <?php if ($this->user->info->ID == $r->users_id) { ?>
              <div style="text-align: center; margin-bottom: 10px;">
                <div class="row">
                    <div style="text-align: center;" class="col-md-12">
                       <a href="<?php echo site_url('marriage/marriageprofile/').$r->marriage_profile_id; ?>"><button class="btn btn-success">View</button></a>
                    </div>
                </div>
                  
              </div>
            <?php } ?>
            </div>
          </div>
          <?php   } ?>
      </div>
   </div>
</div>