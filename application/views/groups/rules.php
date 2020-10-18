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
                     <li><a style="color: #1ca1fa;" href="<?php echo site_url("groups/about/" . $group->ID) ?>">About</a></li>
                     <li class="active"><a href="<?php echo site_url("groups/view/" . $group->ID) ?>">Discussion</a></li>
                     <li><a style="color: #1ca1fa;" href="<?php echo site_url("groups/events/" . $group->ID) ?>">Events</a></li>
                     <li><a style="color: #1ca1fa;" href="<?php echo site_url("groups/albums/" . $group->ID) ?>">Albums</a></li>
                     <li><a style="color: #1ca1fa;" href="<?php echo site_url("groups/files/" . $group->ID) ?>">Files</a></li>
                  </ul>
               </div>
            </div>
         </div>

 <div class="col-md-10">

<?php include(APPPATH . "/views/groups/coverimage.php"); ?>

 <div style="margin-left: 0px; margin-right: 0px;" class="row">
      <div style="border: 1px solid #DDD;" class="col-md-3">
        <ul style="list-style: none; padding-left: 0px; ">
           <li style="padding: 5px;"><a  href="<?php echo site_url('groups/settings/').$group->ID ?>">Genral Settings</a></li>
           <li style="padding: 5px;"><a href="">Moderate Settings</a></li>
           <li style="padding: 5px;"><a style="color: black; font-weight: bold;" href="<?php echo site_url('groups/rules/').$group->ID ?>">Group Rules</a></li>
           <li style="padding: 5px;"><a href="<?php echo site_url('groups/questions/').$group->ID ?>">Membership Questions</a></li>
        </ul>
     </div>
    <script>
    $(document).ready(function(){
      $(".hoverchangediv").hover(function(){
        $(".changecolorglyphicon").css("color", "black");
       }, function() {
        $(".changecolorglyphicon").css('color', 'white')
    });
    });
    </script>
    <div style="padding-right: 0px;" class="col-md-9">
      <div class="editor-wrapper">
        <div  style="font-size: 18px;" class="editor-header">
           Group Rules
        </div>
      <div style="padding: 5px;">
        <?php if (!empty($rules)) { ?>
          <?php $i = 1; ?>
          <?php foreach ($rules as $r) { ?>
            <div class="hoverchangediv"><b style="cursor: pointer;" id="hidename_<?php echo $r->group_rules_ID; ?>"> <?php echo $i++ ?> : <?php echo $r->rule_name; ?></b> <span style="color: white; padding-left: 10px; cursor: pointer;" onclick="editname(<?php echo $r->group_rules_ID; ?>)" id="convertinput_<?php echo $r->group_rules_ID ?>" class="glyphicon glyphicon-edit changecolorglyphicon"></span> </div>
            <p><?php echo $r->rule; ?></p>
          <?php } } ?>  
          <?php echo form_open(site_url("groups/insertnewgrouprule/")) ?>
          <input type="hidden" value="<?php echo $group->ID; ?>" name="groupid">
          <div class="form-group">
             <input placeholder="Enter Rule Name" type="text" class="form-control" name="grouprulename">
          </div> 
          <div class="form-group">
              <textarea name="addgrouprule" rows="5" class="form-control" placeholder="Add New Group Rule"></textarea>
          </div>       
          <div class="form-group">
              <button id="savegenralsettings" class="btn btn-sm" style="background-color: #265a88; color: white;">Add Rule</button>
          </div>
          <?php echo form_close(); ?>
      </div>
      </div>
    </div>
 </div>

</div>
 </div>

 </div>
</div>












<!-- model for Edit -->
<div class="modal fade" id="EditModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tittlemodel" ></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php echo form_open(site_url("groups/updategrouprule/" .$group->ID)) ?>
      <div class="form-group">
      <label class="col-form-label">Rule Name</label>
      <input type="text" class="form-control" name="grouprulename" id="tittlegrouprule" >
      </div>
      <div class="form-group">
      <label class="col-form-label">Rule Name</label>
      <textarea rows="5" name="addgrouprule" class="form-control" id="rulefetch"></textarea>
      </div>      
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" class="btn btn-primary">Save changes</button>
       <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
<!-- end of edit model -->
<script type="text/javascript">

  function editname(id)
  {
     $.ajax({ 
        url: '<?php echo site_url('groups/getrulebyid/'); ?>'+id,
        type: 'GET',
        datatype:'json',
        success: function(resp){
          var test = JSON.parse(resp);
          $("#tittlegrouprule").val(test.rule_name);
          $("#tittlemodel").html(test.rule_name);
          $("#rulefetch").html(test.rule);
          $("#rulefetchid").html(test.group_rules_ID);
          $('#EditModel').modal('show');
        }
      });
  }


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