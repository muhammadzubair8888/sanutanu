    <style type="text/css">
div.navbar-findcond { background: #fff; border-color: #ccc; box-shadow: 0 0 2px 0 #ccc; margin-bottom: 0; }
div.navbar-findcond a { color: #f14444; }
div.navbar-findcond ul.navbar-nav a { color: #f14444; border-style: solid; border-width: 0 0 2px 0; border-color: #fff; cursor: pointer; margin-left: 12px; }
div.navbar-findcond ul.navbar-nav a:hover,
div.navbar-findcond ul.navbar-nav a:visited,
div.navbar-findcond ul.navbar-nav a:focus,
div.navbar-findcond ul.navbar-nav a:active { background: #fff; }
div.navbar-findcond ul.navbar-nav a:hover, div.navbar-findcond ul.navbar-nav a.active { border-color: #f14444; }
div.navbar-findcond ul.navbar-nav a.active { font-weight: bold; }
div.navbar-findcond li.divider { background: #ccc; }
div.navbar-findcond button.navbar-toggle { background: #f14444; border-radius: 2px; }
div.navbar-findcond button.navbar-toggle:hover { background: #999; }
div.navbar-findcond button.navbar-toggle > span.icon-bar { background: #fff; }
div.navbar-findcond ul.dropdown-menu { border: 0; background: #fff; border-radius: 4px; margin: 4px 0; box-shadow: 0 0 4px 0 #ccc; }
div.navbar-findcond ul.dropdown-menu > li > a { color: #444; }
div.navbar-findcond ul.dropdown-menu > li > a:hover { background: #f14444; color: #fff; }
div.navbar-findcond span.badge { background: #f14444; font-weight: normal; font-size: 11px; margin: 0 4px; }
div.navbar-findcond span.badge.new { background: rgba(255, 0, 0, 0.8); color: #fff; }
    </style>
    <!-- <pre> -->
      <?php //print_r($get); ?>
    <!-- </pre> -->
        <div class="row navbar-findcond">
          <ul class="nav navbar-nav" style="margin-bottom: 0;">
            <li><a onclick="$('.searchtype').val('all');searchinfo();" <?php if(@$get['searchtype']=='all' || @$get['searchtype']=='')echo 'class="active"'; ?>>All</a></li>
            <li><a onclick="$('.searchtype').val('posts');searchinfo();" <?php if(@$get['searchtype']=='posts')echo 'class="active"'; ?>>Posts</a></li>
            <li><a onclick="$('.searchtype').val('people');searchinfo();" <?php if(@$get['searchtype']=='people')echo 'class="active"'; ?>>People</a></li>
            <li><a onclick="$('.searchtype').val('photos');searchinfo();" <?php if(@$get['searchtype']=='photos')echo 'class="active"'; ?>>Photos</a></li>
            <li><a onclick="$('.searchtype').val('videos');searchinfo();" <?php if(@$get['searchtype']=='videos')echo 'class="active"'; ?>>Videos</a></li>
            <li><a onclick="$('.searchtype').val('pages');searchinfo();" <?php if(@$get['searchtype']=='pages')echo 'class="active"'; ?>>Pages</a></li>
            <!-- <li><a>Places</a></li> -->
            <li><a onclick="$('.searchtype').val('groups');searchinfo();" <?php if(@$get['searchtype']=='groups')echo 'class="active"'; ?>>Groups</a></li>
            <!-- <li><a>Apps</a></li> -->
            <!-- <li><a onclick="$('.searchtype').val('events');searchinfo();" <?php //if(@$get['searchtype']=='events')echo 'class="active"'; ?>>Events</a></li> -->
            <li><a onclick="$('.searchtype').val('links');searchinfo();" <?php if(@$get['searchtype']=='links')echo 'class="active"'; ?>>Links</a></li>
          </ul>
        </div>
<?php $searchtype = @$get['searchtype']; ?>
    <div class="row">
        <div class="col-md-2 sidebar-block custom-scrollbar-css" id="homepage-links" style="z-index: 2;">
          <input type="hidden" class="searchtype" value="<?php echo $searchtype; ?>">
       <?php if($searchtype!='links'){
        echo '<h4>Filter Results</h4>';
       }else
       {
        $type = 0;
        $hashtags = '';
        ?>
          

          <ul>
        <li <?php if($type == 0) : ?>class="active"<?php endif; ?>><a href="<?php echo site_url("home") ?>"><span class="fa fa-house-user sidebaricon"></span> <?php echo lang("ctn_481") ?></a></li>
        <li><a href="<?php echo site_url("profile/" . $this->user->info->username) ?>"><span class="fa fa-user-tie sidebaricon"></span> <?php echo lang("ctn_200") ?></a></li>
        <li><a href="<?php echo site_url("chat") ?>"><span class="far fa-envelope sidebaricon"></span> <?php echo lang("ctn_482") ?></a></li>

        <li><a href="<?php echo site_url("home/notifications") ?>"><span class="far fa-bell sidebaricon"></span><?php if($this->user->info->noti_count > 0) : ?><span class="badge notification-badge notification-badge2 small-text"><?php echo $this->user->info->noti_count ?></span><?php endif; ?> <?php echo lang("ctn_412") ?></a></li>

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



        <?php
       }//end if searchtype!='links'


        ?>   
          


<?php if($searchtype=="all" || $searchtype =="" || $searchtype == "posts" || $searchtype=='photos'): ?>
          <div class="searchfilter-section">
            <h5>Posts From</h5>
            <div class="searchfilterrow">
              <input <?php echo (@$get['from']=="")?"checked":""; ?> type="radio" name="postsfrom" id="postsfromanyone" value="" onclick="$('#from').val('');$('#fromtype').val('');searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="postsfromanyone">Anyone</label>
            </div>

            <div class="searchfilterrow">
              <input <?php echo (@$get['from']=="you")?"checked":""; ?> type="radio" name="postsfrom" id="postsfromyou" value="you" onclick="$('#from').val('you');$('#fromtype').val('');searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="postsfromyou">You</label>
            </div>

            <div class="searchfilterrow">
              <input <?php echo (@$get['from']=="friends")?"checked":""; ?> type="radio" name="postsfrom" id="postsfromfriends" value="friends" onclick="$('#from').val('friends');$('#fromtype').val('');searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="postsfromfriends">Your Friends</label>
            </div>

            <div class="searchfilterrow">
              <input <?php echo (@$get['from']=="groupsandpages")?"checked":""; ?> type="radio" name="postsfrom" id="postsfromgroupsandpages" value="groupsandpages" onclick="$('#from').val('groupsandpages');$('#fromtype').val('');searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="postsfromgroupsandpages">Your Groups and Pages</label>
            </div>

            <div class="searchfilterrow">
              <input <?php echo (@$get['from']=="public")?"checked":""; ?> type="radio" name="postsfrom" id="postsfrompublic" value="public" onclick="$('#from').val('public');$('#fromtype').val('');searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="postsfrompublic">Public</label>
            </div>
            <?php if(@$get['fromtype']!=""): ?>
              <div class="searchfilterrow">
                <input checked type="radio" name="postsfrom" id="postsfrompublic" value="<?php echo @$get['from']; ?>" > 
                <label style="font-size: 12px; font-weight: normal;" for="postsfrompublic"><?php $s = $this->search_model->get_source(@$get['from'],@$get['fromtype']); ?>
                  <img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative; ?>/<?php echo $s->avatar; ?>" style="width: 20px; height: 20px;" /> &nbsp; <?php echo $s->name; ?>
                </label>
              </div>
            <?php endif; ?>

            <div class="searchfilterrow link_sources" style=" display: flex; align-items: center;font-size: 12px;"><i class="far fa-plus-square" style="color: #999;"></i> &nbsp;<a onclick="$('.searchbox_sources').show();$('.link_sources').hide();$('#source').focus();">Choose a Source...</a></div>

            <div class="searchfilterrow searchbox_sources" style="display: none;">
              <input type="text" name="source" class="filterinput autocomplete" id="source" data-template="source" data-uri="sources" autocomplete="off" />
            </div>

          </div><!-- end posts from -->
<?php endif; ?>



<?php if($searchtype=='pages'): ?>

<div class="searchfilter-section">
            <h5>CATEGORY</h5>
            <div class="searchfilterrow">
              <input <?php echo (@$get['pcat']==0)?"checked":""; ?> type="radio" name="pcategory" id="pcategory" value="" onclick="$('#pcat').val(0);searchinfo();">
              <label style="font-size: 12px; font-weight: normal;" for="pcategory">Any</label>
            </div>

            <?php foreach($this->page_model->get_all_categories()->result() as $c): ?>
            <div class="searchfilterrow">
              <input <?php echo (@$get['pcat']==$c->ID)?"checked":""; ?> type="radio" name="pcategory" id="pcategory<?php echo $c->ID; ?>" value="seen" onclick="$('#pcat').val(<?php echo $c->ID; ?>);searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="pcategory<?php echo $c->ID; ?>"><?php  echo $c->name;?></label>
            </div>
          <?php endforeach; ?>

          </div><!-- END SOURCE -->

<?php endif; ?>




<?php if($searchtype=='videos'): ?>

<div class="searchfilter-section">
            <h5>SOURCE</h5>
            <div class="searchfilterrow">
              <input <?php echo (@$get['vtype']==0)?"checked":""; ?> type="radio" name="vidtype" id="vidtype0" value="" onclick="$('#vtype').val(0);searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="vidtype0">Any</label>
            </div>

            <div class="searchfilterrow">
              <input <?php echo (@$get['vtype']==1)?"checked":""; ?> type="radio" name="vidtype" id="vidtype1" value="seen" onclick="$('#vtype').val(1);searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="vidtype1">Live</label>
            </div>

            <div class="searchfilterrow">
              <input <?php echo (@$get['vtype']==2)?"checked":""; ?> type="radio" name="vidtype" id="vidtype2" value="seen" onclick="$('#vtype').val(2);searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="vidtype2">From Groups</label>
            </div>

          </div><!-- END SOURCE -->

<?php endif; ?>


<?php if($searchtype=='videos'): ?>

<div class="searchfilter-section">
            <h5>DATE POSTED</h5>
            <div class="searchfilterrow">
              <input <?php echo (@$get['vdate']==0)?"checked":""; ?> type="radio" name="viddate" id="viddate0" value="" onclick="$('#vdate').val(0);searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="viddate0">Any Date</label>
            </div>

            <div class="searchfilterrow">
              <input <?php echo (@$get['vdate']==1)?"checked":""; ?> type="radio" name="viddate" id="viddate1" value="seen" onclick="$('#vdate').val(1);searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="viddate1">Today</label>
            </div>

            <div class="searchfilterrow">
              <input <?php echo (@$get['vdate']==2)?"checked":""; ?> type="radio" name="viddate" id="viddate2" value="seen" onclick="$('#vdate').val(2);searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="viddate2">This Week</label>
            </div>

            <div class="searchfilterrow">
              <input <?php echo (@$get['vdate']==3)?"checked":""; ?> type="radio" name="viddate" id="viddate3" value="seen" onclick="$('#vdate').val(3);searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="viddate3">This Month</label>
            </div>

          </div><!-- end DATE POSTED -->

<?php endif; ?>





<?php if($searchtype=="all" || $searchtype =="" || $searchtype == "posts" || $searchtype=='photos'): ?>
          <div class="searchfilter-section">
            <h5>Post Type</h5>
            <div class="searchfilterrow">
              <input <?php echo (@$get['type']!="seen")?"checked":""; ?> type="radio" name="posttype" id="posttypeall" value="" onclick="$('#type').val('');searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="posttypeall">All Posts</label>
            </div>

            <div class="searchfilterrow">
              <input <?php echo (@$get['type']=="seen")?"checked":""; ?> type="radio" name="posttype" id="posttypeseen" value="seen" onclick="$('#type').val('seen');searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="posttypeseen">Posts You've Seen</label>
            </div>

          </div><!-- end Post Type -->
<?php endif; ?>

<?php if($searchtype=="all" || $searchtype =="" || $searchtype == "posts" || $searchtype=='photos'): ?>
          <div class="searchfilter-section">
            <h5>Posted in Group</h5>
            <div class="searchfilterrow">
              <input <?php echo (@$get['group']=="" )?"checked":""; ?> type="radio" name="postgroup" id="postgroupany" value="" onclick="$('#group').val('');searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="postgroupany">Any Group</label>
            </div>

            <div class="searchfilterrow">
              <input <?php echo (@$get['group']=="your")?"checked":""; ?> type="radio" name="postgroup" id="postgroupyour" value="your" onclick="$('#group').val('your');searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="postgroupyour">Your Groups</label>
            </div>
            
            <?php if(@$get['group']>0): ?>
              <div class="searchfilterrow">
                <input <?php echo (@$get['group']>0)?"checked":""; ?> type="radio" name="postgroup" id="postgroupin" value="your" onclick="$('#group').val('<?php echo $get['group']; ?>');searchinfo();"> 
                <label style="font-size: 12px; font-weight: normal;" for="postgroupin"><?php echo $this->db->get_where('user_groups',array('ID'=>$get['group']))->row()->name; ?></label>
              </div>
          <?php endif; ?>

            <div class="searchfilterrow grp_source" style=" display: flex; align-items: center;font-size: 12px;"><i class="far fa-plus-square" style="color: #999;"></i> &nbsp;<a onclick="$('.grp_input').show();$('.grp_source').hide();$('.grp_input .autocomplete').focus();">Choose a Group...</a></div>
            
            <div class="searchfilterrow grp_input" style=" display: flex; align-items: center;font-size: 12px; display: none;">
              <input type="text" class="filterinput autocomplete" data-uri="groups" data-template="group" />
            </div>

          </div><!-- end Posted in Group -->
<?php endif; ?>


<?php if($searchtype=="people"): ?>
          <div class="searchfilter-section">
            <h5>Friends of Friends</h5>
            <div class="searchfilterrow">
              <input <?php echo (@$get['fof']=="1" )?"checked":""; ?> type="checkbox" name="friendschk" id="friendschk" value="" onclick="checkfriendsoffriends(this.checked);"> 
              <label style="font-size: 12px; font-weight: normal;" for="friendschk">Friends of Friends</label>
            </div>
          </div>
<script type="text/javascript">
  function checkfriendsoffriends(chk)
  {
    if(chk==true)
    {
      $('#fof').val(1);
    }
    else
    {
      $('#fof').val('');
    }
    searchinfo();
  }
</script>
<?php endif; ?>



<?php if($searchtype=="all" || $searchtype =="" || $searchtype == "posts" || $searchtype=='photos' || $searchtype=='people' || $searchtype=='videos' || $searchtype == 'pages'): ?>
          <div class="searchfilter-section">
            <h5><!-- Tagged  -->Location</h5>
            <div class="searchfilterrow">
              <input <?php echo (@$get['city']=="")?"checked":""; ?> type="radio" name="postslocation" id="postslocationany" value="" onclick="$('#city').val('');searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="postslocationany">Anywhere</label>
            </div>

            <div class="searchfilterrow">
              <input <?php echo (@$get['city']==$this->user->info->city)?"checked":""; ?> type="radio" name="postslocation" id="postslocationmycity" value="<?php echo $this->user->info->city; ?>" onclick="$('#city').val('<?php echo $this->user->info->city; ?>');searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="postslocationmycity"><?php echo $this->user->info->city; ?>, <?php echo $this->user->info->country; ?></label>
            </div>

            <div class="searchfilterrow input_locations" style="<?php echo (@$get['city']!=$this->user->info->city && @$get['city']!='')?'':'display: none;'; ?>" >
              <input <?php echo (@$get['city']!=$this->user->info->city && @$get['city']!="")?"checked":""; ?> type="radio" name="postslocation" id="postslocationcity" value="<?php echo @$get['city']; ?>" > 
              <label style="font-size: 12px; font-weight: normal;" id="label_locations" for="postslocationcity"><?php echo @$get['city']; ?>, <?php echo @$this->search_model->getcountrybycity(@$get['city']); ?></label>
            </div>

            <div class="searchfilterrow link_locations" style=" display: flex; align-items: center;font-size: 12px;">
              <i class="far fa-plus-square" style="color: #999;"></i> &nbsp;
              <a onclick="$('#location.typeahead').val('');$('.searchbox_locations').show();$('.link_locations').hide();$('#location.typeahead').focus();" >Choose a Location...</a>
            </div>
            <div class="searchfilterrow searchbox_locations" style="display: none;">
              <input type="text" name="location" class="filterinput autocomplete" id="location" autocomplete="off" data-uri="locations" data-template="city" />
            </div>
          </div><!-- end Tagged Location -->
<?php endif; ?>


<?php if($searchtype=='people'): ?>
          <div class="searchfilter-section">
            <h5><!-- Tagged  -->Education</h5>
            <div class="searchfilterrow">
              <input <?php echo (@$get['edu']=="")?"checked":""; ?> type="radio" name="education" id="educationany" value="" onclick="$('#edu').val('');searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="educationany">Any School</label>
            </div>
            <?php  
            $ud = $this->user_model->get_user_data($this->user->info->ID);
            $myed = 0;
            if($ud->num_rows()>0):
              $u = $ud->row();
              if($u->school!=""):
                if(strtolower(@$get['edu'])==strtolower($u->school) || strtolower(@$get['edu'])==strtolower($u->college))
                {
                  $myed = 1;
                }
            ?>
            <div class="searchfilterrow">
              <input <?php echo (@$get['edu']==$u->school)?"checked":""; ?> type="radio" name="education" id="education1" value="<?php echo $u->school; ?>" onclick="$('#edu').val('<?php echo $u->school; ?>');searchinfo();">
              <label style="font-size: 12px; font-weight: normal;" for="education1">
                <?php echo $u->school; ?>
              </label>
            </div>
          <?php 
              endif;
              if($u->college!=""):
            ?>
            <div class="searchfilterrow">
              <input <?php echo (@$get['edu']==$u->college)?"checked":""; ?> type="radio" name="education" id="education2" value="<?php echo $u->college; ?>" onclick="$('#edu').val('<?php echo $u->college; ?>');searchinfo();">
              <label style="font-size: 12px; font-weight: normal;" for="education2">
                <?php echo $u->college; ?>
              </label>
            </div>
          <?php 
              endif;
           ?>


            <?php endif; ?>
            <?php if($myed==0 && @$get['edu']!=""): ?>
            <div class="searchfilterrow input_locations" >
              <input <?php echo ($myed==0)?"checked":""; ?> type="radio" name="education" id="education3" value="<?php echo @$get['edu']; ?>" > 
              <label style="font-size: 12px; font-weight: normal;" id="label_locations" for="education3"><?php echo @$get['edu']; ?></label>
            </div>
          <?php endif; ?>

            <div class="searchfilterrow link_edu" style=" display: flex; align-items: center;font-size: 12px;">
              <i class="far fa-plus-square" style="color: #999;"></i> &nbsp;
              <a onclick="$('.searchbox_edu').show();$('.link_edu').hide();$('.searchbox_edu .autocomplete').focus();" >Choose a School...</a>
            </div>
            <div class="searchfilterrow searchbox_edu" style="display: none;">
              <input type="text" class="filterinput autocomplete" autocomplete="off" data-uri="places/1/" data-template="school" />
            </div>
          </div><!-- end Tagged Location -->
<?php endif; ?>


<?php if($searchtype=='people'): ?>
          <div class="searchfilter-section">
            <h5><!-- Tagged  -->Work</h5>
            <div class="searchfilterrow">
              <input <?php echo (@$get['work']=="")?"checked":""; ?> type="radio" name="job" id="jobany" value="" onclick="$('#work').val('');searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="jobany">Any Company</label>
            </div>

            

            <?php  
            //$ud = $this->user_model->get_user_data($this->user->info->ID);
            $myjob = 0;
            if($ud->num_rows()>0):
              $u = $ud->row();
              if($u->work!=""):
                if( strtolower(@$get['work']) == strtolower($u->work) )
                {
                  $myjob = 1;
                }
            ?>
            <div class="searchfilterrow">
              <input <?php echo (@$get['work']==$u->work)?"checked":""; ?> type="radio" name="job" id="job1" value="<?php echo $u->work; ?>" onclick="$('#edu').val('<?php echo $u->work; ?>');searchinfo();">
              <label style="font-size: 12px; font-weight: normal;" for="job1">
                <?php echo $u->work; ?>
              </label>
            </div>
          <?php
              endif;


            endif; ?>


            <?php if($myjob==0 && @$get['work'] !='' ): ?>
            <div class="searchfilterrow" style="<?php echo (@$get['work']!=$this->user->info->city && @$get['work']!='')?'':'display: none;'; ?>" >
              <input <?php echo ($myjob==0 && @$get['work'] !='')?"checked":""; ?> type="radio" name="job" id="job2" value="<?php echo @$get['work']; ?>" > 
              <label style="font-size: 12px; font-weight: normal;" id="label_job" for="job2"><?php echo @$get['work']; ?></label>
            </div>
          <?php endif; ?>

            <div class="searchfilterrow link_job" style=" display: flex; align-items: center;font-size: 12px;">
              <i class="far fa-plus-square" style="color: #999;"></i> &nbsp;
              <a onclick="$('.searchbox_job').show();$('.link_job').hide();$('.searchbox_job .autocomplete').focus();" >Choose a Company...</a>
            </div>
            <div class="searchfilterrow searchbox_job" style="display: none;">
              <input type="text" name="location" class="filterinput autocomplete" id="location" autocomplete="off" data-uri="places/2/" data-template="work" />
            </div>
          </div><!-- end Tagged Location -->
<?php endif; ?>


<?php if($searchtype=="all" || $searchtype =="" || $searchtype == "posts" || $searchtype=='photos'): ?>
          <div class="searchfilter-section">
            <?php
            if(@$get['date']!=""):
              $ar = explode('-',@$get['date']);
              $month = (@$ar[1]!='')?@$ar[1]:date('m');
              $year = @$ar[0];
            else:
              $month = date('m');
              $year = date('Y');
            endif;
            ?>
            <h5>Date Posted</h5>
            <div class="searchfilterrow">
              <input <?php echo (@$get['date'] == "")?"checked":""; ?> type="radio" name="postdate" id="postdateany" value="" onclick="$('#date').val('');searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="postdateany">Any Date</label>
            </div>

            <div class="searchfilterrow">
              <input <?php echo (@$get['date'] == date('Y') )?"checked":""; ?> type="radio" name="postdate" id="postdate<?php echo date('Y'); ?>" value="<?php echo date('Y'); ?>" onclick="$('#date').val('<?php echo date('Y'); ?>');searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="postdate<?php echo date('Y'); ?>"><?php echo date('Y'); ?></label>
            </div>

            <div class="searchfilterrow">
              <input <?php echo (@$get['date']== date('Y', strtotime('-1 year', time())) )?"checked":""; ?> type="radio" name="postdate" id="postdate<?php echo date('Y', strtotime('-1 year', time())); ?>" value="<?php echo date('Y', strtotime('-1 year', time())); ?>" onclick="$('#date').val('<?php echo date('Y', strtotime('-1 year', time())); ?>');searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="postdate<?php echo date('Y', strtotime('-1 year', time())); ?>"><?php echo date('Y', strtotime('-1 year', time())); ?></label>
            </div>

            <div class="searchfilterrow">
              <input <?php echo (@$get['date']== date('Y', strtotime('-2 year', time())) )?"checked":""; ?> type="radio" name="postdate" id="postdate<?php echo date('Y', strtotime('-2 year', time())); ?>" value="<?php echo date('Y', strtotime('-2 year', time())); ?>" onclick="$('#date').val('<?php echo date('Y', strtotime('-2 year', time())); ?>');searchinfo();"> 
              <label style="font-size: 12px; font-weight: normal;" for="postdate<?php echo date('Y', strtotime('-2 year', time())); ?>"><?php echo date('Y', strtotime('-2 year', time())); ?></label>
            </div>
            <?php if((@$ar[1]>0)): ?>
              <div class="searchfilterrow">
                <input <?php echo (@$ar[1]>0)?"checked":""; ?> type="radio" name="postdate" id="postdateany" value="" onclick="$('#date').val('<?php echo $year.'-'.$month; ?>');searchinfo();">
                <label style="font-size: 12px; font-weight: normal;" for="postdateany"><?php echo date("M", mktime(0, 0, 0, $month, 10)); ?> <?php echo $year; ?></label>
              </div>
            <?php endif; ?>

            <div class="searchfilterrow date_link" style=" display: flex; align-items: center;font-size: 12px;"><i class="far fa-plus-square" style="color: #999;"></i> &nbsp;<a onclick="$('.date_selector').show();$('.date_link').hide();" >Choose a Date...</a></div>

            <div class="searchfilterrow date_selector" style=" display: flex; align-items: center;font-size: 12px; display: none;">
            <select class="search-form-field" id="month" onchange="changedate();">
              <?php for($m=1; $m<=12; $m++): ?>
                <option value="<?php echo $m; ?>" <?php if($m==$month)echo 'selected'; ?> ><?php echo date("F", mktime(0, 0, 0, $m, 10)); ?></option>
              <?php endfor; ?>
            </select>
            <select class="search-form-field" id="year" onchange="changedate();">
              <?php for($y=date('Y'); $y>=(date('Y')-20); $y--): ?>
                <option value="<?php echo $y; ?>" <?php if($y==$year)echo 'selected'; ?>><?php echo $y; ?></option>
              <?php endfor; ?>
            </select>
            </div>

          </div><!-- end Date Posted -->
<?php endif; ?>


        </div>
        <div class="col-md-6">
 
 <?php //include(APPPATH . "views/feed/editor.php"); ?>
 <?php //include(APPPATH . "views/feed/story.php"); ?>


<div id="search_posts" style="padding-top: 10px; font-family: Arial; z-index: 0;">

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

        <div class="page-block half-separator">
         <div class="page-block-title"><?php echo lang("ctn_527") ?></div>
         <?php foreach($users->result() as $r) : ?>
          <div class="page-block-page clearfix">
            <div class="pull-left" style="margin-right: 15px;">
              <a href="<?php echo site_url("profile/" . $r->username) ?>">
                <img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative; ?>/<?php echo $r->avatar ?>" width="40">
              </a>
            </div>
            <div class="pull-left">
              <a href="<?php echo site_url("profile/" . $r->username) ?>"><?php echo $r->first_name ?> <?php echo $r->last_name ?></a>
              <p class="small-text faded-icon">@<?php echo $r->username ?></p>
            </div>

            <?php
              $friend_flag = 0;
              $request_flag = 0;
              $friend = $this->user_model->get_user_friend($this->user->info->ID, $r->ID);
              if($friend->num_rows() > 0) {
                // Friends
                $friend_flag = 1;
              } else {
                // Check for a request
                $request = $this->user_model->check_friend_request($this->user->info->ID, $r->ID);
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
<input type="hidden" id="from" value="<?php echo @$get['from']; ?>" />
<input type="hidden" id="fromtype" value="<?php echo @$get['fromtype']; ?>" />
<input type="hidden" id="type" value="<?php echo @$get['type']; ?>" />
<input type="hidden" id="group" value="<?php echo @$get['group']; ?>" />
<input type="hidden" id="city" value="<?php echo @$get['city']; ?>" />
<input type="hidden" id="date" value="<?php echo @$get['date']; ?>" />
<input type="hidden" id="fof" value="<?php echo @$get['fof']; ?>">
<input type="hidden" id="edu" value="<?php echo @$get['edu']; ?>">
<input type="hidden" id="work" value="<?php echo @$get['work']; ?>">
<input type="hidden" id="vtype" value="<?php echo @$get['vtype']; ?>">
<input type="hidden" id="vdate" value="<?php echo @$get['vdate']; ?>">
<input type="hidden" id="pcat" value="<?php echo @$get['pcat']; ?>">
<?php
$get[$this->security->get_csrf_token_name()] = $this->security->get_csrf_hash();
if(isset($_GET['q']) && @$_GET['q']!="")
{
  $get['q'] = addslashes($_GET['q']);
}
?>
<script type="text/javascript">
  function searchinfo()
  {
    var searchtype = $('.searchtype').val();
    var q = $('.searchTerm').val();
    if(searchtype == '<?php echo $searchtype; ?>')
    {
      var from = $('#from').val();
      var fromtype = $('#fromtype').val();
      var type = $('#type').val();
      var group = $('#group').val();
      var city = $('#city').val();
      var date = $('#date').val();
      var edu = $('#edu').val();
      var work = $('#work').val();
      var vtype = $('#vtype').val();
      var vdate = $('#vdate').val();
      var pcat = $('#pcat').val();
      var fof = $('#fof').val();
    }
    else
    {
      var from = '';
      var fromtype = '';
      var type = '';
      var group = '';
      var city = '';
      var date = '';
      var edu = '';
      var work = '';
      var vtype = '';
      var vdate = '';
      var pcat = '';
      var fof = '';
    }
    
    
    var obj = { "q":q, "searchtype":searchtype,"from":from,"fromtype":fromtype,"type":type,"group":group,"city":city,"date":date, "fof":fof,edu:edu,work:work,vtype:vtype,vdate:vdate,pcat:pcat};
    //console.log(obj);
    var str = jQuery.param(obj);
    var uri = encodeURIComponent(str);
    var url = '<?php echo site_url('search/index/'); ?>' + uri;
    //return false;
    window.location = url;
    // alert(searchtype);
  }
  
  function changedate()
  {
    var month = $('#month').val();
    var year = $('#year').val();
    var date = year+'-'+month;
    $('#date').val(date);
    searchinfo();
  }
</script>
<script type="text/javascript">
  $(document).ready(function() {
        /*$('#location.typeahead').typeahead(null,{
              name: 'locations',
              display: 'city',
              minLength: 1,
              highlight: true,

              source: function (query, result, cba) {
                var uri = '<?php echo site_url('search/locations/'); ?>';
                    $.ajax({
                        url: uri,
                        data: {'query': query,'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
                        dataType: "json",
                        type: "POST",
                        success: function (data) {
                            cba(data);
                        }
                    });
                },
                limit:10,
                templates: {
                    suggestion:Handlebars.compile($('.locationstemplate').html())
                  }
        });
        $('#location.typeahead').bind('typeahead:select', function(ev, suggestion) {
          //console.log('Selection: ' + suggestion.city);
          $('#postslocationcity').val(suggestion.city);
          $('.searchbox_locations').hide();
          $('.link_locations').show();
          $('.input_locations').show();
          $('#label_locations').html(suggestion.city+', '+suggestion.country);
          $('#postslocationcity').click();
          $('#city').val(suggestion.city);
          searchinfo();
        });*/




        /*$('.searchbox_sources .typeahead').typeahead(null,{
              name: 'sources',
              display: 'name',

              source: function (query, result, cba) {
                var uri = '<?php echo site_url('search/sources/'); ?>';
                    $.ajax({
                        url: uri,
                        data: {'query': query,'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
                        dataType: "json",
                        type: "POST",
                        success: function (data) {
                            cba(data);
                        }
                    });
                },
                limit:10,
                templates: {
                    suggestion:Handlebars.compile($('.sourcestemplate').html())
                  }
        });*/
        /*$('#source.typeahead').bind('typeahead:select', function(ev, suggestion) {
          console.log('Selection: ' + suggestion.city);
          // $('#postslocationcity').val(suggestion.city);
          // $('.searchbox_locations').hide();
          // $('.link_locations').show();
          // $('.input_locations').show();
          // $('#label_locations').html(suggestion.city+', '+suggestion.country);
          // $('#postslocationcity').click();
           $('#from').val(suggestion.ID);
           $('#fromtype').val(suggestion.type);
           searchinfo();
        });*/
  });
</script>


<script type="text/javascript">
  $(document).ready(function(){

    $('.searchform').submit(function(event) {
      /* Act on the event */
      event.preventDefault();
      searchinfo();
    });

  /*var locations = new Bloodhound({
   datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
   queryTokenizer: Bloodhound.tokenizers.whitespace,
   //prefetch:'<?php echo site_url('search/locations/'); ?>',
   remote:{
    url:'<?php echo site_url('search/locations/'); ?>%QUERY',
    wildcard:'%QUERY'
   }
  });
  

  $('.typeahead').typeahead(null, {
   name: 'locations',
   display: 'city',
   source:locations,
   limit:10,
   templates:{
    suggestion:Handlebars.compile($('.locationstemplate').html())
   }
  });
  $('.typeahead').bind('typeahead:open', function(ev, suggestion) {
    //console.log('Selection: ' + suggestion);
    //alert(JSON.stringify(suggestion));
    //alert(suggestion.image);
    //$('.std_name').html(suggestion.city);
    //$('.std_image').html('<img src="'+suggestion.city+'" />');
  });*/

});
function get_search_posts()
{
  //debugger;
  $.ajax({
    url: '<?php echo site_url('search/result/?'.http_build_query(@$get)); ?>',
    type: 'GET',
    //dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
    //data: <?php //echo json_encode(@$get); ?>,
  })
  .done(function(data) {
    $('#search_posts').html(data);
    $('#search_posts').jscroll({
          nextSelector : '.load_next'
      });
    //console.log(data);
    //console.log("success");
  })
  .fail(function(data) {
    console.error("error");
  })
  .always(function() {
    //console.log("complete");
  });
  
}
get_search_posts();
</script>
<div class="locationstemplate" style="display: none;">
  
  <div class="row" style="margin: 0;">
    <div class="col-md-12" style="padding:3px; font-weight: bold;">{{city}}, {{state}}, {{country}}</div>
  </div>

</div>

<!-- <div class="sourcestemplate" style="display: none;">
  
  <div class="row" style="margin: 0;">
    <div class=" clearfix col-md-12" style="padding-left: 0;">
            <div class="pull-left" style="margin-right: 15px;">
              <img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative; ?>/{{avatar}}" style="border-radius: 50%; width: 45px; height: 45px;">
            </div>
            <div class="pull-left">
              <b>{{name}}</b>
              <div class="smtext">{{detail}}</div>
            </div>
    </div>
  </div>

</div> -->

<style type="text/css">
.smtext
{
  color: #999;
  font-size: 12px;
}
.sidebar-block
{
  top: inherit;
  bottom: 0;
  overflow-y: inherit;
  overflow: inherit;
}
.sidebar-block .filterinput, .search-form-field
{
  border:1px solid #ddd;
  outline: none !important;
}
.tt-menu {
  font-family: Arial;
  min-width: 300px;
  max-width: 400px;
  margin: 0;
  padding: 0;
  background: #fff;
  border: 1px solid #000;
  border: 1px solid rgba(0, 0, 0, 0.2);
  -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
     -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
          box-shadow: 0 5px 10px rgba(0,0,0,.2);
  z-index: 99999999999999 !important;
}
  .tt-suggestion {
  padding: 3px;
  font-size: 12px;
  line-height: 24px;
}

.tt-suggestion:hover, .tt-suggestion:hover .smtext {
  cursor: pointer;
  color: #fff !important;
}

.tt-suggestion.tt-cursor, .tt-suggestion.tt-cursor .smtext {
  color: #fff !important;

}
</style>