<div style=" position: sticky; top: 60px; " class="col-md-3">
  <a href="<?php echo site_url('groups/') ?>">
  <div class="row">
    <div class="col-md-2">
      <div style="background-color: #3578e5; border-radius: 50%; height: 30px; width: 30px;">
        <div style="color: white;font-size: 20px;text-align: center;padding-left: 2px;">
          <i  class="fa fa-users"></i>
        </div> 
      </div>
    </div>
    <div class="col-md-10">
      <div style="font-size: 20px;">Groups</div>
    </div>
  </div>
  </a>
<div style="margin-top: 10px;" class="white-area-content">
<button data-toggle="modal" data-target="#memberModal"  class="form-control btn btn-primary"><i class="fa fa-plus"></i> Create Group</button>
</div>
<div style="margin-top: 20px;">
  <h5>Groups You Manage</h5>
        <?php  
            foreach($usergroups as $key):
          ?>
          <div style="padding: 3px;" class="ajsdjasd">
          <a style="text-decoration: none;" href="<?php echo site_url("groups/view/" .$key->ID) ?>">
          <div style="display: flex; ">
            <div style="width: 30px;height: 30px;">
            <?php if (!empty($key->profile_header)) { ?>
              <img style="width: 100%; height: 100%; border-radius: 10px;" src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $key->profile_header ?>"> 
          <?php   }else{  ?>  
              <img style="width: 100%; height: 100%; border-radius: 10px;" src="https://www.simscale.com/forum/uploads/default/original/3X/5/9/59c3686cc01056f418145aeede2685600647cf8c.jpg">
            <?php } ?>
          </div>
          <div style="margin-left: 5px;">
            <font size="4"><?php echo $key->name; ?></font>
          </div>
          </div>
          </a>
          </div>
    <?php
            endforeach;
          ?>            
</div>

<div style="margin-top: 20px;">
  <h5>Groups You're In</h5>
        <?php  
            foreach($ingroups as $key):
          ?>
          <div style="padding: 3px;" class="ajsdjasd">
          <a style="text-decoration: none;" href="<?php echo site_url("groups/view/" .$key->ID) ?>">
          <div style="display: flex; ">
            <div style="width: 30px;height: 30px;">
            <?php if (!empty($key->profile_header)) { ?>
              <img style="width: 100%; height: 100%; border-radius: 10px;" src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $key->profile_header ?>"> 
          <?php   }else{  ?>  
              <img style="width: 100%; height: 100%; border-radius: 10px;" src="https://www.simscale.com/forum/uploads/default/original/3X/5/9/59c3686cc01056f418145aeede2685600647cf8c.jpg">
            <?php } ?>
          </div>
          <div style="margin-left: 5px;">
            <font size="4"><?php echo $key->name; ?></font>
          </div>
          </div>
          </a>
          </div>
    <?php
            endforeach;
          ?>            
</div>

</div>

