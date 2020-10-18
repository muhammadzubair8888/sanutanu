<div class="row">
  <div class="col-md-12">
    <style>
      .footer-section {
        width: 100% !important;
      }
    </style>

    <div class="profile-header" style="background: url(<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative . "/" . $user->profile_header ?>) center center; background-size: cover;">
      <div class="profile-header-avatar">
        <img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $user->avatar ?>">
      </div>
      <div class="profile-header-name">
        <?php echo $user->first_name ?> <?php echo $user->last_name ?>
      </div>
    </div>
    <div class="profile-header-bar clearfix">
      <ul>
        <li><a href="<?php echo site_url("profile/" . $user->username) ?>"><?php echo lang("ctn_200") ?></a></li>
        <li><a href="<?php echo site_url("profile/about/" . $user->ID) ?>"><?php echo lang("ctn_205") ?></a></li>
        <li><a href="<?php echo site_url("profile/friends/" . $user->ID) ?>"><?php echo lang("ctn_493") ?></a></li>
        <li class="active"><a href="<?php echo site_url("profile/albums/" . $user->ID) ?>"><?php echo lang("ctn_483") ?></a></li>
      </ul>

      <div class="pull-right profile-friend-box">
        <?php if ($this->user->loggedin) : ?>
          <?php
          /************************ Message Button Start by Tanveer 29/03/2020 *************************/
          ?>
          <?php if ($user->chat_option == 0) { ?>
            <button type="button" class="btn btn-post btn-sm" id="start_chat_button" onClick="chat_with(<?php echo $user->ID; ?>);"><?php echo lang("ctn_12"); ?></button>
            <?php
          } else {
            if ($friend_flag) {
            ?>
              <button type="button" class="btn btn-post btn-sm" id="start_chat_button" onClick="chat_with(<?php echo $user->ID; ?>);"><?php echo lang("ctn_12"); ?></button>
          <?php
            }
          }
          ?>
          <?php
          /************************ Message Button End by Tanveer 29/03/2020 *************************/
          ?>
          <?php if ($user->ID != $this->user->info->ID) : ?>
            <?php if ($friend_flag) : ?>
              <button type="button" class="btn btn-success btn-sm" id="friend_button_<?php echo $user->ID ?>"><span class="glyphicon glyphicon-ok"></span> <?php echo lang("ctn_493") ?></button>
            <?php else : ?>
              <?php if ($request_flag) : ?>
                <button type="button" class="btn btn-success btn-sm disabled" id="friend_button_<?php echo $user->ID ?>"><?php echo lang("ctn_601") ?></button>
              <?php else : ?>
                <?php if (!$user->allow_friends) : ?>
                  <button type="button" class="btn btn-success btn-sm" onclick="add_friend(<?php echo $user->ID ?>)" id="friend_button_<?php echo $user->ID ?>"><?php echo lang("ctn_602") ?></button>
                <?php endif; ?>
              <?php endif; ?>
            <?php endif; ?>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>

    <div class="white-area-conten separator">

      <div class="album-tools" style="border-bottom: 1px solid #e0e0e0; margin-bottom:10px; padding-bottom:10px;">
        <?php if ($this->user->loggedin && $user->ID == $this->user->info->ID) : ?>
          <input type="button" class="btn btn-sm btn-post" value="<?php echo lang("ctn_555") ?>" data-toggle="modal" data-target="#addModal">
        <?php endif; ?>
      </div>




      <ul id="albums">
        <?php
        $CI = &get_instance();
        $CI->load->model('image_model');
        $albums = $CI->image_model->get_user_albums_all($user->ID);
        foreach ($albums->result() as $r) {
          $r2 = $this->db->limit(1)->where('albumid', $r->ID)->get('user_images')->row();
          if (isset($r2->file_name)) {
            $image = '<img src="' . base_url() . $this->settings->info->upload_path_relative . '/' . $r2->file_name . '" width="50">';
          } else {
            $image = '<img src="' . base_url() . $this->settings->info->upload_path_relative . '/default_album.png" width="50">';
          }
          echo '<li><a href="' . site_url("profile/view_album/" . $r->ID) . '">' . $image . '' . $image . '' . $image . '' . $image . '' . $image . '' . $image . '</a><a href="' . site_url("profile/view_album/" . $r->ID) . '" style="height: inherit;"><h5>' . $r->name . '</h5></a></li>';
        }
        ?>
      </ul>
    </div>





    <!-- <div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo $user->first_name ?>'s <?php echo lang("ctn_483") ?></div>
    <div class="db-header-extra form-inline"> 

        <div class="form-group has-feedback no-margin">
<div class="input-group">
<input type="text" class="form-control input-sm" placeholder="<?php echo lang("ctn_336") ?>" id="form-search-input" />
<div class="input-group-btn">
    <input type="hidden" id="search_type" value="0">
        <button type="button" class="btn btn-sm dropdown-toggle btn_search" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
        <ul class="dropdown-menu small-text" style="min-width: 90px !important; left: -90px;">
          <li><a href="#" onclick="change_search(0)"><span class="glyphicon glyphicon-ok" id="search-like"></span> <?php echo lang("ctn_337") ?></a></li>
          <li><a href="#" onclick="change_search(1)"><span class="glyphicon glyphicon-ok nodisplay" id="search-exact"></span> <?php echo lang("ctn_338") ?></a></li>
          <li><a href="#" onclick="change_search(2)"><span class="glyphicon glyphicon-ok nodisplay" id="name-exact"></span> <?php echo lang("ctn_81") ?></a></li>
        </ul>
      </div><! -- /btn-group - ->
</div>
</div>

<?php if ($this->user->loggedin && $user->ID == $this->user->info->ID) : ?>
<input type="button" class="btn btn-sm btn-create-albums" value="<?php echo lang("ctn_555") ?>" data-toggle="modal" data-target="#addModal">
<?php endif; ?>
</div>
</div>



<div class="table-responsive">








<table id="album-table" class="table table-striped table-hover table-bordered">
<thead>
<tr class="table-header"><td><?php echo lang("ctn_556") ?></td><td><?php echo lang("ctn_81") ?></td><td><?php echo lang("ctn_557") ?></td><td><?php echo lang("ctn_558") ?></td><td><?php echo lang("ctn_52") ?></td></tr>
</thead>
<tbody>
</tbody>
</table>
</div>


</div>

 </div>
 </div> -->
    <?php echo form_open(site_url("profile/add_album/0")) ?>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-picture"></span> <?php echo lang("ctn_555") ?></h4>
          </div>
          <div class="modal-body ui-front form-horizontal">
            <div class="form-group">
              <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_81") ?></label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="name">
              </div>
            </div>
            <div class="form-group">
              <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_271") ?></label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="description">
              </div>
            </div>
            <div class="form-group">
              <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_775") ?></label>
              <div class="col-md-8">
                <select class="form-control" name="privacy">
                  <option value="1">Public</option>
                  <option value="2">Friends</option>
                  <option value="3">Private</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
            <input type="submit" class="btn btn-post" value="<?php echo lang("ctn_559") ?>">
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close() ?>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content" id="edit-album">

        </div>
      </div>
    </div>
    <script type="text/javascript">
      /*$(document).ready(function() {

   var st = $('#search_type').val();
    var table = $('#album-table').DataTable({
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
        { "orderable" : false }
    ],
        "ajax": {
            url : "<?php echo site_url("profile/albums_page/" . $user->ID) ?>",
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

} );*/
      /*function change_search(search) 
          {
            var options = [
            "search-like", 
            "search-exact",
            "name-exact",
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
          }*/
    </script>
    <div class="clearfix"></div>