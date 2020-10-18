<div class="row">
   <div class="col-md-12">
      <div class="row half-separator">
         <div style="position: sticky;top: 55px;" class="col-md-2">
            <div>
               <div style="font-size: 25px;">
                  <a style="color: #1ca1fa !important; " href="<?php echo site_url('groups/view/').$group->ID ?>"><?php echo $group->name ?></a>
               </div>
               <div style="display: flex;color: #90949c;font-size: 13px;font-weight: 600;line-height: 18px;">
                  <span class="glyphicon glyphicon-lock"></span>
                  <p>Private Group</p>
               </div>
               <div style="height: auto!important;" class="sidebar-block custom-scrollbar-css" id="homepage-links">
                <ul>
                  <li class="active"><a style="color: #1ca1fa;" href="<?php echo site_url("groups/about/" . $group->ID) ?>">About</a></li>
                  <li ><a style="color: #1ca1fa;" href="<?php echo site_url("groups/view/" . $group->ID) ?>">Discussion</a></li>
                  <li><a style="color: #1ca1fa;" href="<?php echo site_url("groups/events/" . $group->ID) ?>">Events</a></li>
                  <li><a style="color: #1ca1fa;" href="<?php echo site_url("groups/members/" . $group->ID) ?>">Members</a></li>
                  <li><a style="color: #1ca1fa;" href="<?php echo site_url("groups/albums/" . $group->ID) ?>">Albums</a></li>
                   <?php if( (isset($member) && $member != null && $member->roleid == 1) || ($this->common->has_permissions(array("admin", "page_admin"), $this->user)) ) : ?> 
                  <li><a style="color: #1ca1fa;" href="<?php echo site_url("groups/settings/" . $group->ID) ?>">Settings</a></li>
                  <?php endif ?>
                </ul>
               </div>
            </div>
         </div>
         <div class="col-md-10">
            <?php include(APPPATH . "/views/groups/coverimage.php"); ?>
            <div class="row">
               <div class="col-md-8">
                  <div class="editor-wrapper">
                    <div style="padding: 6px;" class="editor-header">
                       About This Group
                    </div>
                    <div style="padding: 10px;" >
                        <div style="margin-bottom: 10px;"><b>Description</b></div>
                        <p style="margin: 14px;"><?php echo $group->description; ?></p>
                        <div><span style="padding-right: 5px;" class="glyphicon glyphicon-lock"></span>Private<div>
Only members can see who's in the group and what they post</div></div>
                    </div>
                  </div>
                   <?php if (!empty($rules)) { ?>
                  <div class="editor-wrapper" style="margin-top: 10px;">
                      <div class="editor-header">
                          Group Rules
                      </div>
       
                <?php $i = 1; ?>
                      <div style="padding: 10px;">
                      <?php foreach ($rules as $r) { ?>
                        <div class="hoverchangediv"><b style="cursor: pointer;" id="hidename_<?php echo $r->group_rules_ID; ?>"> <?php echo $i++ ?> : <?php echo $r->rule_name; ?></b> </div>
                        <p><?php echo $r->rule; ?></p>
                      <?php }  ?> 
                      </div>
                  </div>
                <?php } ?>
               </div>
               <div style="position: sticky;top: 55px;" class="col-md-4">
                    <div style="border-radius: 4px 4px 0px 0px;" class="page-block">
                        <div style="padding: 10px;" class="page-block-title">
                            History
                        </div>
                        <div style="padding: 10px;">
                            <span class="glyphicon glyphicon-flag"></span> Group created on <?php echo date($this->settings->info->date_format, $group->timestamp); ?>
                        </div>  
                    </div>
                                <div style="border-radius: 0px; margin-top: 10px;" class="page-block">
  
  <div class="page-block-title">
  <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1037") ?>
  </div>

  <div style="padding: 5px 10px;" class="row">
      <div class="col-md-6 col-xs-6">
        <?php echo lang("ctn_21") ?>  
      </div>
      <div style="text-align: right;" class="col-md-6 col-xs-6">
        <a href="<?php echo site_url("groups/members/" . $group->ID) ?>"><?php echo $this->group_model->get_group_members($group->ID); ?> <?php echo lang("ctn_21") ?></a>
      </div>
  </div>
    <div class="row" style="padding: 5px 10px;">
      <?php foreach($users->result() as $r) : ?>
      <div class="col-md-2 col-xs-2">
        <div style="height: 55px; width:55px; padding: 5px; cursor: pointer;">
          <a target="_blank" href="<?php echo site_url('profile/').$r->username; ?>">
            <img title="<?php echo $r->first_name ?> <?php echo $r->last_name ?>" style="width: 100%; height: 100%;" src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->avatar ?>">
            </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div style="padding: 0px; overflow: auto;height: 300px;">
  <?php   $friend= $this->user_model->get_user_friends_all($this->user->info->ID); ?>
        <?php foreach($friend->result() as $r) : ?> 
    
      <?php if (empty($this->group_model->checkusergroupjoined($r->friendid , $group->ID))  ) { ?>
      <div style="display: flex; position: relative; padding: 5px 10px; border-bottom: 1px solid #DDD;">
        <div style="height: 40px; width: 40px;">
            <img style="height: 100%; width: 100%;" src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->avatar ?>">
        </div>
        <div style="margin-left: 10px; margin-top: 10px;">
            <a href=""><?php echo $r->first_name ?> <?php echo $r->last_name ?></a><br>
        </div>
        <div style="position: absolute; right: 5px;">
          <?php if ($this->group_model->checkusergroupinvite($r->friendid , $group->ID) == 0)   { ?>
            <button style="background-color: #265a88; color: white;" id="invitebutton<?php echo $r->friendid; ?>" onclick="invite_member(<?php echo $r->friendid; ?>, <?php echo $group->ID; ?>);" class="btn btn-sm ">Invite</button>
          <?php }else{ ?> 
            <button style="background-color: green; color: white;" id="invitebutton<?php echo $r->friendid; ?>"  class="btn btn-sm ">Invited</button>
          <?php } ?>
        </div>
      </div>
    <?php } ?>
<?php endforeach; ?>
    
</div>

  </div>
               </div>

            </div>
         </div>
      </div>
   </div>
</div>


<script type="text/javascript">
  function invite_member(userid, groupid)
  {
    $.ajax({ 
      url: '<?php echo site_url('groups/inviteuser/'); ?>'+userid+'/'+groupid,
      type: 'GET',
      success: function(resp){
        if(resp==1)
        {
         $('#invitebutton'+userid).css("background-color", "green");
         $('#invitebutton'+userid).html('Invited');

        }
        else if(resp == 0){
          $('$group->ID').html(msg.err_msg);
          $('$r->friendid').hide();
        }

      }
    });
  }
</script>