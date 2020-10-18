<?php
$totposts = $this->feed_model->get_user_stories($r->userid)->num_rows();
$stories = $this->feed_model->get_user_stories($r->userid)->result();
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
<img style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; filter: blur(4.5rem);" src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->image_file_name ?>" width="100%" draggable="false">
<div class="storycover" style="width: 50vh; margin: auto; height: 98%; background: #000; position: relative; top: 10px; border-radius: 10px; padding-top: 15px;">
  <a class="btn btn-default" style="position: absolute; top: 50%; left: -50px;" onclick="return prevstory();"><span class="fa fa-chevron-left"></span></a>
  <a class="btn btn-default" style="position: absolute; top: 50%; right: -50px;" onclick="return nextstory();"><span class="fa fa-chevron-right"></span></a>
  <a class="btn-play" onclick="resumestory();" style="position: absolute; cursor: pointer; color: #FFF; font-size: 18px; top: 25px; right: 50px; display: none;"><span class="fa fa-play"></span></a>
  <a class="btn-pause" onclick="pausestory();" style="position: absolute; cursor: pointer; color: #FFF; font-size: 18px; top: 25px; right: 50px;"><span class="fa fa-pause"></span></a>
  <!-- <a class="btn-options" style="position: absolute; cursor: pointer; color: #FFF; font-size: 18px; top: 25px; right: 20px;"><span class="fa fa-ellipsis-h"></span></a> -->
  

        <div class="storyprogressbars" style="position:absolute; top: 10px; padding: 0 10px; left: 0; display:flex; flex-direction:row; justify-content:space-between; width:100%; ">
          <?php 
          $ids = '';//array();
          $k=0;
          foreach($stories as $p): ?>
          <div class="progress" style="width: calc(100% / <?php echo $totposts; ?> - 5px );">
            <div class="progress-ba bar-<?php echo $p->ID; ?>" style="width:0%; height: 5px; background: #FFF;"></div>
          </div>
        <?php   

        if($k==0)
        {
          $ids .= $p->ID;
        }
        else
        {
          $ids .= ','.$p->ID;
        }
        
        $k++;
      endforeach; ?>
      <input type="hidden" id="stories_ids" value="<?php echo $ids; ?>">
      <input type="hidden" id="current_id" value="<?php echo $r->ID; ?>">
        </div>

  <div class="storycontent" style="display:table-cell; vertical-align: middle;">
    <div class="storytray">
<!---------------------------------------------------------------------------------------->





<?php if($r->site_flag) : ?>
  <?php $sites = $this->feed_model->get_feed_urls($r->ID); ?>
  <?php foreach($sites->result() as $site) : ?>
    <div class="feed-url-spot clearfix">
    <div class="pull-left feed-url-spot-image">
      <?php if($site->image) : ?>
      <img src="<?php echo $site->image ?>" width="100%">
      <?php endif; ?>
    </div>
    <p><a href="<?php echo $site->url ?>"><?php echo $site->title ?></a></p>
    <p><?php echo $site->description ?></p>
  </div>
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
      <img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $rr->file_name ?>" width="140" alt="<?php echo $rr->name . "<br>" . $rr->description ?>" draggable="false">
    <?php else : ?>
      <img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/default_album.png" width="140" alt="<?php echo $rr->name . "<br>" . $rr->description ?>" draggable="false">
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
    <img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->image_file_name ?>" width="100%" draggable="false">
    <?php else : ?>
    <img src="<?php echo $r->image_file_url ?>" width="100%" draggable="false">
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
    <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?php echo $r->youtube_id ?>" frameborder="0" allowfullscreen></iframe>
    <?php endif; ?>
  <?php endif; ?>
<?php endif; ?>



<?php if($r->content!=""): ?>
<div class="feed-content-text" style="<?php if(isset($r->imageid) || isset($r->videoid) || $r->pollid > 0){ echo "text-align:left;"; } ?>"><?php echo nl2br($r->content) ?></div>
<?php endif; ?>

</div>



<!------------------------------------------------------------------------------------------->
    </div>
  </div>
</div>

<?php
if( $this->feed_model->check_story_viewer($r->ID, $this->user->info->ID) == 0 && $r->userid != $this->user->info->ID )
{
  $this->feed_model->add_story_viewer($r->ID, $this->user->info->ID);
}
$vrows = $this->feed_model->get_story_viewers($r->ID)->num_rows();

if($vrows>0  && $r->userid == $this->user->info->ID)
{
?>
<div style="background: rgba(255,255,255, 0.8); position: absolute; bottom: 0; right: 0; padding: 0px; width: 280px; border-radius: 5px 0 0 0; max-height: 80%; overflow-y: auto;">
  <div class="page-block "> 
    <div class="page-block-title"><?php echo $vrows; ?> Viewer<?php if($vrows>1){ echo 's'; } ?></div>
<?php
  foreach($this->feed_model->get_story_viewers($r->ID)->result() as $v)
  {
    $u = $this->user_model->get_user_by_id($v->userid)->row();
    ?>
    <div class="page-block-page clearfix">
      <div class="pull-left" style="margin-right: 15px;">
        <a><img src="<?php echo upload_path().$u->avatar; ?>" width="40"></a>
      </div>
      <div class="pull-left">
        <a><?php echo $u->first_name.' '.$u->last_name; ?></a>
        <p class="small-text faded-icon">@<?php echo $u->username; ?></p>
      </div>
    </div>
    <?php
  }
  ?>
</div>
</div>
  <?php
}
?>
