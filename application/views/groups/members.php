 <div class="row">
 <div class="col-md-12">


 <div class="row half-separator">
 <div style="position: sticky;top: 55px;" class="col-md-2">

<div>
  <div style="font-size: 25px;">
        <a style="color: #1ca1fa !important; " href="<?php echo site_url('groups/view/').$group->ID ?>"><?php echo $group->name ?></a>
  </div>
  <div style="display: flex;color: #90949c;font-size: 13px;font-weight: 600;line-height: 18px;">
      <span class="glyphicon glyphicon-lock"></span><p>Private Group</p>
  </div>
  <div style="height: auto!important;" class="sidebar-block custom-scrollbar-css" id="homepage-links">
  <ul>
    <li ><a style="color: #1ca1fa;" href="<?php echo site_url("groups/about/" . $group->ID) ?>">About</a></li>
    <li ><a style="color: #1ca1fa;" href="<?php echo site_url("groups/view/" . $group->ID) ?>">Discussion</a></li>
    <li><a style="color: #1ca1fa;" href="<?php echo site_url("groups/events/" . $group->ID) ?>">Events</a></li>
    <li class="active"><a style="color: #1ca1fa;" href="<?php echo site_url("groups/members/" . $group->ID) ?>">Members</a></li>
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
         <div class="asdhasjkd"> 
            <div style="padding: 10px;">
              <div class="row">
                  <div class="col-md-6">
                       <span style="font-size: 18px; font-weight: bold;">Members</span> <span style=" font-size: 14px; font-weight: bold; line-height: 24px; margin-left: 4px; vertical-align: middle; color: #90949c; "><?php echo $this->group_model->get_group_members($group->ID); ?></span>
                  </div>
                  <div class="col-md-6">
                      <input name="search" autocomplete="off" name="memberssearchname" id="memberssearch" style="border-radius: 0px;" placeholder="Find a Member" type="text" class="form-control" name="">
                  </div>
              </div>
            </div>
         </div>
          <div id="hideactualmembers" class="asklldnml">  
            <?php if (!empty($users->result())) { ?>
              <span style="padding: 15px; font-weight: 600;">All Members</span>
              <div class="container-fluid">
                    <hr style="margin-top: 10px; color: black;">
              </div>
              <?php foreach($users->result() as $r) : ?>
                <div class="row">
                    <div class="col-md-9 col-xs-9">
                      <div style="display: flex; padding: 10px;">
                        <div style="width: 70px; height: 70px;">
                               <img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->avatar ?>" style="width: 100%;height: 100%;">
                        </div>
                         <div style="margin-left: 10px; margin-top: 10px;">
                          <a href="<?php echo site_url('profile/').$r->username; ?>"><?php echo $r->first_name ?> <?php echo $r->last_name ?></a>
                          <p>Lives In <?php echo $r->city ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-xs-3">
                      <div style="position: absolute; right: 30px; margin-top: 10px;">
                            <button class="btn btn-default">Add Friend</button>
                        </div>
                    </div>
                </div>
              <?php endforeach; ?>
            <?php  }else{ ?>
                  <div class="row">
                      <div style="text-align: center;" class="col-md-12">
                          <div style="padding: 10px;">
                              <b>0</b> Member Joined This Group
                          </div>
                      </div>
                  </div>
             <?php } ?>
           </div>
            <div id="showmembers" class="asklldnml">  
  
            </div>  
    </div>
    <div class="col-md-4">


        <?php include(APPPATH . "/views/groups/invitemembers.php"); ?>

        <div style="border-radius: 0px;" class="page-block">
          <div class="page-block-title">
           Suggested for You
          </div>
          <?php foreach ($sugestedgroups as $r) { ?>
          <div style="padding: 10px;">
              <div style="border-top:1px solid #ccc;border-left:1px solid #ccc;border-right:1px solid #ccc;">
                  <div style="width: 100%; height: 130px;">
                      <img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->grouppicture ?>" style="width: 100%; height: 100%;">
                  </div>
              </div>
              <div style="padding: 5px;" class="asdhasjkd">
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <div><a href=""><?php echo $r->name; ?></a></div>
                        <div style="color: #90949c; font-size: 13px;"> <span id="changemembersmemberspage<?php echo $r->groupid; ?>"><?php echo $r->members; ?> </span> Members</div>
                    </div>
                    <div  style="text-align: right; margin-top: 8px;" class="col-md-6 col-xs-6">
                          <?php if ($this->group_model->checkusergroup($r->groupid) == 0) { ?>
                         <?php if ($this->group_model->checkgroupjoined($r->groupid) > 0) { ?>
                          <div id="leavegroupbuttonmembers<?php echo $r->groupid; ?>" onclick="leavegroupmembers(<?php echo $r->groupid; ?>)">
                          <button class="btn btn-primary">Joined</button>
                        </div>
                        <div id="joingroupbuttonmembers<?php echo $r->groupid; ?>" onclick="joingroupmembers(<?php echo $r->groupid; ?>)" style="display: none;">
                          <button    class="btn btn-default">Join</button>
                        </div>
                        <?php  }else{  ?>
                          <div id="joingroupbuttonmembers<?php echo $r->groupid; ?>" onclick="joingroupmembers(<?php echo $r->groupid; ?>)" >
                          <button class="btn btn-default">Join</button>
                        </div>
                          <div onclick="leavegroupmembers(<?php echo $r->groupid; ?>)" id="leavegroupbuttonmembers<?php echo $r->groupid; ?>" style="display: none;">
                          <button    class="btn btn-primary">Joined</button>
                        </div>
                      <?php } ?>
                    <?php }else{ ?>
                          <a href="<?php echo site_url("groups/view/" .$r->groupid) ?>" class="btn asnd_asda" style="background-color: #26e612 !important; color: white !important;">View Group</a>
                      <?php } ?>
                    </div>
                </div>
              </div>
          </div>
          <?php  } ?>
        </div>
    </div>
</div>





</div>
 </div>

 </div>
</div>









<script type="text/javascript">
  function joingroup(userid, groupid)
  {
    $.ajax({ 
      url: '<?php echo site_url('groups/join_groups/'); ?>'+userid+'/'+groupid,
      type: 'GET',
      success: function(resp){
        if(resp==1)
        {
         $('$group->ID').html(msg.status_msg);
         $('$r->friendid').show();
        }
        else if(resp == 0){
          $('$group->ID').html(msg.err_msg);
          $('$r->friendid').hide();
        }

      }
    });
  }
  function joingroupindex(id)
  {
    $.ajax({
        type: 'GET',
        url: '<?php echo site_url('groups/join_groupajax/'); ?>'+id,
        success: function(res) {
          $("#joingroupbutton").hide();
          $("#leavegroupbutton").show();
        }
    });
  }
  function leavegroupindex(id)
  {
    $.ajax({
        type: 'GET',
        url: '<?php echo site_url('groups/leave_groupajax/'); ?>'+id,
        success: function(res) {
          $("#leavegroupbutton").hide();
          $("#joingroupbutton").show();
        }
    });
  }

  function joingroupmembers(id)
  {
    $.ajax({
        type: 'GET',
        url: '<?php echo site_url('groups/join_groupajax/'); ?>'+id,
        success: function(res) {
          $("#joingroupbuttonmembers"+id).hide();
          $("#leavegroupbuttonmembers"+id).show();
          $("#changemembersmemberspage"+id).html(res);
        }
    });
  }
  function leavegroupmembers(id)
  {
    $.ajax({
        type: 'GET',
        url: '<?php echo site_url('groups/leave_groupajax/'); ?>'+id,
        success: function(res) {
          $("#joingroupbuttonmembers"+id).show();
          $("#leavegroupbuttonmembers"+id).hide();
          $("#changemembersmemberspage"+id).html(res);
        }
    });
  }
</script>

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



<script>

  var groupid = '<?php echo $group->ID; ?>';
   $(document).on('keyup', '#memberssearch', function() {
        //var that = this,
        var value = $(this).val();
          $.ajax({
                type: "GET",
                url: "<?php echo site_url('groups/membersearch/'); ?>"+groupid+"/"+value,
                dataType: "text",
                success: function(msg){
                    $('#hideactualmembers').hide();
                    $('#showmembers').html(msg);
                    if(value=='')
                    {
                      $('#showmembers').html('');
                      $('#hideactualmembers').show();
                    }
                    
                }
            });
    });
</script> 