<?php
$r->content = $this->common->convert_links($r->content);
$r->content = $this->common->replace_user_tags($r->content);
$r->content = $this->common->replace_hashtags($r->content);
$r->content = $this->common->convert_smiles($r->content);
$script = '';

if($r->post_as == "page") {
	$r->avatar = $r->page_avatar;
	$r->first_name = $r->page_name;
	$r->last_name = "";
	if(!empty($r->page_slug)) {
		$slug = $r->page_slug;
	} else {
		$slug = $r->pageid;
	}
	$url = site_url("pages/view/" . $slug);
} else {
	$url = site_url("profile/" . $r->username);
}
if(isset($r->p_username)) {
	$r->avatar = $r->p_avatar;
}
?>
<div class="feed-wrapper" id="feed-post-<?php echo $r->ID ?>">
<div class="feed-header clearfix">
<div class="feed-header-user">
<img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->avatar ?>" class="user-icon-big">
</div>
<div class="feed-header-info">
<?php if(isset($r->p_username)) : ?> 
<?php // Posting to someone's profile ?>
<p><a href="<?php echo site_url("profile/" . $r->p_username) ?>"><?php echo $r->p_first_name ?><?php echo $r->p_last_name ?></a> <?php if($r->p_verified) : ?><img src="<?php echo base_url() ?>images/verified_badge.png" class="verified-badge" width="14" data-placement="top" data-toggle="tooltip" title="<?php echo lang("ctn_720") ?>"><?php endif; ?> <span class="glyphicon glyphicon-circle-arrow-right"></span> <a href="<?php echo site_url("profile/" . $r->username) ?>"><?php echo $r->first_name ?> <?php echo $r->last_name ?></a> <?php if($r->verified) : ?><img src="<?php echo base_url() ?>images/verified_badge.png" width="14" data-placement="top" data-toggle="tooltip" class="verified-badge" title="<?php echo lang("ctn_720") ?>"><?php endif; ?></p>

<div class="feed-timestamp"><?php echo $this->common->get_time_string_simple($this->common->convert_simple_time($r->timestamp)) ?> <?php if($r->location) : ?>- <?php echo lang("ctn_516") ?> <a href="https://www.google.com/maps/place/<?php echo urlencode($r->location) ?>"><span class="glyphicon glyphicon-map-marker"></span> <?php echo $r->location ?></a><?php endif; ?> 

	<?php if($r->user_flag) : ?> - <?php echo lang("ctn_517") ?> 
<?php $users = $this->feed_model->get_feed_users($r->ID); ?>
<?php $c = $users->num_rows(); $v=0; ?>

<?php foreach($users->result() as $user) : ?>
	<?php $v++; ?>
<a href="<?php echo site_url("profile/" . $user->username) ?>"><?php echo $user->first_name ?> <?php echo $user->last_name ?></a><?php if($v == ($c-1) && $c > 0) : ?> <?php echo lang("ctn_302") ?><?php elseif($c == $v) : ?><?php else : ?>, <?php endif; ?>
<?php endforeach; ?>

<?php endif; ?>

<?php if($r->pageid==0) : ?>
				<span class="dropdown" style="display: inline-block; padding-left: 10px;">
				    <a class="faded-icon dropdown-toggle click privacybtn<?php echo $r->ID; ?>" style="background: none !important; box-shadow: none !important;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    	<?php if($r->postfor==1): ?>
							<span class="fa fa-globe-asia" style="font-size: 13px;"></span>
						<?php elseif ($r->postfor==2): ?>
							<span class="fa fa-user-friends" style="font-size: 13px;"></span>
						<?php elseif ($r->postfor==3): ?>
							<span class="fa fa-lock" style="font-size: 13px;"></span>
						<?php endif; ?>
					</a>
				<?php if($r->userid==$this->user->info->ID): ?>
			  		<ul class="dropdown-menu">
					  	<li data-privacy<?php echo $r->ID ?>="1" <?php if($r->postfor==1)echo 'class="active"'; ?> ><a href="javascript:void(0)" onclick="change_privacy(1,<?php echo $r->ID ?>)"><span class="fa fa-globe-asia" style="font-size: 16px;"  ></span> <?php echo lang("ctn_976") ?></a></li>
					  	<li data-privacy<?php echo $r->ID ?>="2" <?php if($r->postfor==2)echo 'class="active"'; ?> ><a href="javascript:void(0)" onclick="change_privacy(2,<?php echo $r->ID ?>)"><span class="fa fa-user-friends" style="font-size: 16px;"  ></span> <?php echo lang("ctn_977") ?></a></li>
					  	<li data-privacy<?php echo $r->ID ?>="3" <?php if($r->postfor==3)echo 'class="active"'; ?> ><a href="javascript:void(0)" onclick="change_privacy(3,<?php echo $r->ID ?>)"><span class="fa fa-lock" style="font-size: 16px;"  ></span> <?php echo lang("ctn_978") ?></a></li>
					</ul>
				<?php endif; ?>
				</span>
			<?php endif; ?>

</div>

<?php else : ?>
	<?php // User is posting on a page ?>
	<?php if(isset($r->page_name) && $r->post_as != "page") : ?>
		<p><a href="<?php echo $url ?>"><?php echo $r->first_name ?> <?php echo $r->last_name ?></a> <?php if($r->verified) : ?><img src="<?php echo base_url() ?>images/verified_badge.png" class="verified-badge" width="14" data-placement="top" data-toggle="tooltip" title="<?php echo lang("ctn_720") ?>"><?php endif; ?> <span class="glyphicon glyphicon-circle-arrow-right"></span> <a href="<?php echo site_url("pages/view/" . $r->pageid) ?>"><?php echo $r->page_name ?></a></p>

		<div class="feed-timestamp"><?php echo $this->common->get_time_string_simple($this->common->convert_simple_time($r->timestamp)) ?>
			<?php if($r->location) : ?>- <?php echo lang("ctn_516") ?> <a href="https://www.google.com/maps/place/<?php echo urlencode($r->location) ?>"><span class="glyphicon glyphicon-map-marker"></span> <?php echo $r->location ?></a><?php endif; ?> 
			<?php if($r->user_flag) : ?> <?php echo lang("ctn_517") ?> 
			<?php $users = $this->feed_model->get_feed_users($r->ID); ?>
			<?php $c = $users->num_rows(); $v=0; ?>
			<?php foreach($users->result() as $user) : ?>
				<?php $v++; ?>
			<a href="<?php echo site_url("profile/" . $user->username) ?>"><?php echo $user->first_name ?> <?php echo $user->last_name ?></a><?php if($v == ($c-1) && $c > 0) : ?> <?php echo lang("ctn_302") ?><?php elseif($c == $v) : ?><?php else : ?>, <?php endif; ?>
			<?php endforeach; ?>
			<?php endif; ?>

			<?php if($r->pageid==0) : ?>
				<span class="dropdown" style="display: inline-block; padding-left: 10px;">
				    <a class="faded-icon dropdown-toggle click privacybtn<?php echo $r->ID; ?>" style="background: none !important; box-shadow: none !important;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    	<?php if($r->postfor==1): ?>
							<span class="fa fa-globe-asia" style="font-size: 13px;"></span>
						<?php elseif ($r->postfor==2): ?>
							<span class="fa fa-user-friends" style="font-size: 13px;"></span>
						<?php elseif ($r->postfor==3): ?>
							<span class="fa fa-lock" style="font-size: 13px;"></span>
						<?php endif; ?>
					</a>
				  <?php if($r->userid==$this->user->info->ID): ?>
			  		<ul class="dropdown-menu">
					  	<li data-privacy<?php echo $r->ID ?>="1" <?php if($r->postfor==1)echo 'class="active"'; ?> ><a href="javascript:void(0)" onclick="change_privacy(1,<?php echo $r->ID ?>)"><span class="fa fa-globe-asia" style="font-size: 16px;"  ></span> <?php echo lang("ctn_976") ?></a></li>
					  	<li data-privacy<?php echo $r->ID ?>="2" <?php if($r->postfor==2)echo 'class="active"'; ?> ><a href="javascript:void(0)" onclick="change_privacy(2,<?php echo $r->ID ?>)"><span class="fa fa-user-friends" style="font-size: 16px;"  ></span> <?php echo lang("ctn_977") ?></a></li>
					  	<li data-privacy<?php echo $r->ID ?>="3" <?php if($r->postfor==3)echo 'class="active"'; ?> ><a href="javascript:void(0)" onclick="change_privacy(3,<?php echo $r->ID ?>)"><span class="fa fa-lock" style="font-size: 16px;"  ></span> <?php echo lang("ctn_978") ?></a></li>
					</ul>
				<?php endif; ?>
				</span>
			<?php endif; ?>

		    </div>
	<?php else : ?>
		<?php // group post ?>
		<a href="<?php echo $url ?>"><?php echo $r->first_name ?><?php echo $r->last_name ?></a><?php if($r->groupid>0)
		{ 
			echo '<span style="padding-left: 5px;padding-right: 5px;" class="glyphicon glyphicon-circle-arrow-right"></span><a href="'.site_url('groups/view/'.$r->groupid).'" >'.$this->group_model->get_user_group($r->groupid)->row()->name.'</a>'; 
		} ?> <?php if($r->verified) : ?><img src="<?php echo base_url() ?>images/verified_badge.png" class="verified-badge" width="14" data-placement="top" data-toggle="tooltip" title="<?php echo lang("ctn_720") ?>"><?php endif; ?>
		
			<?php if($r->share_postid > 0) : ?>
				<?php echo lang("ctn_791") ?>
			<?php endif; ?>
			<?php if($r->user_flag) : ?> <?php echo lang("ctn_517") ?> 
			<?php $users = $this->feed_model->get_feed_users($r->ID); ?>
			<?php $c = $users->num_rows(); $v=0; ?>
			<?php foreach($users->result() as $user) : ?>
				<?php $v++; ?>
			<a href="<?php echo site_url("profile/" . $user->username) ?>"><?php echo $user->first_name ?> <?php echo $user->last_name ?></a><?php if($v == ($c-1) && $c > 0) : ?> <?php echo lang("ctn_302") ?><?php elseif($c == $v) : ?><?php else : ?>, <?php endif; ?>
			<?php endforeach; ?>
			<?php endif; ?>
			<div class="feed-timestamp" style="display: flex;"><?php echo $this->common->get_time_string_simple($this->common->convert_simple_time($r->timestamp)) ?> <?php if($r->location) : ?>- <?php echo lang("ctn_516") ?> <a href="https://www.google.com/maps/place/<?php echo urlencode($r->location) ?>"><span class="glyphicon glyphicon-map-marker"></span> <?php echo $r->location ?></a><?php endif; ?> 

			<?php if($r->pageid==0) : ?>
				<span class="dropdown" style="display: inline-block; padding-left: 10px;">
				    <a class="faded-icon dropdown-toggle click privacybtn<?php echo $r->ID; ?>" style="background: none !important; box-shadow: none !important;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    	<?php if($r->postfor==1): ?>
							<span class="fa fa-globe-asia" style="font-size: 13px;"></span>
						<?php elseif ($r->postfor==2): ?>
							<span class="fa fa-user-friends" style="font-size: 13px;"></span>
						<?php elseif ($r->postfor==3): ?>
							<span class="fa fa-lock" style="font-size: 13px;"></span>
						<?php endif; ?>
					</a>
				  <?php if($r->userid==$this->user->info->ID): ?>
			  		<ul class="dropdown-menu">
					  	<li data-privacy<?php echo $r->ID ?>="1" <?php if($r->postfor==1)echo 'class="active"'; ?> ><a href="javascript:void(0)" onclick="change_privacy(1,<?php echo $r->ID ?>)"><span class="fa fa-globe-asia" style="font-size: 16px;"  ></span> <?php echo lang("ctn_976") ?></a></li>
					  	<li data-privacy<?php echo $r->ID ?>="2" <?php if($r->postfor==2)echo 'class="active"'; ?> ><a href="javascript:void(0)" onclick="change_privacy(2,<?php echo $r->ID ?>)"><span class="fa fa-user-friends" style="font-size: 16px;"  ></span> <?php echo lang("ctn_977") ?></a></li>
					  	<li data-privacy<?php echo $r->ID ?>="3" <?php if($r->postfor==3)echo 'class="active"'; ?> ><a href="javascript:void(0)" onclick="change_privacy(3,<?php echo $r->ID ?>)"><span class="fa fa-lock" style="font-size: 16px;"  ></span> <?php echo lang("ctn_978") ?></a></li>
					</ul>
				<?php endif; ?>
				</span>
			<?php endif; ?>

			</div>
	<?php endif; ?>


<?php endif; ?>
</div>


<div class="feed-header-dropdown">
	<?php if(isset($r->promoted_id)) : ?>
		<span class="post-promoted"><span class="glyphicon glyphicon-bullhorn"></span> <?php echo lang("ctn_721") ?></span>
	<?php endif; ?>
	<?php if($this->user->loggedin) : ?>
<div class="btn-group">
    <a class="faded-icon dropdown-toggle click" style="background: none !important; box-shadow: none !important;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<span class="fa fa-ellipsis-h" style="font-size: 18px;"  ></span>
	</a>
  <ul class="dropdown-menu">
  	<li><a href="javascript:void(0)" onclick="save_post(<?php echo $r->ID ?>)" id="save_post_<?php echo $r->ID ?>"><?php if(!isset($r->savepostid)) : ?><?php echo lang("ctn_518") ?></a><?php else : ?><?php echo lang("ctn_519") ?><?php endif; ?></li>
  	<li><a href="javascript:void(0)" onclick="subscribe_post(<?php echo $r->ID ?>)" id="subscribe_post_<?php echo $r->ID ?>"><?php if(!isset($r->subid)) : ?><?php echo lang("ctn_520") ?></a><?php else : ?><?php echo lang("ctn_521") ?></a><?php endif; ?></li>
  	<!-- <li><a href="javascript:void(0)" onclick="share_post(<?php //echo $r->ID ?>)" id="share_post_<?php //echo $r->ID ?>"><?php //echo lang("ctn_765") ?></a></li> -->
  	<?php if($r->userid == $this->user->info->ID || ($r->pageid > 0 && $r->post_as == "page" && isset($r->roleid) && $r->roleid == 1) || $this->common->has_permissions(array("admin", "post_admin"), $this->user)) : ?>
    <li><a href="javascript:void(0)" onclick="delete_post(<?php echo $r->ID ?>)"><?php echo lang("ctn_522") ?></a></li>
    <li><a href="javascript:void(0);" onclick="edit_post(<?php echo $r->ID ?>)"><?php echo lang("ctn_55") ?></a></li>

    <?php if($this->settings->info->enable_promote_post && $this->feed_model->is_business_or_celebrity($r->ID)==1) : ?>
    <li><a href="javascript:void(0);" onclick="promote_post(<?php echo $r->ID ?>)"><?php echo lang("ctn_722") ?></a></li>
    <?php endif; ?>
    
    <?php endif; ?>

    <?php if($r->userid != $this->user->info->ID): ?>
    	<li><a href="javascript:void(0);" onclick="report_abuse_modal(<?php echo $r->ID ?>)"><?php echo lang("ctn_958") ?></a></li>
	<?php endif; ?>
  </ul>
</div>
<?php endif; ?>
</div>


</div>
<div class="feed-content">
<?php if($r->content!=""): ?>
<div class="feed-content-text"><?php echo nl2br($r->content) ?></div>
<?php endif; ?>
<?php if($r->site_flag) : ?>
	<?php $sites = $this->feed_model->get_feed_urls($r->ID); ?>
	<?php foreach($sites->result() as $site) : ?>
		<div class="link-post-data" style="text-decoration: none; margin: 0; overflow: hidden;" >
			<a href="<?php echo $site->url; ?>" target="_blank" style="text-decoration: none; color: #000;">
				<?php
			if(!empty($site->title))
			   {
			   	   if($this->feed_model->isRtl($site->title))
				   {
				   	$dir = 'rtl';
				   }
				   else
				   {
				   	$dir = 'ltr';
				   }
				   ?>
				   	<div class="link-post-title" dir="<?php echo $dir; ?>" ><?php echo $site->title; ?></div>
			   	 <?php
			   }
			   if(!empty($site->description))
			   {
			   	if($this->feed_model->isRtl($site->description))
				   {
				   	$dir = 'rtl';
				   }
				   else
				   {
				   	$dir = 'ltr';
				   }
			   ?>
			       <div class="link-post-desc" dir="<?php echo $dir; ?>" style=""><?php echo $site->description; ?></div>
			    <?php
				}
		   	?>
			   
			   <?php
			      if(!empty($site->image)) {
			      	?>
			      	 <div class="link-post-image" style="position: relative;"><img  style="max-height:100%; max-width:100%; width: 100%;" src="<?php echo $site->image; ?>" /></div>
			         <?php
			   }
			?>
			</a>
		</div>
		<!-- <div class="feed-url-spot clearfix">
		<div class="pull-left feed-url-spot-image">
			<?php //if($site->image) : ?>
			<img src="<?php //echo $site->image ?>" width="100%">
			<?php //endif; ?>
		</div>
		<p><a href="<?php //echo $site->url ?>"><?php //echo $site->title ?></a></p>
		<p><?php //echo $site->description ?></p>
			</div> -->
	<?php endforeach; ?>
<?php endif; ?>
<?php if($r->share_postid > 0) : ?>
 <?php // Get post and display it
 $shared_post = $this->feed_model->get_post($r->share_postid, $this->user->info->ID);
 $old_r = $r;
 foreach($shared_post->result() as $r) : ?>
 	<?php include("feed_single.php"); ?>
 <?php endforeach; ?>
  <?php $r = $old_r; ?>
<?php endif; ?>
<?php if($r->pollid > 0) : ?>
	<?php // Get answers
	if($this->user->loggedin) {
		$uid = $this->user->info->ID;
	} else {
		$uid = 0;
	}
	$answers = $this->feed_model->get_poll_answers($r->pollid, $uid);
	?>
<div class="feed-poll clearfix">
<span class="glyphicon glyphicon-stats" style="margin-right: 10px;"></span> <strong><?php echo $r->poll_question ?></strong>
<hr>
<?php 
$user_vote = 0;
foreach($answers->result() as $a) {
	if(isset($a->voteid)) {
		$user_vote = 1;
	}
}
?>
<?php foreach($answers->result() as $a) : ?>
	<?php if(!$user_vote) : ?>
<div class="feed-poll-answer" id="poll_answers_<?php echo $r->ID ?>">
	<div class="feed-poll-answer-text"><label for="<?php echo $a->ID ?>"><?php echo $a->answer ?></label></div>
	<?php if($r->poll_type == 0) : ?>
		<input type="radio" name="poll_answer_<?php echo $r->pollid ?>" id="<?php echo $a->ID ?>" value="<?php echo $a->ID ?>" class="pull-right">
	<?php else : ?>
		<input type="checkbox" name="poll_answer_<?php echo $r->ID ?>" id="<?php echo $a->ID ?>" value="<?php echo $a->ID ?>" class="pull-right">
	<?php endif; ?>
</div>
<?php else : ?>
	<?php
	if($a->votes > 0) {
		$vote_percent = intval(($a->votes/$r->poll_votes) * 100);
	} else {
		$vote_percent = 0;
	}
	?>
<div class="feed-poll-answer" id="poll_answers_<?php echo $r->ID ?>">
	<div>
	<div class="feed-poll-answer-text"><label for="<?php echo $a->ID ?>"><?php if(isset($a->voteid)) : ?><strong><?php endif; ?><?php echo $a->answer ?><?php if(isset($a->voteid)) : ?></strong><?php endif; ?></label></div>
	<div class="pull-right"><?php if(isset($a->voteid)) : ?><strong><?php endif; ?><?php echo $a->votes ?> Votes<?php if(isset($a->voteid)) : ?></strong><?php endif; ?></div>
	</div>
	<div class="progress">
	  <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $vote_percent ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $vote_percent ?>%;">
	    <?php if(isset($a->voteid)) : ?><strong><?php endif; ?><?php echo $vote_percent ?>%<?php if(isset($a->voteid)) : ?></strong><?php endif; ?>
	  </div>
	</div>
</div>
<?php endif; ?>
<?php endforeach; ?>
<?php if(!$user_vote) : ?>
<input type="button" class="btn btn-post btn-sm pull-right" value="<?php echo lang("ctn_723") ?>" onclick="vote_poll(<?php echo $r->ID ?>, <?php echo $r->poll_type ?>)">
<?php else : ?>
<div class="pull-right">
<?php echo lang("ctn_822") ?>: <?php echo number_format($r->poll_votes) ?>
</div>
<?php endif; ?>
</div>
<?php endif; ?>
<!-- end poll-->
<?php if($r->blog_postid > 0) : ?>
<?php if(isset($r->blog_post_image) && !empty($r->blog_post_image)) : ?>
<p class="align-center"><a href="<?php echo site_url("blog/view/" . $r->blog_postid) ?>"><img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->blog_post_image ?>"></a></p>
<?php endif; ?>
<p class="align-center"><a href="<?php echo site_url("blog/view/" . $r->blog_postid) ?>"><?php echo $r->blog_post_title ?></a></p>
<?php endif; ?>
<?php if($r->template == "album") : ?>
	<?php
	// Display all images in post
	$images = $this->feed_model->get_feed_images($r->ID);
	$script .= '$(".album-images-'.$r->ID.'").viewer();';
	?>
	<div>
  	<ul class="album-images album-images-<?php echo $r->ID ?>">
  	<?php foreach($images->result() as $rr) : ?>
  		<?php if(isset($rr->albumid)) : ?>
  			<?php $r->albumid = $rr->albumid; $r->album_name = $rr->album_name; ?>
  		<?php endif; ?>
	<li class="album-image">
	<?php if(isset($rr->file_name)) : ?>
	    <img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $rr->file_name ?>" width="140" alt="<?php echo $rr->name . "<br>" . $rr->description ?>">
	  <?php else : ?>
	    <img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/default_album.png" width="140" alt="<?php echo $rr->name . "<br>" . $rr->description ?>">
	  <?php endif; ?>
	  <p><?php echo $rr->name ?></p>
	</li>
	<?php endforeach; ?>
  </ul>
  <?php if(isset($r->albumid)) : ?>
  	<?php if($r->pageid > 0) {
  		$url = site_url("pages/view_album/" . $r->albumid); 
  	} else {
  		$url = site_url("profile/view_album/" . $r->albumid);
  	}
  	?>
			<!-- <p class="small-text"><i><?php echo lang("ctn_523") ?>: <a href="<?php echo $url ?>"><?php echo $r->album_name ?></a></i></p> -->
		<?php endif; ?>
	</div>
<?php elseif($r->template == "event") : ?>
	<div class="editor-event">
		<span class="glyphicon glyphicon-calendar big-event-icon"></span>
		<p><strong><a href="<?php echo site_url("pages/view_event/" . $r->eventid) ?>"><?php echo $r->event_title ?></a></strong></p>
		<p><?php echo $r->event_description ?></p>
		 <p><span class="glyphicon glyphicon-time"></span> <?php echo $r->event_start ?> ~ <?php echo $r->event_end ?> </p>
	</div>
<?php elseif($r->template == "event_go") : ?>
	<div class="editor-event">
		<p><?php echo lang("ctn_823") ?></p>
		<span class="glyphicon glyphicon-calendar big-event-icon"></span>
		<p><strong><a href="<?php echo site_url("pages/view_event/" . $r->eventid) ?>"><?php echo $r->event_title ?></a></strong></p>
		<p><?php echo $r->event_description ?></p>
		 <p><span class="glyphicon glyphicon-time"></span> <?php echo $r->event_start ?> ~ <?php echo $r->event_end ?> </p>
	</div>
<?php else : ?>
	<?php if(isset($r->imageid)) : ?>
		<?php if(!empty($r->image_file_name)) : ?>
		<a style="cursor: pointer;" onclick="post_modal(<?php echo $r->ID; ?>);"><img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->image_file_name ?>" width="100%"></a>
		<?php else : ?>
		<a style="cursor: pointer;" onclick="post_modal(<?php echo $r->ID; ?>);"><img src="<?php echo $r->image_file_url ?>" width="100%"></a>
		<?php endif; ?>
		<?php if(isset($r->albumid)) : ?>
			<?php if($r->pageid > 0) {
  		$url = site_url("pages/view_album/" . $r->albumid); 
  	} else {
  		$url = site_url("profile/view_album/" . $r->albumid);
  	}
  	?>
			<!-- <p class="small-text"><i><?php echo lang("ctn_523") ?>: <a href="<?php echo $url ?>"><?php echo $r->album_name ?></a></i></p> -->
		<?php endif; ?>
	<?php endif; ?>

	<?php if(isset($r->videoid)) : ?>
		<?php if(!empty($r->video_file_name)) : ?>
			 <video width="100%" controls>
			 	<?php if($r->video_extension == ".mp4") : ?>
				  <source src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->video_file_name ?>" type="video/mp4">
				<?php elseif($r->video_extension == ".ogg" || $r->video_extension == ".ogv") : ?>
			      <source src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->video_file_name ?>" type="video/ogg">
				<?php elseif($r->video_extension == ".webm") : ?>
			      <source src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->video_file_name ?>" type="video/webm">
				<?php endif; ?>
				<?php echo lang("ctn_501") ?>
			 </video> 
		<?php elseif(!empty($r->youtube_id)) : ?>
		<p><iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $r->youtube_id ?>" frameborder="0" allowfullscreen></iframe></p>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>
</div>
<div class="feed-content-stats">
<a href="#" onclick="get_post_likes(<?php echo $r->ID ?>)" class="feed-stat <?php if($r->likes <= 0) : ?>nodisplay<?php endif; ?> likes-click-<?php echo $r->ID ?>" id="likes-click-<?php echo $r->ID ?>"><span class="fa fa-thumbs-up"></span> <span id="feed-likes-<?php echo $r->ID ?>" class="feed-likes-<?php echo $r->ID ?>"> <?php echo $r->likes ?></span></a> 
<?php if($this->settings->info->enable_dislikes) : ?>
	<a href="#" onclick="get_post_likes(<?php echo $r->ID ?>)" class="feed-stat <?php if($r->dislikes <= 0) : ?>nodisplay<?php endif; ?> dislikes-click-<?php echo $r->ID ?>" id="dislikes-click-<?php echo $r->ID ?>"><span class="fa fa-thumbs-down"></span> <span id="feed-dislikes-<?php echo $r->ID ?>" class="feed-dislikes-<?php echo $r->ID ?>"> <?php echo $r->dislikes ?></span></a>
<?php endif; ?> 
<a href="javascript:void(0)" onclick="load_comments(<?php echo $r->ID ?>)" class="feed-stat <?php if($r->comments <= 0) : ?>nodisplay<?php endif; ?>"><span class="fa fa-comment-alt"></span> <span class="feed-comments-<?php echo $r->ID ?>" id="feed-comments-<?php echo $r->ID ?>"> <?php echo $r->comments ?></span></a>
</div>

<div style="padding: 5px;" class="feed-footer">
<a id="like-button-<?php echo $r->ID ?>" class="like-button-<?php echo $r->ID ?> editor-button faded-icon <?php if(isset($r->likeid) && $r->like_type == 0) : ?>active-like<?php endif; ?>" onclick="like_feed_post(<?php echo $r->ID ?>,0)"><span class="far fa-thumbs-up"></span> <span id="like-button-like-<?php echo $r->ID ?>" class="like-button-like-<?php echo $r->ID ?>" ><?php echo lang("ctn_337") ?></span></a> 
<?php if($this->settings->info->enable_dislikes) : ?>
	<a id="dislike-button-<?php echo $r->ID ?>" class="dislike-button-<?php echo $r->ID ?> editor-button faded-icon <?php if(isset($r->likeid) && $r->like_type == 1) : ?>active-like<?php endif; ?>" onclick="like_feed_post(<?php echo $r->ID ?>,1)"><span class="far fa-thumbs-down"></span> <span id="dislike-button-like-<?php echo $r->ID ?>" class="dislike-button-like-<?php echo $r->ID ?>">Dislike</span></a>
<?php endif; ?> 
<a class="editor-button faded-icon" onclick="load_comments(<?php echo $r->ID ?>)"><span class="far fa-comment-alt"></span> <?php echo lang("ctn_524") ?></a>
<a class="editor-button faded-icon dropdown-toggle" data-toggle="dropdown" ><span class="fa fa-share"></span> <?php echo lang("ctn_965") ?></a>
<ul class="dropdown-menu" style="right:0; left: auto;">
  <li class="dropdown-header">Who should see this?</li>
  <li data-editvalue="1">
    <a style="cursor: pointer;" onclick="share_post(<?php echo $r->ID ?>, 1);"><i class="fa fa-globe-asia" style="font-size: 15px;"></i> &nbsp; Public</a>
  </li>
  <li data-editvalue="2">
    <a style="cursor: pointer;" onclick="share_post(<?php echo $r->ID ?>, 2);"><i class="fa fa-user-friends" style="font-size: 15px;"></i> &nbsp; Friends</a>
  </li>
  <li data-editvalue="3">
    <a style="cursor: pointer;" onclick="share_post(<?php echo $r->ID ?>, 3);"><i class="fa fa-lock" style="font-size: 15px;"></i> &nbsp; Only Me</a>
  </li>
</ul>


<?php if($this->settings->info->enable_promote_post && $this->feed_model->is_business_or_celebrity($r->ID)==1) : ?>

<a style="color: white;" class="editor-button faded-icon btn btn-primary btn-xs" onclick="boostpost(<?php echo $r->ID ?>)">Boast Post</a>

<?php endif ?>

</div>
<div class="feed-comment-area feed-comment-<?php echo $r->ID ?>" id="feed-comment-<?php echo $r->ID ?>">

</div>
</div>
<?php if(!empty($script)) : ?>
<script type="text/javascript">
			$(document).ready(function() {
				<?php echo $script ?>
			});
</script>
<?php endif; ?>

<script type="text/javascript">
	function boostpost(id)
	{
	$.ajax({
		url: global_base_url + 'feed/boast_post/' + id,
		type: 'GET',
		data: {
		},
		success: function(msg) {
			$('#boastpost').html('<div><img style="height:100%;width:100%;" src="https://i.pinimg.com/originals/3b/4e/10/3b4e109d6b621ed5a9249769afbd4dfa.gif"></div>');
			$('#boastpostModal').modal('show');
			setTimeout(function(){ 
			$('#boastpostModal').modal('show');
			$('#boastpost').html(msg);
		}, 1000);

		}
	});
	}
</script>