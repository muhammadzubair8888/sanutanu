 <div class="row">
 <div class="col-md-12">


 <div class="profile-header" style="background: url(<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative . "/" . $user->profile_header ?>) center center; background-size: cover;">
 <div class="profile-header-avatar">
	<?php if($this->user->info->ID==$user->ID){
    ?>
    <a href="#mn1" class="dropdown-toggle" id="profilepicturemenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $user->avatar ?>"></a>
    <?php
  }else{
    ?>
    <img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $user->avatar ?>">
    <?php
  } ?>
 </div>
 <ul class="dropdown-menu" id="mn1" role="menu" aria-labelledby="profilepicturemenu">
    <li><a style="cursor: pointer;" onclick="post_modal(<?php echo $user->profilepic_postid; ?>);"><i class="glyphicon glyphicon-user"></i> &nbsp View Profile Picture</a></li>
    <li><a style="cursor: pointer;" onclick="profilepicpopup_modal();"><i class="glyphicon glyphicon-picture"></i> &nbsp Upload Profile Picture</a></li>
  </ul>

 <div class="profile-header-name">
<?php echo $user->first_name ?> <?php echo $user->last_name ?>
 </div>
 </div>
 <div class="profile-header-bar clearfix">
 <ul>
 	<li><a href="<?php echo site_url("profile/" . $user->username) ?>"><?php echo lang("ctn_200") ?></a></li>
 	<li class="active"><a href="<?php echo site_url("profile/about/" . $user->ID) ?>"><?php echo lang("ctn_205") ?></a></li>
  <li><a href="<?php echo site_url("profile/friends/" . $user->ID) ?>"><?php echo lang("ctn_493") ?></a></li>
  <li><a href="<?php echo site_url("profile/albums/" . $user->ID) ?>"><?php echo lang("ctn_483") ?></a></li>
 </ul>

 <div class="pull-right profile-friend-box">
  <?php if($user->ID != $this->user->info->ID) : ?>
  <?php
    /************************ Message Button Start by Tanveer 29/03/2020 *************************/
    ?>
  <?php if($user->chat_option==0)
  { ?>
    <button type="button" class="btn btn-post btn-sm" id="start_chat_button" onClick="chat_with(<?php echo $user->ID; ?>);"><?php echo lang("ctn_12"); ?></button>
    <?php
  }
  else
  {
    if($friend_flag)
    {
      ?>
      <button type="button" class="btn btn-post btn-sm" id="start_chat_button" onClick="chat_with(<?php echo $user->ID; ?>);"><?php echo lang("ctn_12"); ?></button>
      <?php
    }
  }
  ?>
  <?php
  /************************ Message Button End by Tanveer 29/03/2020 *************************/
  ?>
<?php if($friend_flag) : ?>
<button type="button" class="btn btn-success btn-sm" id="friend_button_<?php echo $user->ID ?>"><span class="glyphicon glyphicon-ok"></span> <?php echo lang("ctn_493") ?></button>
<?php else : ?>
<?php if($request_flag) : ?>
<button type="button" class="btn btn-success btn-sm disabled" id="friend_button_<?php echo $user->ID ?>"><?php echo lang("ctn_601") ?></button>
<?php else : ?>
  <?php if(!$user->allow_friends) : ?>
  <button type="button" class="btn btn-success btn-sm" onclick="add_friend(<?php echo $user->ID ?>)" id="friend_button_<?php echo $user->ID ?>"><?php echo lang("ctn_602") ?></button>
  <?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
 </div>
 </div>

<div class="white-area-content separator">


<div class="row">
  <div class="col-md-5">
    <h3>About</h3>
    <div class="list-group">
      <a href="#" class="list-group-item active">Overview</a>
      <a href="#" class="list-group-item">Work and Education</a>
      <a href="#" class="list-group-item">Places You've Lived</a>
      <a href="#" class="list-group-item">Contact and Basic Info</a>
      <a href="#" class="list-group-item">Family and Relationships</a>
      <a href="#" class="list-group-item">Details About You</a>
      <a href="#" class="list-group-item">Life Events</a>
    </div>
  </div>
  <div class="col-md-7"></div>
</div>


</div>

 </div>
 </div>
 <script type="text/javascript">
$(document).ready(function() {

   var st = $('#search_type').val();
    var table = $('#friends-table').DataTable({
        "dom" : "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      "processing": false,
        "pagingType" : "full_numbers",
        "pageLength" : 15,
        "serverSide": true,
        "orderMulti": false,
        "order": [
        ],
        "columns": [
        { "orderable" : false },
        null,
        null,
        null,
        null,
        { "orderable" : false }
    ],
        "ajax": {
            url : "<?php echo site_url("profile/friends_page/" . $user->ID) ?>",
            type : 'GET',
            data : function ( d ) {
                d.search_type = $('#search_type').val();
            }
        },
        "drawCallback": function(settings, json) {
        $('[data-toggle="tooltip"]').tooltip();
      }
    });
    $('#form-search-input').on('keyup change', function () {
    table.search(this.value).draw();
});

} );
function change_search(search) 
    {
      var options = [
      "search-like", 
      "search-exact",
      "username-exact",
      "firstname-exact",
      "lastname-exact",

      ];
      set_search_icon(options[search], options);
        $('#search_type').val(search);
        $( "#form-search-input" ).trigger( "change" );
    }

function set_search_icon(icon, options) 
    {
      for(var i = 0; i<options.length;i++) {
        if(options[i] == icon) {
          $('#' + icon).fadeIn(10);
        } else {
          $('#' + options[i]).fadeOut(10);
        }
      }
    }
</script>