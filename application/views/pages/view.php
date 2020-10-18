  <script type="text/javascript">
$(document).ready(function() {
  load_posts(<?php echo $page->ID ?>);
});

function load_posts_wrapper() 
{
  load_posts(<?php echo $page->ID ?>);
}

function load_posts(pageid) 
{
  $.ajax({
    url: global_base_url + 'feed/load_page_posts/' + pageid,
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
 <div class="row">
 <div class="col-md-12">


 <div class="profile-header" style="background: url(<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative . "/" . $page->profile_header ?>) center center; background-size: cover;">
 <div class="profile-header-avatar">
  <?php if( (isset($member) && $member != null && $member->roleid == 1) || ($this->common->has_permissions(array("admin", "page_admin"), $this->user)) ) : ?> 
	<a href="#mn1" class="dropdown-toggle" id="profilepicturemenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $page->profile_avatar ?>" style="width: 100%; height: 100%;"></a>
  <?php else: ?>
    <img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $page->profile_avatar ?>" style="width: 100%; height: 100%;">
  <?php endif; ?>
 </div>
 <ul class="dropdown-menu" id="mn1" role="menu" aria-labelledby="profilepicturemenu">
    <li><a style="cursor: pointer;" onclick="post_modal(<?php echo $page->profilepic_postid; ?>);"><i class="glyphicon glyphicon-user"></i> &nbsp View Profile Picture</a></li>
    <li><a style="cursor: pointer;" onclick="profilepicpopup_modal();"><i class="glyphicon glyphicon-picture"></i> &nbsp Upload Profile Picture</a></li>
  </ul>


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

<a href="<?php echo site_url("pages/edit_page/" . $page->ID) ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-cog"></span></a> 
<a href="<?php echo site_url("pages/delete_page/" . $page->ID . "/" . $this->security->get_csrf_hash()) ?>" onclick="return confirm('<?php echo lang("ctn_551") ?>')" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
<?php endif; ?>
 </div>
 <div class="profile-header-name">
<?php echo $page->name ?>
 </div>

 </div>
 <div class="profile-header-bar clearfix">
 <ul>
  <li class="active"><a href="<?php echo site_url("pages/view/" . $slug) ?>"><?php echo lang("ctn_552") ?></a></li>
  <li><a href="<?php echo site_url("pages/members/" . $slug) ?>"><?php echo lang("ctn_21") ?></a></li>
  <li><a href="<?php echo site_url("pages/albums/" . $slug) ?>"><?php echo lang("ctn_483") ?></a></li>
  <li><a href="<?php echo site_url("pages/events/" . $slug) ?>"><?php echo lang("ctn_553") ?></a></li>
  <?php if( (isset($member) && $member != null && $member->roleid == 1) || ($this->common->has_permissions(array("admin", "page_admin"), $this->user)) ) : ?>
  <li><a href="<?php echo site_url("pages/settings/" . $slug) ?>"><?php echo lang("ctn_1065") ?></a></li>
<?php endif; ?>
 </ul>

 <div class="pull-right profile-friend-box">
  <?php if($this->user->loggedin) : ?>
  <?php if($member == null) : ?>
    <?php if($page->pay_to_join > 0) : ?>
    <button type="button" class="btn btn-post btn-sm" data-toggle="modal" data-target="#joinModal"><?php echo lang("ctn_554") ?></button>
    <?php else : ?>
    <a href="<?php echo site_url("pages/join_page/" . $page->ID . "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-post btn-sm"><?php echo lang("ctn_554") ?></a>
    <?php endif; ?>
  <?php else : ?>
    <a href="<?php echo site_url("pages/leave_page/" . $page->ID . "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok"></span> <?php echo lang("ctn_34") ?></a> 
  <?php endif; ?>
<?php endif; ?>
  <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#reportModal" title="<?php echo lang("ctn_578") ?>"><span class="glyphicon glyphicon-flag"></span></button>
 </div>
 </div>

 <div class="row half-separator">
 <div class="col-md-4">
    <div class="page-block ">
      <div style="text-align: center;" class="page-block-title">
          <button data-toggle="modal" data-target="#selectvisitingcardtemplate" class="btn btn-success" >Make Page Visiting Card</button>
      </div>
    </div>
    <div class="modal fade" id="selectvisitingcardtemplate">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div style="background:#f6f6f6 !important;padding-bottom: 5px !important;padding-top: 5px !important;" class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style="color: black !important;" class="modal-title">Select Visiting Card Template</h4>
        </div>
        <div class="modal-body">
            <div class="row">
              <?php for ($i=0; $i < 6; $i++) { ?>
                <div style="margin-top: 10px;" class="col-md-4">
                    <div class="visitingcardtemplate1">
                        <div class="row">
                          <div  class="col-md-4">
                              <img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $page->profile_avatar ?>">
                              <div style="font-size: 18px;font-weight: bold; text-align: center;"><?php echo $page->name ?></div>
                          </div>
                          <div style="text-align: right;" class="col-md-8">
                              <div><span class="glyphicon glyphicon-link"></span><?php echo $page->website ?></div>
                                <div><span class="glyphicon glyphicon-phone"></span> <?php echo $page->phone ?></div>
                                <div><span class="glyphicon glyphicon-map-marker"></span> <?php echo $page->location ?></div>
                                <div><span class="glyphicon glyphicon-email"></span> <?php echo $page->email ?></div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d335900.93392687745!2d2.3504871190777603!3d48.87296719673322!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2s!4v1394030722365" style="overflow:hidden;height:100%;width:100%;" frameborder="0" ></iframe>
                          </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <script type="text/javascript">
          $('.visitingcardtemplate1').click(function(){
            $('.visitingcardtemplate1').addClass('activetemplate');
          });
        </script>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Select Template</button>
        </div>
      </div>
    </div>
  </div>
    <div class="page-block ">
        <div class="page-block-title">
          <span class="glyphicon glyphicon-calendar"></span> <a href="">Visit Card</a>
        </div>
        <div style="padding: 10px; background-color: black;">
          <div class="row">
            <div  class="col-md-4">
                <img style="height: 100px;width: 100px;" src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $page->profile_avatar ?>">
                <div style="color: white;font-size: 18px;font-weight: bold; text-align: center;padding-left: 15px;"><?php echo $page->name ?></div>
            </div>
            <div class="col-md-8">
                <div class="page-block-tidbit">
                <span class="glyphicon glyphicon-link"></span> <a href="<?php echo $page->website ?>"><?php echo $page->website ?></a>
                </div>
            </div>
          </div>
        </div>
        <!-- <div style="width: 100%"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=gujranwala+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://www.maps.ie/route-planner.htm">Road Trip Planner</a></div> -->

        <div class="page-block-tidbit">
            <iframe src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=<?php echo $page->location  ?>+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" style="overflow:hidden;height:100%;width:100%;" frameborder="0" ></iframe>
        </div>

    </div>

 	<div style="border-radius: 3px; border: 1px solid #DDD;" class="page-block half-separator">
 	
 	<div class="page-block-title">
 	<span class="glyphicon glyphicon-home"></span> <?php echo $page->name ?>
 	</div>
 	<div class="page-block-intro">
 	<?php echo $page->description ?>
 	</div>
  <hr>
 <?php if(isset($page->location) && !empty($page->location)) : ?>
    <div class="page-block-tidbit">
    <span class="glyphicon glyphicon-map-marker"></span> <?php echo $page->location ?>
    </div>
  <?php endif; ?>
   <?php if(isset($page->email) && !empty($page->email)) : ?>
    <div class="page-block-tidbit">
    <span class="glyphicon glyphicon-envelope"></span> <?php echo $page->email ?>
    </div>
  <?php endif; ?>
  <?php if(isset($page->phone) && !empty($page->phone)) : ?>
    <div class="page-block-tidbit">
    <span class="glyphicon glyphicon-phone"></span> <?php echo $page->phone ?>
    </div>
  <?php endif; ?>
  <?php if(isset($page->website) && !empty($page->website)) : ?>
    <div class="page-block-tidbit">
    <span class="glyphicon glyphicon-link"></span> <a href="<?php echo $page->website ?>"><?php echo $page->website ?></a>
    </div>
  <?php endif; ?>

 	</div>

        <?php if($this->settings->info->enable_google_ads_pages) : ?>
          <div class="page-block half-separator">
            <div class="page-block-page clearfix">
            <?php include(APPPATH . "/views/home/google_ads.php"); ?>
          </div>
          </div>
        <?php endif; ?>

        <?php if($this->settings->info->enable_rotation_ads_pages) : ?>
            <?php include(APPPATH . "/views/pages/rotation_ads.php"); ?>
        <?php endif; ?>


    <div class="page-block half-separator">
        <div class="page-block-title">
          <span class="glyphicon glyphicon-user"></span> <a href="<?php echo site_url("pages/members/" . $slug) ?>"><?php echo lang("ctn_21") ?></a>
        </div>
        <div class="page-block-tidbit">
       <?php foreach($users->result() as $r) : ?>
        <a href="<?php echo site_url("profile/" . $r->username) ?>">
          <div style="border: 1px solid #DDD; padding: 5px; margin: 3px; height: 130px;" class="profile-friend-area onhoverchangewhitecolor">
          <p><img style=" width: 100%; height: 100%; " src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->avatar ?>"></p>
          <p><?php echo $r->first_name ?> <?php echo $r->last_name ?></p>
          </div>
          </a>
        <?php endforeach; ?>
        </div>

    </div>

    <div class="page-block half-separator">
        <div class="page-block-title">
          <span class="glyphicon glyphicon-picture"></span> <a href="<?php echo site_url("pages/albums/" . $slug) ?>"><?php echo lang("ctn_483") ?></a>
        </div>
        <div class="page-block-tidbit">
          <?php foreach($albums->result() as $r) : ?>
            <div class="profile-album-area">
            <?php if(isset($r->file_name)) : ?>
              <a href="<?php echo site_url("pages/view_album/" . $r->ID) ?>"><img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->file_name ?>"></a>
            <?php else : ?>
              <a href="<?php echo site_url("pages/view_album/" . $r->ID) ?>"><img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/default_album.png"></a>
            <?php endif; ?>
            <p><a href="<?php echo site_url("pages/view_album/" . $r->ID) ?>"><?php echo $r->name ?></a></p>
            </div>
          <?php endforeach; ?>
        </div>

    </div>

    <div class="page-block half-separator">
        <div class="page-block-title">
          <span class="glyphicon glyphicon-calendar"></span> <a href="<?php echo site_url("pages/events/" . $slug) ?>"><?php echo lang("ctn_553") ?></a>
        </div>
        <div class="page-block-tidbit">
         <?php foreach($events->result() as $r) : ?>
          <div class="page-event">
            <p class="page-event-title"><a href="<?php echo site_url("pages/view_event/" . $r->ID) ?>"><?php echo $r->title ?></a></p>
            <p><span class="glyphicon glyphicon-calendar"></span> <?php echo $r->start ?> ~ <?php echo $r->end ?> </p>
          </div>

        <?php endforeach; ?>

        </div>

    </div>

 </div>

 <div class="col-md-8">
  <?php if($this->user->loggedin) : ?>
  <?php if($member != null && $member->roleid == 1) : ?>
    <?php
    $postAsDefault = "page";
    $postAs = $page->name;
    $postAsImg = $page->profile_avatar;

     ?>
  <?php endif; ?>
  <?php 
  // Page defaults
  $editor_placeholder = lang("ctn_579") . " " . $page->name . "'s ".lang("ctn_552")." ...";
  $target_type = "page_profile";
  $targetid = $page->ID;
  $pageid = $page->ID;
  ?>

  <?php if( ($page->posting_status == 0 && $member != null && $member->roleid) || ($page->posting_status == 1 && $member != null) || ($page->posting_status == 2) || ( $this->common->has_permissions(array("admin", "page_admin"), $this->user) ) ) : ?>
  <?php // only show editor if [admins can only post || members can only post || anyone can post || Is page admin/admin role] ?>
 	
 <?php include(APPPATH . "views/feed/editor.php"); ?>
<?php endif; ?>
<?php endif; ?>

<div id="home_posts">

</div>

</div>
 </div>

 </div>
</div>
   <?php echo form_open(site_url("pages/report_page/" . $page->ID)) ?>
 <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-flag"></span> <?php echo lang("ctn_578") ?> <?php echo $page->name ?></h4>
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
<?php echo form_close() ?>

 <div class="modal fade" id="joinModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-flag"></span> <?php echo lang("ctn_628") ?> <?php echo $page->name ?></h4>
      </div>
      <div class="modal-body ui-front form-horizontal">
         <p><?php echo lang("ctn_827") ?> <strong><?php echo $page->pay_to_join ?> <?php echo lang("ctn_350") ?></strong>. <?php echo lang("ctn_828") ?> <a href="<?php echo site_url("funds") ?>"><?php echo lang("ctn_250") ?></a> <?php echo lang("ctn_275") ?>.</p>
         <p><?php echo lang("ctn_276") ?> <strong><?php echo $this->user->info->points ?> <?php echo lang("ctn_350") ?></strong>.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
        <a href="<?php echo site_url("pages/join_page/" . $page->ID . "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-post btn-sm"><?php echo lang("ctn_554") ?></a>
      </div>
    </div>
  </div>
</div>