<div class="profile-header" style="border-top: 1px solid #DDD; border-left: 1px solid #DDD; border-right: 1px solid #DDD; background: url(<?php if (!empty($group->profile_header)){   echo base_url() ?><?php echo $this->settings->info->upload_path_relative . "/" . $group->profile_header; } else{ echo "https://www.simscale.com/forum/uploads/default/original/3X/5/9/59c3686cc01056f418145aeede2685600647cf8c.jpg"; } ?>) center center; background-size: cover;">
 <?php if( (isset($member) && $member != null && $member->roleid == 1) || ($this->common->has_permissions(array("admin", "page_admin"), $this->user)) ) : ?> 
 <div class="profile-cover-edit-button" style="position: absolute; top: 10px; left: 10px;" >
  <?php /* ?><button class="btn btn-post" style="border-radius: 20px;" onclick="save_image()">Edit</button><?php */ ?>
   <button class="btn btn-default" style="border-radius: 5px;" onclick="change_cover();"><i class="glyphicon glyphicon-camera"></i> Edit Cover Photo</button>
    <form method="post" enctype="multipart/form-data" style="display: none;">
      <input type="file" name="coverupload" id="coverupload" accept="image/*">
    </form>
 </div>
 <?php endif; ?>

 <div class="profile-header-options">
  <?php if( (isset($member) && $member != null && $member->roleid == 1) || ($this->common->has_permissions(array("admin", "page_admin"), $this->user)) ) : ?> 


<?php endif; ?>
 </div>
</div>

<style type="text/css">
 .hasidhasjkd{ 
  padding-left: 20px !important; 
  padding-right: 0px !important; 
  border-left: none !important;
  padding-top: 5px !important; 
  padding-bottom: 5px !important;
  border-radius: 0px !important;
}
.asdasds{
  border:1px solid #ccc;
}

</style>

<div style="margin-bottom: 20px" class="profile-header-bar clearfix">
  <ul  style="margin-left: 0px;">
<li class="hasidhasjkd"><a class="btn asdasds" href="<?php echo site_url("groups/members/" . $group->ID) ?>"><?php echo lang("ctn_21") ?></a></li>
<?php if( (isset($member) && $member != null && $member->roleid == 1) || ($this->common->has_permissions(array("admin", "page_admin"), $this->user)) ){ ?> 
  <li class="hasidhasjkd"><a class="btn asdasds" href="<?php echo site_url("groups/settings/" . $group->ID) ?>"><?php echo lang("ctn_156") ?></a></li>
<?php }else{ ?> 
<li class="hasidhasjkd"><a class="btn asdasds" href="<?php echo site_url("groups/albums/" . $group->ID) ?>"><?php echo lang("ctn_483") ?></a></li>

<?php } ?>
</ul>

  <div class="pull-right profile-friend-box">
  <?php if($this->user->loggedin) : ?>
  <?php if ($this->group_model->checkgroupjoined($group->ID) > 0) { ?>
  <button style="background-color: green; color: white;"  id="leavegroupbutton" onclick="leavegroupindex(<?php echo $group->ID; ?>)" class="btn  btn-sm">Joined</button>
  <button  id="joingroupbutton" style="display: none; background-color: #265a88; color: white;" onclick="joingroupindex(<?php echo $group->ID; ?>)"  class="btn  btn-sm"><?php echo lang("ctn_1024") ?></button>
    <?php } else{ ?> 
  <button  id="joingroupbutton" style="background-color: #265a88; color: white;" onclick="joingroupindex(<?php echo $group->ID; ?>)"  class="btn  btn-sm"><?php echo lang("ctn_1024") ?></button>
  <button style="display: none; background-color: green; color: white;"  id="leavegroupbutton" onclick="leavegroupindex(<?php echo $group->ID; ?>)" class="btn  btn-sm">Joined</button>
  <?php } ?>
    <?php else : ?>
    <a href="<?php echo site_url("groups/leave_group/" . $group->ID . "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok"></span> <?php echo lang("ctn_34") ?></a> 
   <?php endif; ?>
 </div>
 </div> 