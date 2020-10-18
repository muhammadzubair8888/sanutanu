    <div class="row">
        <div class="col-md-2 sidebar-block custom-scrollbar-css" id="homepage-links">
          
        <ul>
        <li <?php if($type == 0) : ?>class="active"<?php endif; ?>><a href="<?php echo site_url("home") ?>"><span class="fa fa-house-user sidebaricon"></span> <?php echo lang("ctn_481") ?></a></li>
        <li><a href="<?php echo site_url("profile/" . $this->user->info->username) ?>"><span class="fa fa-user-tie sidebaricon"></span> <?php echo lang("ctn_200") ?></a></li>
        <li><a href="<?php echo site_url("marriage/profile/" . $this->user->info->username) ?>"><span class="fa fa-heart sidebaricon"></span> <?php echo lang("ctn_1040") ?></a></li>
        <li><a href="<?php echo site_url("chat") ?>"><span class="far fa-envelope sidebaricon"></span> <?php echo lang("ctn_482") ?></a></li>

        <li><a href="<?php echo site_url("home/notifications") ?>"><span class="far fa-bell sidebaricon"></span><?php if($this->user->info->noti_count > 0) : ?><span class="badge notification-badge notification-badge2 small-text"><?php echo $this->user->info->noti_count ?></span><?php endif; ?> <?php echo lang("ctn_412") ?></a></li>

        <li <?php if($type == 0) : ?><?php endif; ?>><a style="color: red !important;" href="<?php echo site_url("marriage/findpartner") ?>"><span style="color: red !important;" class="fa fa-heart sidebaricon"></span> <?php echo lang("ctn_1039") ?></a></li>

        <?php if($this->settings->info->enable_blogs) : ?>
          <li><a href="<?php echo site_url("blog/your") ?>"><span class="fa fa-blog sidebaricon"></span> <?php echo lang("ctn_780") ?></a></li>
        <?php endif; ?>




        <li><a href="<?php echo site_url("user_settings") ?>"><span class="fa fa-user-cog sidebaricon"></span> <?php echo lang("ctn_156") ?></a></li>

        <?php if($this->user->loggedin) : ?>
        <li><a href="<?php echo site_url("login/logout/" . $this->security->get_csrf_hash()) ?>"><span class="fa fa-sign-out-alt sidebaricon"></span> <?php echo lang("ctn_149") ?></a></li>
        <?php endif; ?>
        </ul>

        <p class="sidebar-title"><?php echo lang("ctn_525") ?></p>
        <ul>
        <li><a href="<?php echo site_url("profile/albums/" . $this->user->info->ID) ?>"><span class="fa fa-images sidebaricon"></span> <?php echo lang("ctn_483") ?></a></li>
        <li><a href="<?php echo site_url("pages/your") ?>"><span class="fa fa-copy sidebaricon"></span> <?php echo lang("ctn_484") ?></a></li>
        <li><a href="<?php echo site_url("groups/index") ?>"><span class="fa fa-users sidebaricon"></span><?php echo lang("ctn_1021") ?></a></li>
   
        <?php if($this->settings->info->enable_blogs) : ?>
          <li><a href="<?php echo site_url("blog/new_posts") ?>"><span class="fa fa-blog sidebaricon"></span> <?php echo lang("ctn_772") ?></a></li>
        <?php endif; ?>
        <li <?php if($type == 2) : ?>class="active"<?php endif; ?>><a href="<?php echo site_url("home/index/2") ?>"><span class="far fa-list-alt sidebaricon" style="color: #a41be3"></span> <?php echo lang("ctn_485") ?></a></li>
        <?php if($this->settings->info->payment_enabled) : ?>
        <li><a href="<?php echo site_url("funds") ?>"><span class="fa fa-money-bill sidebaricon"></span> <?php echo lang("ctn_250") ?></a></li>
        <?php endif; ?>
        </ul>
        <?php if($this->common->has_permissions(array("admin", "admin_members", "admin_payment", "admin_settings", "post_admin", "page_admin"), $this->user)) : ?>
          <p class="sidebar-title"><?php echo lang("ctn_35") ?></p>
          <ul>
        <?php endif; ?>
        <?php if($this->common->has_permissions(array("admin", "admin_members", "admin_payment", "admin_settings"), $this->user)) : ?>
        <li><a href="<?php echo site_url("admin") ?>"><span class="fa fa-tools sidebaricon"></span> <?php echo lang("ctn_157") ?></a></li>
        <?php endif; ?>
        <?php if($this->common->has_permissions(array("admin", "post_admin"), $this->user)) : ?>
          <li <?php if($type == 4) : ?>class="active"<?php endif; ?>><a href="<?php echo site_url("home/index/4") ?>"><span class="far fa-list-alt sidebaricon" style="color: #a41be3"></span> <?php echo lang("ctn_486") ?></a></li>
        <?php endif; ?>
        <?php if($this->common->has_permissions(array("admin", "page_admin"), $this->user)) : ?>
          <li><a href="<?php echo site_url("pages/all") ?>"><span class="fa fa-list-alt sidebaricon"></span> <?php echo lang("ctn_487") ?></a></li>
        <?php endif; ?>
        <?php if($this->common->has_permissions(array("admin", "admin_members", "admin_payment", "admin_settings", "post_admin", "page_admin"), $this->user)) : ?>
        </ul>
      <?php endif; ?>

        <hr>

        <p class="sidebar-title">
        <?php echo lang("ctn_526") ?></p>
        <ul>
          <?php foreach($hashtags->result() as $r) : ?>
            <li><a href="<?php echo site_url("home/index/1/" . $r->hashtag) ?>">#<?php echo $r->hashtag ?></a></li>
          <?php endforeach; ?>
        </ul>
        </div>
        <div class="col-md-6">
 
 <?php include(APPPATH . "views/feed/editor.php"); ?>
 <?php include(APPPATH . "views/feed/story.php"); ?>


<div id="home_posts">

</div>


  </div>

        <div class="col-md-4 homepage-stuff" id="homepage-stuff">
        
        <!-- <div class="page-block">
          <div class="page-block-inner" style="background: url(<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative . "/" . $this->user->info->profile_header ?>) center center; background-size: cover;">
          <div class="page-block-avatar">
          <img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->user->info->avatar ?>">
          </div> 
          <div class="page-block-info">
          <a href="<?php echo site_url("profile/" . $this->user->info->username) ?>"><?php echo $this->user->info->first_name ?> <?php echo $this->user->info->last_name ?></a>
          </div>
          </div>
        </div> -->

        <?php if($this->settings->info->enable_google_ads_feed) : ?>
          <div class="page-block half-separator" style="margin-top:0px;">
            <div class="page-block-page clearfix">
            <?php include(APPPATH . "/views/home/google_ads.php"); ?>
          </div>
          </div>
        <?php endif; ?>

        <?php if($this->settings->info->enable_rotation_ads_feed) : ?>
          <?php include(APPPATH . "/views/home/rotation_ads.php"); ?>
        <?php endif; ?>

        <div id="hidewhenaddshow" class="page-block half-separator">
         <div class="page-block-title"><?php echo lang("ctn_527") ?></div>
         <?php foreach($users->result() as $r) : ?>
          <div class="page-block-page clearfix">
            <div class="pull-left" style="margin-right: 15px;">
              <a href="<?php echo site_url("profile/" . $r->username) ?>"><img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->avatar ?>" width="40"></a>
            </div>
            <div class="pull-left">
              <a href="<?php echo site_url("profile/" . $r->username) ?>"><?php echo $r->first_name ?> <?php echo $r->last_name ?></a>
              <p class="small-text faded-icon">@<?php echo $r->username ?></p>
            </div>

            <?php
              $CI =& get_instance();
              // check user is friend
              $friend_flag = 0;
              $request_flag = 0;
              $friend = $CI->user_model->get_user_friend($this->user->info->ID, $r->ID);
              if($friend->num_rows() > 0) {
                // Friends
                $friend_flag = 1;
              } else {
                // Check for a request
                $request = $CI->user_model->check_friend_request($this->user->info->ID, $r->ID);
                if($request->num_rows() > 0) {
                  // Request sent
                  $request_flag = 1;
                }
              }
            ?>
            <div class="pull-right" style="padding-top: 5px;">
              <?php if($this->user->loggedin){
                ?>
                <?php if($friend_flag) : ?>
                <button type="button" class="btn btn-post btn-sm" style="border-radius: 40px;" id="friend_button_<?php echo $r->ID ?>"><span class="glyphicon glyphicon-ok"></span> <?php echo lang("ctn_493") ?></button>
                <?php else : ?>
                <?php if($request_flag) : ?>
                <button type="button" class="btn btn-post btn-sm disabled" style="border-radius: 40px;" id="friend_button_<?php echo $r->ID ?>"><?php echo lang("ctn_601") ?></button>
                <?php else : ?> 
                  <?php if(!$r->allow_friends) : ?>
                  <button type="button" class="btn btn-post btn-sm" style="border-radius: 40px;" onclick="add_friend(<?php echo $r->ID ?>)" id="friend_button_<?php echo $r->ID ?>"><?php echo lang("ctn_602") ?></button>
                  <?php endif; ?>
                <?php endif; ?>
                <?php endif; ?>
                <?php
              } ?>

            </div>

          </div>
         <?php endforeach; ?>
        </div>


        <div class="page-block half-separator">
         <div class="page-block-title"><?php echo lang("ctn_528") ?></div>
         <?php foreach($pages->result() as $r) : ?>
          <?php 
          if(!empty($r->slug)) {
            $slug = $r->slug;
          } else {
            $slug = $r->ID;
          } ?>
         	<div class="page-block-page clearfix">
         		<div class="pull-left" style="margin-right: 5px;">
         			<img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->profile_avatar ?>" width="40">
         		</div>
         		<div class="pull-left">
         			<a href="<?php echo site_url("pages/view/" . $slug) ?>"><?php echo $r->name ?></a>
         			<p class="small-text faded-icon"><?php echo $r->members ?> Members</p>
         		</div>
         	</div>
         <?php endforeach; ?>
        </div>

        </div>
      </div>

<script type="text/javascript">
var global_page = 0;
var hide_prev = 0;



$(document).ready(function() {
  load_posts();

});

function load_posts_wrapper() 
{
  load_posts();
}

<?php if($type == 0) : ?>
function load_posts() 
{
  $.ajax({
    url: global_base_url + 'feed/load_home_posts',
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
<?php elseif($type == 1) : ?>
function load_posts() 
{
  $.ajax({
    url: global_base_url + 'feed/load_hashtag_posts',
    type: 'GET',
    data: {
      hashtag : "<?php echo $hashtag ?>",
    },
    success: function(msg) {
      $('#home_posts').html(msg);
      $('#home_posts').jscroll({
          nextSelector : '.load_next'
      });
    }
  })
}
<?php elseif($type == 2) : ?>
function load_posts() 
{
  $.ajax({
    url: global_base_url + 'feed/load_saved_posts',
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
<?php elseif($type == 3) : ?>
var commentid = <?php echo $commentid ?>;
var replyid = <?php echo $replyid ?>;
function load_posts() 
{
  $.ajax({
    url: global_base_url + 'feed/load_single_post/<?php echo $postid ?>',
    type: 'GET',
    data: {
    },
    success: function(msg) {
      $('#home_posts').html(msg);
      if(commentid > 0) {
        // Load comment up
        load_single_comment(<?php echo $postid ?>,commentid, replyid);
      }
    }
  })
}
<?php elseif($type == 4) : ?>
function load_posts() 
{
  $.ajax({
    url: global_base_url + 'feed/load_all_posts',
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
<?php endif; ?>
</script>