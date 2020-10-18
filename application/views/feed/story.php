<?php
  $imgpath =  upload_path();//base_url() ."/". $this->settings->info->upload_path_relative ."/";
  //$friends = $this->user_model->get_user_friends_all($this->user->info->ID);
  //$total_friends = $friends->num_rows();
  //echo upload_path();
  $profilepic_postid = $this->user->info->profilepic_postid;
  if($this->feed_model->get_post($profilepic_postid, $this->user->info->ID)->num_rows()>0)
  {
    $profile_pic = $this->feed_model->get_post($profilepic_postid, $this->user->info->ID)->row()->image_file_name;
  }
  else
  {
    $profile_pic = '';
  }
  
  //print_r($this->feed_model->get_users_have_stories_home()->result());
  if($this->feed_model->get_users_have_stories_home()->num_rows()>0):
?>


  <div class="storybox">
    <div class="storybox-title">
      <a style="cursor: default;"><span class="stories-title-text">Stories</span></a>
      <div><a href="<?php echo base_url().'index.php/home/stories/' ?>" class="story-seeall">See All</a></div>
    </div>
    <div class="clearfix"></div>

  <div class="stories_tray" id="stories_tray">
    <div class="story_pics" id="story_pics">

<?php
$mystories = $this->feed_model->get_user_stories($this->user->info->ID)->num_rows();
if($mystories>0)
{
?>
      
      <div class="userstorybox" tabindex="0" style="width:140px; height: 200px;" onclick="window.location = '<?php echo base_url().'index.php/home/stories/' ?>';">
        <div class="storyImageContainer" style="width:140px;height:200px; background: #000; color: #FFF; vertical-align: middle; text-align: center; display: table-cell;">
          <img class="scaledImageFitHeight img" src="<?php echo $imgpath.$profile_pic; ?>" alt="" width="200" height="200">
          abc
        </div>
        <span class="storyprofilepicbox">
          <img src="<?php echo $imgpath.$this->user->info->avatar; ?>" width="40" height="40" />
        </span>
          <span class="storyusername">
            <div class="wrap ellipsis light verbose">
              <div dir="auto">
                <span class="_nbt"><div>Your Stories</div>
                </span>
              </div>
            </div>
          </span>
      </div>
<?php
}
else
{
  ?>
    <div class="userstorybox" tabindex="0" style="width:140px; height: 200px;" onclick="$('textarea').click();if($('#checkstory').val()==0){checkuncheck(1);}">
        <div class="storyImageContainer" style="width:140px;height:200px; background: #000; color: #FFF; vertical-align: middle; text-align: center; display: table-cell;">
          <img class="scaledImageFitHeight img" src="<?php echo $imgpath.$profile_pic; ?>" alt="" width="200" height="200">
          abc
        </div>
        <span class="storyprofilepicbox">
          <img src="<?php echo base_url() ?>/images/add.png" width="40" height="40" />
        </span>
          <span class="storyusername">
            <div class="wrap ellipsis light verbose">
              <div dir="auto">
                <span class="_nbt"><div>Add to Story</div>
                </span>
              </div>
            </div>
          </span>
      </div>
  <?php
}


foreach($this->feed_model->get_users_have_stories_home()->result() as $p)
{

  $user = $this->user_model->get_user_by_id($p->userid)->row();
  $s = $this->feed_model->get_user_last_story($user->ID)->row();
?>

      
      <div class="userstorybox" tabindex="0" style="width:140px; height: 201px;" onclick="window.location = '<?php echo base_url().'index.php/home/stories/' ?>';">
        <div class="storyImageContainer" style="width:140px;height:200px; background: #000; color: #FFF; vertical-align: middle; text-align: center; display: table-cell;">
          <img class="scaledImageFitHeight img" src="<?php echo $imgpath.$s->image_file_name; ?>" alt="" width="200" height="200">
          <?php echo nl2br($s->content); ?>
        </div>
        <span class="storyprofilepicbox">
          <img src="<?php echo $imgpath.$user->avatar; ?>" width="40" height="40" />
        </span>
          <span class="storyusername">
            <div class="wrap ellipsis light verbose">
              <div dir="auto">
                <span class="_nbt"><div><?php echo $user->first_name.' '.$user->last_name; ?></div>
                </span>
              </div>
            </div>
          </span>
      </div>
<?php
}
?>

      

<div class="clearfix"></div>



</div>
</div>




  </div>

<style>
  .storybox{ background: #FFF; border: 1px solid #CCC; border-radius: 4px; align-items: flex-start; display: flex; flex-direction: column; justify-content: flex-start; overflow: hidden; padding: 12px; position: relative; margin-top: 10px; }
  .storybox-title{ align-self: stretch; display: flex; height: 16px; justify-content: space-between; margin-bottom: 12px; }
  .stories-title-text{color:#65676b;font-size:13px;-webkit-font-smoothing:antialiased;font-weight:600;line-height:13px}._8q34{padding-left:14px}
  .story-seeall{align-items:center;display:flex;justify-content:flex-end;white-space:nowrap}
  .stories_tray{align-items:center;display:flex;flex-direction:column;justify-content:flex-start;width:100%}
  .story_pics{display:flex;flex-direction:row;justify-content:space-between;width:100%}
  .userstorybox{cursor:pointer; position: relative; overflow: hidden;}
  .userstorybox:hover{-webkit-filter:brightness(.9)}
  .userstorybox,.userstorybox:after{border-radius:10px}
  .userstorybox:hover .storyImageContainer{transform:scale(1.06)}
  .userstorybox:active{outline:none;transform:scale(.98)}
  .storyImageContainer{position:relative;overflow:hidden}
  .storyImageContainer img{height:100%;min-height:100%;position:relative}
  .storyImageContainer .scaledImageFitWidth{height:auto;min-height:initial;width:100%}
  .storyImageContainer .scaledImageFitHeight{height:100%;min-height:initial;width:100%; object-fit: cover;}
  .storyImageContainer .verticallyAligned{min-height:0;vertical-align:middle}
  .storyImageContainer{top:0}
  /* .storyImageContainer{transform:scale(1.02)} */
  .storyImageContainer::after{background:linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, .6));border-radius:12px;bottom:0;content:'';height:50%;left:0;position:absolute;width:100%}
  .storyImageContainer{transition:transform .15s linear, filter .15s linear}
  .userstorybox .storyprofilepicbox{left:8px;margin-left:0;margin-top:0;position:absolute;top:8px;transform-origin:top left;transition-duration:.3s;transition-property:transform}

  .storyprofilepicbox img
  {
    width:40px;
    height: 40px;
    border: 3px solid #FFF;
    border-radius: 50%;
  }
  .storyusername
  { 
    position: absolute;
    bottom: 10px;
    width: 120px;
    left: 10px;
    color: #FFF;
    font-weight: bold;
 }
</style>
<?php endif; ?>