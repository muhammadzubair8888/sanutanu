<div style="border-radius: 0px; margin-bottom: 10px;" class="page-block">
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