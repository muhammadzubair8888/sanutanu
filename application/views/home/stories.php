<div class="row" style="display: flex;">
  <div class="col-md-3 stories-sidebar" style="overflow-y: auto; flex: all;">  
    <h4 style="font-weight: bold;">Your Story</h4>
    <table style="width: 100%;">
    <?php 
      $mystories = $this->feed_model->get_user_stories($this->user->info->ID)->num_rows();
      if($mystories==0)
      {
        $addmyid = '';
        ?>
          <tr style="cursor: pointer; background: #FFF;" class="list-group-item" onclick="loadeditor();">
            <td class="imagecol">
              <img src="<?php echo base_url(); ?>/images/plus.png" alt="Scott Stevens" class="img-responsive img-circle" style="border: none;" />
            </td>
            <td style="text-align: left;">
              <span class="name">Add to Your Story</span><br/>
              <span class="c-info">Share a photo, video or write something</span>
            </td>
          </tr>
        <?php
      }
      else
      {
        $addmyid = $this->user->info->ID.',';
        $myfirststoryid = $this->feed_model->get_user_stories($this->user->info->ID)->row()->ID;
        $mytimestamp = $this->feed_model->get_user_last_story_timestamp($this->user->info->ID)->row()->timestamp;
        $myimage = base_url() ."/". $this->settings->info->upload_path_relative ."/".$this->user->info->avatar;
        ?>
        <tr class="list-group-item suser_<?php echo $this->user->info->ID; ?>" 
          >
          <td class="imagecol" onclick="loadstory(<?php echo $myfirststoryid; ?>,<?php echo $this->user->info->ID; ?>);">
            <img src="<?php echo $myimage; ?>" alt="Scott Stevens" class="img-responsive img-circle watched" />
          </td>
          <td style="text-align: left;" onclick="loadstory(<?php echo $myfirststoryid; ?>,<?php echo $this->user->info->ID; ?>);">
            <span class="name"><?php echo $this->user->info->first_name.' '.$this->user->info->last_name; ?></span><br/>
            <span class="c-info"><?php echo $this->common->get_time_string_simple($this->common->convert_simple_time($mytimestamp)); ?></span>
            <input type="hidden" id="firsr_story<?php echo $this->user->info->ID; ?>" value="<?php echo $myfirststoryid; ?>">
          </td>
          <td class="imagecol" style="width: 50px !important;">
              <img src="<?php echo base_url(); ?>/images/plus.png" alt="Scott Stevens" class="img-responsive img-circle addstorybtn" style="border: none;" onclick="loadeditor();" />
          </td>
        </tr>
        <?php
      }
     ?>

      
    </table>
    <h4 style="font-weight: bold;">All Stories</h4>                       
    <table style="width: 100%;">
      <?php
      $u=0;
      $story_users = '';
      foreach($userswithstories->result() as $row ): ?>
        <?php  
        $u++;
          $user = $this->user_model->get_user_by_id($row->userid)->row();
          $userimage = base_url() ."/". $this->settings->info->upload_path_relative ."/".$user->avatar;
          if($this->feed_model->get_user_last_story_timestamp($user->ID)->num_rows()>0)
          {
            $timestamp = $this->feed_model->get_user_last_story_timestamp($user->ID)->row()->timestamp;
          }
          else
          {
            $timestamp = '';
          }
          if($u==1)
          {
            $story_id = $this->feed_model->get_user_stories($user->ID)->row()->ID;
            $current_user = $user->ID;
          }

            $user_first_story_id = $this->feed_model->get_user_stories($user->ID)->row()->ID;

          if($u==1)
          {
            $story_users .= $user->ID;
          }
          else
          {
            $story_users .= ','.$user->ID;
          }

          
          //print_r($lastpost);
        ?>
      <tr class="list-group-item suser_<?php echo $user->ID; ?> <?php if($u==1) { echo "active"; } ?>" onclick="loadstory(<?php echo $user_first_story_id; ?>,<?php echo $user->ID; ?>);">
        <td class="imagecol">
          <img src="<?php echo $userimage; ?>" alt="Scott Stevens" class="img-responsive img-circle img-<?php echo $user->ID; ?> watched" />
        </td>
        <td style="text-align: left;">
          <span class="name"><?php echo $user->first_name.' '.$user->last_name; ?></span><br/>
          <span class="c-info"><?php echo $this->common->get_time_string_simple($this->common->convert_simple_time($timestamp)); ?></span>
          <input type="hidden" id="firsr_story<?php echo $user->ID; ?>" value="<?php echo $user_first_story_id; ?>">
        </td>
      </tr>
    <?php 
    
    endforeach; ?>
      
    </table>
    <input type="hidden" id="story_users" value="<?php echo $addmyid.$story_users; ?>" />
    <input type="hidden" id="current_story_user" value="<?php echo $current_user; ?>" />
  </div>
  <div class="storyshow col-md-9" style="background: #333; overflow: hidden;">
      <!-- <div class="storycover" style="width: 450px; margin: auto; height: 100%; background: #000; position: relative;">
        <div style="position:absolute; top: 10px; padding: 0 10px; left: 0; display:flex; flex-direction:row; justify-content:space-between; width:100%; ">
          <div class="progress" style="">
            <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:100%;"></div>
          </div>
          <div class="progress" style="">
            <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:100%;"></div>
          </div>
          <div class="progress" style="">
            <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:100%;"></div>
          </div>
          <div class="progress" style="">
            <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:100%;"></div>
          </div>
        </div>
      
      <div class="storycontent" style="display:table-cell; vertical-align: middle;">
        <div class="storytray">
          <img src="http://127.0.0.1/sanutanu/uploads/d355fa6109df2c0f6abfac2d40bb2615.jpg" width="100%" style="width: 100%; height: auto;" />
        </div>
      </div>
        
        
      </div> -->
      <?php //echo base_url().'index.php/feed/load_single_story/53'; ?>
  </div>
  <a href="<?php echo base_url(); ?>" class="btn btn-xs btn-default" style="position: absolute; top: 10px; right: 10px; font-size: 20px; font-weight: bold; padding: 0; line-height: inherit; height: 30px; width: 30px;">x</a>
</div>
    
<!-- <div class="editormodal" style="position: fixed; top: 20%; left: 0; right: 0; z-index: 99999999; width: 500px; margin: auto; display: none;">
  <div style="position: relative;">
    
    <span style="position: absolute; top: 2px; right: 10px; z-index: 9999999999; font-size: 18px; cursor: pointer;" onclick="$('.editormodal').fadeOut();$('#status-overlay').click();">x</span>
  </div>
</div> -->
<style>
#main-content{ padding-bottom: 0 !important; padding: 0; min-height: inherit !important; }
.stories-sidebar { height: calc(100vh - 52px); }
.storyprogressbars .progress { border-radius: 5px; margin-bottom: 0; height: 5px; background: rgba(255, 255, 255, 0.4); }
.list-group-item { display: table-row; }
.list-group-item td{ padding: 5px; }

.c-list {
    padding: 0px;
    min-height: 44px;
}
.title {
    display: inline-block;
    font-size: .8125rem;
    font-weight: bold;
    padding: 5px 15px;
}
ul.c-controls {
    list-style: none;
    margin: 0px;
    min-height: 44px;
}

ul.c-controls li {
    margin-top: 8px;
    float: left;
}

ul.c-controls li a {
    font-size: 1.7em;
    padding: 11px 10px 6px;   
}
ul.c-controls li a i {
    min-width: 24px;
    text-align: center;
}

ul.c-controls li a:hover {
    background-color: rgba(51, 51, 51, 0.2);
}

.c-toggle {
    font-size: 1.7em;
}

.name {
    font-size: 1.7rem;
    font-weight: 700;
}

.c-info, .fa {
    padding: 5px 0px;
    font-size: 1.25rem !important;
}
.list-group-item{
  border: none;
}
.list-group-item:hover
{
  background: #f2f2f2;
  cursor: pointer;
}
.list-group-item.active
{
  background: #f2f2f2 !important;
  color: #000;
  text-shadow: none;
  cursor: pointer;
}
.list-group-item.active:hover
{
  background: #f2f2f2 !important;
  color: #000;
  text-shadow: none;
  cursor: pointer;
}
.storytray{ background: #000; color: #FFF; }
.feed-poll { background: #FFF; color: #000; }
.list-group{ box-shadow: none; }
.imagecol{ width: 70px; }
.imagecol img{ width: 50px; border: 3px solid #0066cc; }
img.watched{ width: 50px; border: 3px solid #DDD; }
.addstorybtn:hover{ background: #FFF !important; }
.feed-content-text { text-align: center; font-size: 2vh; max-height: 80vh; text-align: center; color: #FFF; font-weight: bold; font-family: serif; }
</style>
<script type="text/javascript">
  (function(){var e=jQuery,f="jQuery.pause",d=1,b=e.fn.animate,a={};function c(){return new Date().getTime()}e.fn.animate=function(k,h,j,i){var g=e.speed(h,j,i);g.complete=g.old;return this.each(function(){if(!this[f]){this[f]=d++}var l=e.extend({},g);b.apply(e(this),[k,e.extend({},l)]);a[this[f]]={run:true,prop:k,opt:l,start:c(),done:0}})};e.fn.pause=function(){return this.each(function(){if(!this[f]){this[f]=d++}var g=a[this[f]];if(g&&g.run){g.done+=c()-g.start;if(g.done>g.opt.duration){delete a[this[f]]}else{e(this).stop();g.run=false}}})};e.fn.resume=function(){return this.each(function(){if(!this[f]){this[f]=d++}var g=a[this[f]];if(g&&!g.run){g.opt.duration-=g.done;g.done=0;g.run=true;g.start=c();b.apply(e(this),[g.prop,e.extend({},g.opt)])}})}})();
</script>
<script>
  function setsize()
  {
    $('.storycontent').hide();
    var height = $('.storycover').height();
    var width = $('.storycover').width();
    $('.storycontent').css('height',height + "px");
    $('.storycontent').css('width',width + "px");
    $('.storycontent').show();
  }
  setsize();
  $(window).resize(function() {
    setsize();
  });
  var intervalTimer;
  function loadstory(id, userid)
  {
    var current_id = $('#current_id').val();
    $('.bar-'+current_id).stop(true, false);
    //clearTimeout(animate());
    userid = typeof userid !== 'undefined' ? userid : '';
    if(userid!="")
    {
      //clearInterval(intervalTimer);
      $('.list-group-item').removeClass('active');
      $('.suser_'+userid).addClass('active');
      $('#current_story_user').val(userid);
    }
    //var id = 47;
    $.ajax({
      url: '<?php echo base_url().'index.php/feed/load_single_story/'; ?>'+id,
      type: 'GET',
      //data: {param1: 'value1'},
    })
    .done(function(data) {
      //console.log("success");
      $('.storyshow').html(data);
      setsize();
      $('.bar-'+id).animate({width: '100%'},{ duration: <?php echo $this->feed_model->story_duration(); ?>, queue: false, complete: function(){  return nextstory(); }} );
    })
    .fail(function() {
      //console.log("error");
    })
    .always(function() {
      //console.log("complete");
    });
  }

  function pausestory()
  {
    var id = $('#current_id').val();
    $('.bar-'+id).pause();
    $('.btn-play').show();
    $('.btn-pause').hide();
  }

  function resumestory()
  {
    var id = $('#current_id').val();
    $('.bar-'+id).resume();
    $('.btn-play').hide();
    $('.btn-pause').show();
  }

  function nextstory()
  {
      if($('#current_id').length)
      {
        var id = $('#current_id').val();
        $('.bar-'+id).stop(true, false);
      }
      else
      {
        var id = 0;
      }

      if($('#stories_ids').val()!="" && $('#stories_ids').length )
      {
        var ids = $('#stories_ids').val().split(',');
      }
      else
      {
        var ids = new Array();
      }
      
      var index = ids.indexOf( id.toString(16) )+1;
      if(index < ids.length)
      {
        var nextid = ids[index];
        loadstory(nextid);
      }
      else
      {
        var current_story_user = $('#current_story_user').val();
        var story_users = $('#story_users').val().split(',');
        var users_index = story_users.indexOf( current_story_user.toString(16) )+1;
        if(users_index < story_users.length)
        {
          $('.img-'+current_story_user).addClass('watched');
          var nextuserid = story_users[users_index];
          var nextid = $('#firsr_story'+nextuserid).val();
          $('.suser_'+current_story_user).removeClass('active');
          $('#current_story_user').val(nextuserid);
          $('.suser_'+nextuserid).addClass('active');
          loadstory(nextid);
        }
      }
  }


  function prevstory()
  {
      if($('#current_id').length)
      {
        var id = $('#current_id').val();
        $('.bar-'+id).stop(true, false);
      }
      else
      {
        var id = 0;
      }
      if($('#stories_ids').val()!="" && $('#stories_ids').length )
      {
        var ids = $('#stories_ids').val().split(',');
      }
      else
      {
        var ids = new Array();
      }
      
      var index = ids.indexOf( id.toString(16) )-1;
      if(index >= 0)
      {
        var nextid = ids[index];
        loadstory(nextid);
      }
      else
      {
        var current_story_user = $('#current_story_user').val();
        var story_users = $('#story_users').val().split(',');
        var users_index = story_users.indexOf( current_story_user.toString(16) )-1;
        if(users_index >= 0 && story_users.length > 0)
        {
          var nextuserid = story_users[users_index];
          var nextid = $('#firsr_story'+nextuserid).val();
          $('.suser_'+current_story_user).removeClass('active');
          $('#current_story_user').val(nextuserid);
          $('.suser_'+nextuserid).addClass('active');
          loadstory(nextid);
        }
      }
  }

  function loadeditor()
  {
    if($('#checkstory').val()==0)
    {
      checkuncheck(1);
    }

    if($('#checkfeed').val()==1)
    {
      checkuncheck(0);
    }
    highlightPostBox();
    $('.editorpopup').show();
    //editor_modal();
    
    
    //setTimeout(function() { $('#editor-textarea').focus(); }, 100);
  }

loadstory(<?php echo $story_id; ?>);
//loadeditor();
</script>

<script type="text/javascript">
  //jQuery('#editorpopup').modal('show');
</script>