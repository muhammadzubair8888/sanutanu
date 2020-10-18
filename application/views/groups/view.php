<script type="text/javascript">
$(document).ready(function() {
  load_posts(<?php echo $group->ID ?>);
});

function load_posts_wrapper() 
{
  load_posts(<?php echo $group->ID ?>);
}

function load_posts(groupid) 
{
  $.ajax({
    url: global_base_url + 'feed/load_group_posts/' + groupid,
    type: 'GET',
    data: {

    },
    success: function(msg) {
      $('#home_posts').html(msg);
      $('#home_posts').jscroll({
          nextSelector : '.load_next'
      });
    }
  })
}
 </script>
 <?php
 $postAsImg = $this->user->info->avatar;
 ?>
 <div class="row">
 <div class="col-md-12">
 <div class="row half-separator">
 <div style="position: sticky;top: 55px;" class="col-md-2">

<div>
  <div style="font-size: 25px;">
        <a style="color: #1ca1fa !important; " href="<?php echo site_url('groups/view/').$group->ID ?>"><?php echo $group->name ?></a>
  </div>
  <div style="display: flex;color: #90949c;font-size: 13px;font-weight: 600;line-height: 18px;">
      <span class="fa fa-unlock"></span><p>Public Group</p>
  </div>
  <div style="height: auto!important;" class="sidebar-block custom-scrollbar-css" id="homepage-links">
    <ul>
      <li><a style="color: #1ca1fa;" href="<?php echo site_url("groups/about/" . $group->ID) ?>">About</a></li>
      <li class="active"><a href="<?php echo site_url("groups/view/" . $group->ID) ?>">Discussion</a></li>
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
          <?php if($this->user->loggedin) : ?>
            <?php
            $postAsDefault = "group";
            $postAs = $group->name;
             ?>
          <?php endif; ?>
          <?php 
          // Page defaults
          $editor_placeholder = lang("ctn_579") . " " . $group->name ." ...";
          $groupid = $group->ID;
          ?>

          <?php if (!empty($this->group_model->checkgroupjoined($group->ID))) { ?>
            <?php include(APPPATH . "views/feed/editor.php"); ?>
          <?php } ?>
          <div id="home_posts">

          </div>
      </div>
      <div style="position: sticky;top: 55px;" class="col-md-4">

        <?php include(APPPATH . "/views/groups/invitemembers.php"); ?>

      </div>
  </div>

  





</div>
 </div>

 </div>
</div>
   <?php echo form_open(site_url("groups/report_page/" . $group->ID)) ?>
 <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-flag"></span> <?php echo lang("ctn_578") ?> <?php echo $group->name ?></h4>
      </div>
      <div class="modal-body ui-front form-horizontal">
          <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_580") ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="reason">
                    </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
        <input type="submit" class="btn btn-post" value="<?php echo lang("ctn_578") ?>">
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>

 <div class="modal fade" id="joinModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-flag"></span> <?php echo lang("ctn_628") ?> <?php echo $group->name ?></h4>
      </div>
      <div class="modal-body ui-front form-horizontal">
         <p><?php echo lang("ctn_827") ?> <strong><?php //echo $group->pay_to_join ?> <?php echo lang("ctn_350") ?></strong>. <?php echo lang("ctn_828") ?> <a href="<?php echo site_url("funds") ?>"><?php echo lang("ctn_250") ?></a> <?php echo lang("ctn_275") ?>.</p>
         <p><?php echo lang("ctn_276") ?> <strong><?php echo $this->user->info->points ?> <?php echo lang("ctn_350") ?></strong>.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
        <a href="<?php echo site_url("pages/join_page/" . $group->ID . "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-post btn-sm"><?php echo lang("ctn_554") ?></a>
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