<?php

if(isset($postAs)) {
  $imgurl = base_url() ."/". $this->settings->info->upload_path_relative ."/". $postAsImg;
} else {
  $imgurl = base_url() ."/". $this->settings->info->upload_path_relative ."/".$this->user->info->avatar;
}

?>

	<?php echo form_open_multipart(site_url("feed/add_post"), array("id" => "social-form")) ?>
  <input type="hidden" name="targetid" value="<?php if(isset($targetid)) echo $targetid ?>">
  <input type="hidden" name="target_type" value="<?php if(isset($target_type)) echo $target_type ?>">
  <input type="hidden" name="groupid" value="<?php if(isset($groupid)) echo $groupid ?>">
<div class="editor-wrapper" onclick="checkeditor();">
  <div class="editor-header" style="">Create Post</div>
<div class="editor-content">
<div class="clearfix editor-textarea-wrapper">
<div class="editor-user-icon"><img src="<?php echo $imgurl ?>" class="user-icon-big" id="editor-poster-icon">
</div>

<div class="editor-textarea-part"><textarea onclick="highlightPostBox();" onkeyup="extracturl(this.value);" name="content" class="editor-textarea" id="editor-textarea" placeholder="<?php if(isset($editor_placeholder)) : ?><?php echo $editor_placeholder ?><?php else : ?><?php echo lang("ctn_495") ?><?php endif; ?>"></textarea>
  <?php if(isset($postAs)) : ?>
    <input type="hidden" name="post_as" value="<?php echo $postAsDefault ?>" id="post_as">
<div class="editor-user-option">
<div class="btn-group">
    <span class="glyphicon glyphicon-chevron-down faded-icon dropdown-toggle click" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
  <ul class="dropdown-menu">
    <li <?php if($postAsDefault == "page") echo "class='nodisplay postastoggle'" ?> id='page-postas'><a href="javascript:void(0)" onclick="set_post_as('page', '<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $postAsImg ?>')"><?php echo lang("ctn_505") ?> <?php echo $postAs ?></a></li>
    <li <?php if($postAsDefault == "user") echo "class='nodisplay postastoggle'" ?> id='user-postas'><a href="javascript:void(0)" onclick="set_post_as('user', '<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->user->info->avatar ?>')"><?php echo lang("ctn_505") ?> <?php echo $this->user->info->first_name ?></a></li>
  </ul>
</div>
</div>
<?php endif; ?>
</div>
</div>
<div class="editor-post-container"></div>
<div id="userTagBox" class="collapse">
  <div class="input-group tagbox">
      <span class="input-group-addon">With</span>
      <select class="js-example-basic-multiple form-control" style="width: 100%;" name="with_users[]" id="with_users" multiple="multiple"></select>
  </div>
</div>
  
</div>
<div class="editor-footer" style="background: #FFF;">
  <div class="dropdown">
    <button type="button" id="image-button" class="editor-button  mytooltip postboxbutton" title="<?php echo lang("ctn_499") ?>" data-toggle="modal" data-target="#imageModal"><span class="glyphicon glyphicon-picture"></span></button> 
    <button type="button" id="video-button" class="editor-button mytooltip postboxbutton" title="<?php echo lang("ctn_496") ?>" data-toggle="modal" data-target="#videoModal"><span class="glyphicon glyphicon-facetime-video"></span></button> 
    <button type="button" id="map-button" class="editor-button mytooltip postboxbutton" title="<?php echo lang("ctn_497") ?>" data-toggle="modal" data-target="#locationModal"><span class="glyphicon glyphicon-map-marker"></span></button> 
    <button type="button" id="user-button" class="editor-button mytooltip postboxbutton" title="<?php echo lang("ctn_339") ?>" data-toggle="collapse" data-target="#userTagBox"><span class="glyphicon glyphicon-user"></span></button> 
    <button type="button" id="poll-button" class="editor-button mytooltip postboxbutton" title="<?php echo lang("ctn_718") ?>" data-toggle="modal" data-target="#pollModal"><span class="glyphicon glyphicon-stats"></span></button>

    <button class="editor-button dropdown-toggle mytooltip postboxbutton" type="button" data-placement="top" data-toggle="dropdown" title="<?php echo lang("ctn_347") ?>"><!-- <span class="glyphicon glyphicon-heart"></span> --><span class="fa fa-grin"></span></button> 


    <?php if(isset($pageid)) : ?>
      <button class="editor-button" type="button"><input type="checkbox" name="members_only" value="1"> <?php echo lang("ctn_824") ?></button>
    <?php endif; ?>
    <ul class="dropdown-menu emojismenu custom-scrollbar-css" style="height: 330px; overflow-y: auto;">
        <li>
          <?php $smiles = $this->common->get_smiles(); ?>
          <?php foreach($smiles as $k=>$v) : ?>
            <button type="button" class="nobutton" onclick="add_smile('<?php echo $k ?>')"><?php echo $v ?></button>
          <?php endforeach; ?>
        </li>
      </ul>
   </div>
  

  

  <div class="row postbtnrow" style="background: #f5f6f7; margin: -10px; margin-top: 0px; padding-top: 10px; border-top: 1px solid #dddfe2; border-radius: 0 0 4px 4px; display: none;">
    <div class="col-md-12">
      <table style="width:100%;" border="0">
        <tr>
          <td class="editor-feedrow" width="50%">
            
            
            <table style="width:100%;" border="0">


              <tr>
                <td class="editor-feedcol" style="padding: 5px 5px;text-align: center;" onclick="checkuncheck(0);">
                  <table align="center">
                    <tr>
                      <td style="padding-right: 5px;font-size: 22px; text-align: center;color: #a41be3;">
                        <i class="newsfeed-unchecked far fa-circle" style="display: none;"></i>
                        <i class="newsfeed-checked fa fa-check-circle"></i>
                        <input type="hidden" name="checkfeed" id="checkfeed" value="1" />
                      </td>
                      <td style="padding: 5px;">
                        <img src="https://icons-for-free.com/iconfiles/png/512/morning+news+newspaper+icon-1320136429130706490.png" style="width:40px; height:40px; border-radius: 50%; border:1px solid #CCC;" />
                      </td>
                      <td>News Feed</td>
                    </tr>
                  </table>
                </td>
              </tr>


              <tr>
                <td style="text-align: center; padding: 5px;">
                  <div class="dropdown" style="z-index: 99; width: 100px !important; display: inline-block; padding: 5px; padding-bottom: 0;">
                    <?php
                if($this->uri->rsegment(1)=='pages')
                {
                  $postfor = 2;
                }
                else
                {
                  $postfor = 1;
                }
                ?>
                    <input type="hidden" name="postfor" id="postfor" value="<?php echo $postfor; ?>">
                    <a class="btn btn-xs btn-post dropdown-toggle btnpostfor" data-toggle="dropdown" style="font-weight: bold;"><i class="fa fa-globe-asia" style="font-size: 15px;"></i> &nbsp; Public <span class="caret"></span></a>
                    
                    <ul class="dropdown-menu">
                      <li class="dropdown-header">Who should see this?</li>
                      <li data-value="1" data-text="" class="active">
                        <a style="cursor: pointer;" onclick="setPostFor(1,this);"><i class="fa fa-globe-asia" style="font-size: 15px;"></i> &nbsp; Public</a>
                      </li>
                      <li data-value="2">
                        <a style="cursor: pointer;" onclick="setPostFor(2,this);"><i class="fa fa-user-friends" style="font-size: 15px;"></i> &nbsp; Friends</a>
                      </li>
                      <li data-value="3">
                        <a style="cursor: pointer;" onclick="setPostFor(3,this);"><i class="fa fa-lock" style="font-size: 15px;"></i> &nbsp; Only Me</a>
                      </li>
                    </ul>
                  </div>
                </td>
              </tr>
            </table>


          </td>




          <td class="editor-feedrow" width="50%">
            


            <table style="width:100%;" border="0">


              <tr>
                <td class="editor-feedcol storycheck" style="padding: 5px 5px;text-align: center;" onclick="checkuncheck(1);">
                  <table align="center">
                    <tr>
                      <td style="padding-right: 5px;font-size: 22px; text-align: center;color: #a41be3;">
                        <i class="storyfeed-unchecked far fa-circle" style=""></i>
                        <i class="storyfeed-checked fa fa-check-circle" style="display: none;"></i>
                        <input type="hidden" name="checkstory" id="checkstory" value="0" />
                      </td>
                      <td style="padding: 5px;">
                        <div style="position: relative; width: 40px; height: 40px; border-radius: 50%; margin: auto;">
                          <img src="<?php echo $imgurl; ?>" style="width:40px; height:40px; border-radius: 50%; border:1px solid #666;" />
                          <i class="fa fa-plus-circle" style="position: absolute;bottom: -3px; right: -3px; background: #FFF;border-radius: 50%; font-size: 18px; border: 1px solid #FFF;"></i>
                        </div>
                      </td>
                      <td>Your Story</td>
                    </tr>
                  </table>
                  
                  
                </td>
              </tr>


              <tr>
                <td style="text-align: center; padding: 5px;">
                  <div class="dropdown" style="z-index: 99; width: 100px !important; display: inline-block; padding: 5px; padding-bottom: 0;">
                    <input type="hidden" name="storyfor" id="storyfor" value="2">
                    <a class="btn btn-xs btn-post dropdown-toggle btnstoryfor" data-toggle="dropdown" style="font-weight: bold;"><i class="fa fa-user-friends" style="font-size: 15px;"></i> &nbsp; Friends <span class="caret"></span></a>
                    
                    <ul class="dropdown-menu">
                      <li class="dropdown-header">Who should see this?</li>
                      <!-- <li data-storyvalue="1" data-text="" class="active">
                        <a style="cursor: pointer;" onclick="setStoryFor(1,this);"><i class="fa fa-globe-asia" style="font-size: 15px;"></i> &nbsp; Public</a>
                      </li> -->
                      <li data-storyvalue="2" class="active">
                        <a style="cursor: pointer;" onclick="setStoryFor(2,this);"><i class="fa fa-user-friends" style="font-size: 15px;"></i> &nbsp; Friends</a>
                      </li>
                      <!-- <li data-storyvalue="3">
                        <a style="cursor: pointer;" onclick="setStoryFor(3,this);"><i class="fa fa-lock" style="font-size: 15px;"></i> &nbsp; Only Me</a>
                      </li> -->
                    </ul>
                  </div>
                </td>
              </tr>
            </table>




          </td>
        </tr>
        <tr>
          <td colspan="3" style="padding:5px;"><input type="submit" class="btn btn-post btn-sm" style="width: 100%;font-weight: bold;" value="<?php echo lang("ctn_506") ?>"></td>
        </tr>
      </table>

    </div>
  </div>


  


</div>

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_507") ?></h4>
      </div>
      <div class="modal-body ui-front form-horizontal">
          <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_499") ?></label>
                    <div class="col-md-8">
                        <input type="file" class="form-control" name="image_file" id="image_file">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_500") ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="image_url" id="image_url" placeholder="http://www ...">
                    </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
        <input type="button" class="btn btn-post" value="<?php echo lang("ctn_356") ?>" data-dismiss="modal">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_508") ?></h4>
      </div>
      <div class="modal-body ui-front form-horizontal">
          <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_502") ?></label>
                    <div class="col-md-8">
                        <input type="file" class="form-control" name="video_file" id="video_file">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_503") ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="youtube_url" id="video_url" placeholder="http://www ...">
                    </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
        <input type="button" class="btn btn-post" data-dismiss="modal" value="<?php echo lang("ctn_356") ?>">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_509") ?></h4>
      </div>
      <div class="modal-body ui-front form-horizontal">
          <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_497") ?></label>
                    <div class="col-md-8">
                      <input type="text" name="location" id="map_name" class="form-control map_name">
                    </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
        <input type="button" class="btn btn-post" data-dismiss="modal" value="<?php echo lang("ctn_356") ?>">
      </div>
    </div>
  </div>
</div>

<!-- <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_510") ?></h4>
      </div>
      <div class="modal-body ui-front form-horizontal">
          <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_504") ?></label>
                    <div class="col-md-8">
                        <select class="js-example-basic-multiple" style="width: 100%;" name="with_users[]" id="with_users" multiple="multiple">
                        
                        </select>
                    </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
        <input type="button" class="btn btn-post" value="<?php echo lang("ctn_356") ?>" data-dismiss="modal">
      </div>
    </div>
  </div>
</div> -->

<div class="modal fade" id="pollModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-stats"></span> <?php echo lang("ctn_718") ?></h4>
      </div>
      <div class="modal-body ui-front form-horizontal">
          <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_712") ?></label>
                    <div class="col-md-8">
                        <input type="text" name="poll_question" class="form-control" id="poll_question">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_451") ?></label>
                    <div class="col-md-8">
                        <select name="poll_type" class="form-control">
                          <option value="0"><?php echo lang("ctn_713") ?></option>
                          <option value="1"><?php echo lang("ctn_714") ?></option>
                        </select>
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_715") ?></label>
                    <div class="col-md-8" id="answer-area">
                        <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" name="poll_answer_1" class="form-control" placeholder="<?php echo lang("ctn_716") ?> #1 ...">
                                </div>
                        </div>
                        <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" name="poll_answer_2" class="form-control" placeholder="<?php echo lang("ctn_716") ?> #2 ...">
                                </div>
                        </div>
                        <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" name="poll_answer_3" class="form-control" placeholder="<?php echo lang("ctn_716") ?> #3 ...">
                                </div>
                        </div>
                        <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" name="poll_answer_4" class="form-control" placeholder="<?php echo lang("ctn_716") ?> #4 ...">
                                </div>
                        </div>
                        <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" name="poll_answer_5" class="form-control" placeholder="<?php echo lang("ctn_716") ?> #5 ...">
                                </div>
                        </div>
                    </div>
            </div>
            <input type="button" class="btn btn-post btn-xs" value="<?php echo lang("ctn_717") ?>" id="add_answer">
            <input type="hidden" name="poll_answers" value="5" id="poll_answers">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
        <input type="button" class="btn btn-post" value="<?php echo lang("ctn_718") ?>" data-dismiss="modal">
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {

    $('#poll_question').change(function() {
      var q = $(this).val();
      if(q) {
        $('#poll-button').addClass("highlight-button");
      } else {
        $('#poll-button').removeClass("highlight-button");
      }
    });

    $('#with_users').change(function() {
      var q = $(this).val();
      if(q) {
        $('#user-button').addClass("highlight-button");
      } else {
        $('#user-button').removeClass("highlight-button");
      }
    });

     $('#map_name').change(function() {
      var q = $(this).val();
      if(q) {
        $('#map-button').addClass("highlight-button");
      } else {
        $('#map-button').removeClass("highlight-button");
      }
    });

     $('#video_file').change(function() {
      var q = $(this).val();
      if(q) {
        $('#video-button').addClass("highlight-button");
      } else if(!$('#video_url').val()) {
        $('#video-button').removeClass("highlight-button");
      }
    });

     $('#video_url').change(function() {
      var q = $(this).val();
      if(q) {
        $('#video-button').addClass("highlight-button");
      } else if(!$('#video_file').val()) {
        $('#video-button').removeClass("highlight-button");
      }
    });

     $('#image_file').change(function() {
      var q = $(this).val();
      if(q) {
        $('#image-button').addClass("highlight-button");
      } else if(!$('#image_url').val()) {
        $('#image-button').removeClass("highlight-button");
      }
    });

     $('#image_url').change(function() {
      var q = $(this).val();
      if(q) {
        $('#image-button').addClass("highlight-button");
      } else if(!$('#image_file').val()) {
        $('#image-button').removeClass("highlight-button");
      }
    });
    $('#add_answer').click(function() {
      var answers = $('#poll_answers').val();
      answers++;
      $('#poll_answers').val(answers);

      var html = '<div class="form-group">'+
                    '<div class="col-md-12">'+
                    '<input type="text" name="poll_answer_'+answers+'" class="form-control" placeholder="<?php echo lang("ctn_716") ?> #'+answers+' ...">'+
                    '</div>'+
                    '</div>';
      $('#answer-area').append(html);
    });
  });
</script>

<?php echo form_close() ?>
</div>

<div class="modal fade" id="likeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_511") ?></h4>
      </div>
      <div class="modal-body ui-front" id="post-likes">
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="editPost">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_494") ?></h4>
      </div>
      <div class="modal-body ui-front form-horizontal" id="editPost">
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="promotePostModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="promotePost">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_") ?></h4>
      </div>
      <div class="modal-body ui-front form-horizontal" id="promotePost">
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
      </div>
    </div>
  </div>
</div>


  <div class="modal" id="boastpostModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="boastpost">

      </div>
    </div>
  </div>




<script type="text/javascript">
  function h(e) {
  $(e).css({'height':'65px','overflow-y':'hidden'}).height(e.scrollHeight-30);
}
$('textarea').each(function () {
  h(this);
}).on('input', function () {
  h(this);
});

$(function () {
  $('.mytooltip').tooltip();
})

</script>
<style type="text/css">
.editor-textarea-part {
  cursor: text;
}
.editor-textarea-part textarea {
  border: 0;
  margin: 0rem 0 0.5rem 0;
  outline: 0;
  padding: 1.5rem 0 0 1.25rem;
  resize: none;
  min-height: 50px !important;
}
.editor-feedrow:hover
{
  background: #ebedf0;
}
.editor-feedcol
{
  cursor: pointer;
  font-weight: bold;
}
.link-post-data
{
  border: 1px solid #CCC;
  position: relative;
}
.link-post-title
{
  background: #f2f2f2;
  padding: 5px 15px;
  font-size: 16px;
  font-weight: bold;
  color: #000;
  position: relative;
  
}
.link-post-desc
{
  text-overflow: ellipsis; 
  overflow: hidden; 
  white-space: nowrap; 
  overflow: hidden; 
  width: 100%; 
  padding: 5px 15px;
  background: #f2f2f2;
  border-bottom: 1px solid #CCC;
  padding-top: 0;
}
</style>
<script type="text/javascript">
  $(document).ready(function(){
  $(document).on('click','textarea', function(e) {
      e.stopPropagation();
  });
  $(document).on('click','#status-overlay', function (e) {
      $("#status-overlay").hide();
      $('.postbtnrow').hide();
      $(".editor-wrapper").css('z-index','1');
      $(".editor-wrapper").css('position', '');
  });
});
function highlightPostBox()
{
  $("#status-overlay").show();//editPost
  $('.postbtnrow').fadeIn();
  $(".editor-wrapper").css('z-index','9999999');
  $(".editor-wrapper").css('position', 'relative');
  if (typeof collapse == 'function'){
    $('#userTagBox').collapse("hide");
  }
  
}
function setPostFor(v,a)
{
  $('[data-value=1]').removeClass('active');
  $('[data-value=2]').removeClass('active');
  $('[data-value=3]').removeClass('active');
  $('[data-value='+ v +']').addClass('active');
  $("#postfor").val(v);
  $('.btnpostfor').html($(a).html()+' <span class="caret"></span>');
}
function setStoryFor(v,a)
{
  $('[data-storyvalue=1]').removeClass('active');
  $('[data-storyvalue=2]').removeClass('active');
  $('[data-storyvalue=3]').removeClass('active');
  $('[data-storyvalue='+ v +']').addClass('active');
  $("#storyfor").val(v);
  $('.btnstoryfor').html($(a).html()+' <span class="caret"></span>');
}
function setPostForEdit(v,a)
{
  $('[data-editvalue=1]').removeClass('active');
  $('[data-editvalue=2]').removeClass('active');
  $('[data-editvalue=3]').removeClass('active');
  $('[data-editvalue='+ v +']').addClass('active');
  $("#postforedit").val(v);
  $('.btnpostfor.editpostfor').html($(a).html()+' <span class="caret"></span>');
}
function checkuncheck(v)
{
  if(v==0)
  {
    var f = $('#checkfeed').val(); 
    if(f==1)
    {
      $('#checkfeed').val(0);
      $('.newsfeed-unchecked').show();
      $('.newsfeed-checked').hide();
    }
    else
    {
      $('#checkfeed').val(1);
      $('.newsfeed-checked').show();
      $('.newsfeed-unchecked').hide();
    }
  }
  else if(v==1)
  {
    var f = $('#checkstory').val(); 
    if(f==1)
    {
      $('#checkstory').val(0);
      $('.storyfeed-unchecked').show();
      $('.storyfeed-checked').hide();
    }
    else
    {
      $('#checkstory').val(1);
      $('.storyfeed-checked').show();
      $('.storyfeed-unchecked').hide();
    }
  }
}
function checkeditor()
{
  if(!$('.postbtnrow').is(':visible'))
  {
    $('textarea').click();
  }
}
function extracturl(text)
{
  var regex = /https?:\/\/[\-A-Za-z0-9+&@#\/%?=~_|$!:,.;]*/g;
  link = text.match(regex);
  var extlink = "";
  if($('#ext-post-link').length)
  {
    extlink = $('#ext-post-link').val();
  }
  
  //alert(extlink);
  if(link!=null && extlink=="")
  {
      //alert(extlink);
      $('.editor-post-container').html('Loading...');
      //$('.editor-post-container').hide();
       $.ajax({
            type:'post',
            url:'<?php echo site_url('feed/extracturl'); ?>',
            data:{
              link:link,
              '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
            },
         cache: false,
         success:function(response) {
            //$('#loading').text('');
            //$('.container').show();
            $('.editor-post-container').html(response);
          }
        });
   }
}
</script> 
<?php
if($this->uri->rsegment(1)=='pages')
{
  ?>
<style>
  .editor-feedrow { display: none; }
</style>
  <?php
}
?>