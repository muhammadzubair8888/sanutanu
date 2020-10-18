<div class="row">
        <div class="col-md-12">

  <div class="mx1 mb2 h6 sm-h4 flex justify-center filter-buttons-group filter-buttons x-btn-group topbuttons" data-filter-group="type">
    <a href="<?php echo site_url('pages/joined'); ?>" class="btn btn-post btn-tab"><?php echo lang('ctn_982'); ?></a>
    <a href="<?php echo site_url('pages/your'); ?>" class="btn btn-post btn-tab btn-active"><?php echo lang('ctn_577'); ?></a>
    <?php if( (isset($member) && $member != null && $member->roleid == 1) || ($this->common->has_permissions(array("admin", "page_admin", "page_creator"), $this->user)) ) : ?>
    <a href="<?php echo site_url("pages/add") ?>" class="btn btn-post btn-tab"><?php echo lang("ctn_531") ?></a>
    <?php endif; ?>
  </div>

        <ol class="users-list">
          <?php  
          $pages = $this->page_model->get_user_pages_simple($this->user->info->ID);
          if($pages->num_rows()>0)
          {
            foreach($pages->result() as $page):
          ?>
               <li class="users-list-item">
                  <div class="avatar">  
                    <img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $page->profile_avatar ?>" style="width: 100%; height: 100%;" draggable="false"> 
                  </div>
                  <div class="user-details">
                     <h3><a href="<?php echo site_url("pages/view/" . $page->slug); ?>"><?php echo $page->name; ?></a></h3>
                     <p>@<?php echo $page->slug; ?></p>
                  </div>

                  <div class="actions">
                    <div class="column">
                      <span class="detail"><strong><?php echo $page->pageviews; ?></strong> Page Views</span>
                    </div>
                    <div class="column">
                      <span class="detail"><strong><?php echo $page->members; ?></strong> Members</span>
                    </div>
                    <div class="column">
                      <span class="detail"><strong><?php echo $page->category_name; ?></strong> Category</span>
                    </div>
                    <div class="appo">
                      <a href="<?php echo site_url("pages/edit_page/" . $page->ID); ?>" title="<?php echo lang('ctn_964'); ?>"><i class="fa fa-edit"></i></a> | 
                      <a href="<?php echo site_url("pages/delete_page/" . $page->ID . "/" . $this->security->get_csrf_hash()); ?>" onclick="return confirm('<?php echo lang("ctn_86"); ?>')" style="color:#c12e2a;" title="<?php echo lang('ctn_966'); ?>"><i class="fa fa-trash"></i></a>
                      <!-- <a href="#" class="btn">Book Now</a> -->
                    </div>
                  </div>

               </li>
          <?php
            endforeach;
          }
          ?>
            </ol>



            


<style type="text/css">
  
  .users-list {
  width: 100%;
  margin: 0;
  padding: 0;
  list-style-type: none;
  margin-top: 10px;
}
.users-list-item {
  padding: 5px;
  background: white;
  display: flex;
  /* box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); */
  border: 1px solid #d4dce2;
   margin-bottom:10px;
   border-radius: 3px;
   cursor: inherit !important;
}

.users-list-item:hover {
   cursor: pointer;
   /* background-color: #f2f2f2; */
}

.avatar {
  width: 80px;
  height: 80px;
  margin-right: 5px;
  background-repeat: no-repeat;
  background-size: cover;
  border-radius: 50%;
  flex-shrink: 0;
}

.user-details {
  width: 40%;
  min-width: 140px;
  padding-left: 20px;
  border-left: 1px solid #eee;
  flex: 1;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.user-details p {
  margin: 0;
  min-width: 0;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}


.users-list .actions {
  margin: 0;
  display: flex;
  width: 60%;
  border-collapse: collapse;
  border-style: hidden;
  /*box-shadow: 0 0 0 1px #ebedf0;*/
}

.users-list .actions > div {
  text-align: center;
  padding: 0;
  flex: auto;
  border-right: 1px solid #ebedf0;
  vertical-align: middle;
  padding: auto;
  display: flex;
  justify-content: center;
  align-items: center;
}

.users-list .actions .appo{ border: none; }

.users-list .actions .column .detail {
  font-size: 12px;
  text-transform: uppercase;
  color: #333;
}

.users-list .actions .column .detail strong {
  display: block;
  color: #0081e0;
  font-size: 18px;
  font-weight: 400;
  line-height: 20px;
}

/* .users-list .actions .appo {
  width: 30%;
}

.users-list .actions .appo .btn {
  background: #0081e0;
  display: block;
  text-decoration: none;
  color: #fff;
  text-transform: uppercase;
  padding: 15px;
  margin: 0 5px;
} */
</style>


        	<!-- <div class="white-area-content">
            
            <div class="db-header clearfix">
                      <div class="page-header-title"> <span class="glyphicon glyphicon-file"></span> <?php echo lang("ctn_577") ?></div>
                      <div class="db-header-extra form-inline"> 
          
                                   <div class="form-group has-feedback no-margin">
                                      <div class="input-group">
                                      <input type="text" class="form-control input-sm" placeholder="<?php echo lang("ctn_336") ?>" id="form-search-input" />
                                      <div class="input-group-btn">
                                          <input type="hidden" id="search_type" value="0">
                                              <button type="button" class="btn btn_search btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                              <ul class="dropdown-menu small-text" style="min-width: 90px !important; left: -90px;">
                                                <li><a href="#" onclick="change_search(0)"><span class="glyphicon glyphicon-ok" id="search-like"></span> <?php echo lang("ctn_337") ?></a></li>
                                                <li><a href="#" onclick="change_search(1)"><span class="glyphicon glyphicon-ok nodisplay" id="search-exact"></span> <?php echo lang("ctn_338") ?></a></li>
                                                <li><a href="#" onclick="change_search(2)"><span class="glyphicon glyphicon-ok nodisplay" id="name-exact"></span> <?php echo lang("ctn_81") ?></a></li>
                                                <li><a href="#" onclick="change_search(3)"><span class="glyphicon glyphicon-ok nodisplay" id="cat-exact"></span> <?php echo lang("ctn_560") ?></a></li>
                                              </ul>
                                            </div>/btn-group
                                      </div>
                                      </div>
          
                                      <a href="<?php echo site_url("pages") ?>"  class="btn btn-default btn-sm"><?php echo lang("ctn_487") ?></a> 
          
                                      <?php if( (isset($member) && $member != null && $member->roleid == 1) || ($this->common->has_permissions(array("admin", "page_admin", "page_creator"), $this->user)) ) : ?> 
          
                                  <a href="<?php echo site_url("pages/add") ?>" class="btn btn-post btn-sm"><?php echo lang("ctn_531") ?></a>
                                <?php endif; ?>
                  </div>
                  </div>
          
          
                          <div class="table-responsive">
                          <table id="page-table" class="table table-striped table-hover table-bordered">
                          <thead>
                          <tr class="table-header"><td><?php echo lang("ctn_81") ?></td><td><?php echo lang("ctn_561") ?></td><td><?php echo lang("ctn_21") ?></td><td><?php echo lang("ctn_562") ?></td><td><?php echo lang("ctn_52") ?></td></tr>
                          </thead>
                          <tbody>
                          </tbody>
                          </table>
                          </div>
          
          
          
          
          </div>
                  </div>
              </div> -->

    <!-- <script type="text/javascript">
    $(document).ready(function() {
    
       var st = $('#search_type').val();
    var table = $('#page-table').DataTable({
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
        null,
        null,
        null,
        null,
        { "orderable" : false }
    ],
        "ajax": {
            url : "<?php //echo site_url("pages/your_page") ?>",
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
      "name-exact",
      "cat-exact",
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
    </script> -->