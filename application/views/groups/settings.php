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
    <li ><a style="color: #1ca1fa;" href="<?php echo site_url("groups/about/" . $group->ID) ?>">About</a></li>
    <li ><a style="color: #1ca1fa;" href="<?php echo site_url("groups/view/" . $group->ID) ?>">Discussion</a></li>
    <li><a style="color: #1ca1fa;" href="<?php echo site_url("groups/events/" . $group->ID) ?>">Events</a></li>
    <li><a style="color: #1ca1fa;" href="<?php echo site_url("groups/members/" . $group->ID) ?>">Members</a></li>
    <li><a style="color: #1ca1fa;" href="<?php echo site_url("groups/albums/" . $group->ID) ?>">Albums</a></li>
     <?php if( (isset($member) && $member != null && $member->roleid == 1) || ($this->common->has_permissions(array("admin", "page_admin"), $this->user)) ) : ?> 
    <li  class="active"><a style="color: #1ca1fa;" href="<?php echo site_url("groups/settings/" . $group->ID) ?>">Settings</a></li>
    <?php endif ?>
  </ul>
               </div>
            </div>
         </div>
         <div class="col-md-10">
            <?php include(APPPATH . "/views/groups/coverimage.php"); ?>
            <div  class="row">
                  <div class="col-md-12">
                    <div style="border: 1px solid #DDD;" class="col-md-3">
                      <ul style="list-style: none; padding-left: 0px; ">
                         <li style="padding: 5px;"><a style="color: black; font-weight: bold;" href="<?php echo site_url('groups/settings/').$group->ID ?>">Genral Settings</a></li>
                         <li style="padding: 5px;"><a href="">Moderate Settings</a></li>
                         <li style="padding: 5px;"><a href="<?php echo site_url('groups/rules/').$group->ID ?>">Group Rules</a></li>
                        <li style="padding: 5px;"><a href="<?php echo site_url('groups/questions/').$group->ID ?>">Membership Questions</a></li>
                      </ul>
                   </div>
                   <div style="padding-right: 0px;" class="col-md-9">
                  <div class="editor-wrapper">
                    <div  style="font-size: 18px;" class="editor-header">
                       Edit Group Settings
                    </div>
                      <div style="padding: 5px;">
                         <div class="form-group">
                            <label>Group Name</label>
                            <input id="namegorupsettings" type="text" style="border-radius: 0px;" value="<?php echo  $group->name; ?>" class="form-control" name="groupname">
                         </div>
                         <div class="form-group">
                            <label>Group Description</label>
                            <textarea id="descriptiongorupsettings" rows="8" style="border-radius: 0px;" class="form-control" name="groupname"><?php echo  $group->description; ?></textarea>
                            <input type="hidden" value="<?php echo $group->ID; ?>" id="groupidgorupsettings">
                         </div>
                         <div class="form-group">
                            <button id="savegenralsettings" class="btn btn-sm" style="background-color: #265a88; color: white;">Save</button>
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
















<script type="text/javascript">
  $(document).ready(function(){
  $("#savegenralsettings").click(function(){
    var name = $( "#namegorupsettings" ).val();  
    var description = $( "#descriptiongorupsettings" ).val(); 
    var groupid = $( "#groupidgorupsettings" ).val();
    $("#groupnamechangebyid").html(name);
    $.ajax({ 
      url: '<?php echo site_url('groups/updategroupsettings/'); ?>',
      type: 'POST',
      data: { name : name  , description: description, groupid: groupid},
      success: function(resp){
          swal(resp);
      }
    });
  });
});

</script>