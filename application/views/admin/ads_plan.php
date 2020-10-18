<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    <div class="db-header-extra"> <input type="button" class="btn btn-post btn-sm" value="<?php echo lang("ctn_268") ?>" data-toggle="modal" data-target="#myModal">
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
  <li class="active"><?php echo lang("ctn_268") ?></li>
</ol>
 

<div class="table-responsive">
<table id="member-table" class="table table-striped table-hover table-bordered table-image">
<thead>
<tr class="table-header">
  <td><?php echo lang("ctn_260") ?></td>
  <td><?php echo lang("ctn_606") ?></td>
  <td><?php echo lang("ctn_997") ?></td>
  <td><?php echo lang("ctn_393") ?></td>
  <td><?php echo lang("ctn_994") ?></td>
  <td><?php echo lang("ctn_396") ?></td>
  <td><?php echo lang("ctn_265") ?></td>
  <td><?php echo lang("ctn_451") ?></td>
  <td><?php echo lang("ctn_52") ?></td> 
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>


</div>


 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo lang("ctn_707") ?></h4>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart(site_url("admin/insert_ads_plan"), array("class" => "form-horizontal")) ?>
              <div class="form-group">
              <div class="post-text" itemprop="text">
                <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_260") ?></label>
                 <div class="col-md-9">

                <input required="" type="text" class="form-control" name="plan_tittle" >
              
               </div>

              </div>
             </div>
            <div class="form-group">
                    <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_987") ?></label>
                    <div class="col-md-9">
                        <select  id="country_for_add_rotation" name="country_id" class="form-control">
                          <option value=""><?php echo lang("ctn_987") ?></option> 
                          <?php foreach ($all_countries as $key) { ?>
                              <option value="<?php echo $key->id; ?>"><?php echo $key->name; ?></option>
                          <?php  } ?>
                        </select>
                    </div>
            </div>
                    <script>
                            $( "select[id='country_for_add_rotation']" ).change(function (){
                                var country_for_add_rotation = $(this).val();
                                if(country_for_add_rotation == "") {
                                    $('select[id="state"]').empty();
                                }else{

                                  $.ajax({
                                        type: 'GET',
                                        url: "<?php echo site_url('admin/get_states_against_country_for_add_rotation/'); ?>"+country_for_add_rotation,
                                        success: function(state) {
                                            $("#showstate").fadeIn();
                                            $('select[id="state"]').html(state);
                                        }
                                    });
                                    
                                }
                            });
                        </script>            
            <div id="showstate" style="display: none;" class="form-group">
                    <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_988") ?></label>
                    <div class="col-md-9">
                        <select id="state" name="state_id" class="form-control">

                        </select>
                    </div>
            </div>            
                    <script>
                            $( "select[id='state']" ).change(function (){
                                var state = $(this).val();
                                if(state == "") {
                                    $('select[id="city"]').empty();
                                }else{

                                  $.ajax({
                                        type: 'GET',
                                        url: "<?php echo site_url('admin/get_city_against_country_for_add_rotation/'); ?>"+state,
                                        success: function(city) {
                                            $("#showcity").fadeIn();
                                            $('select[id="city"]').html(city);
                                        }
                                    });
                                    
                                }
                            });
                        </script> 
            <div id="showcity" style="display: none;" class="form-group">
                    <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_989") ?></label>
                    <div class="col-md-9">
                        <select id="city" name="city_id" class="form-control">

                        </select>
                    </div>
            </div>  
            <div class="form-group">
                    <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_606") ?></label>
                    <div class="col-md-9">
                        <select required="" name="status" class="form-control">
                        <option value="0"><?php echo lang("ctn_702") ?></option>
                        <option value="1"><?php echo lang("ctn_703") ?></option>
                        </select>
                    </div>
            </div>
            <div class="form-group">
                <label for="password-in" class="col-md-3 label-heading"><?php echo lang("ctn_997") ?></label>
                <div class="col-md-9">
                    <input required="" type="number" name="no_of_ads" class="form-control" value="0">
                </div>
            </div>
            <div class="form-group">
                <label for="password-in" class="col-md-3 label-heading"><?php echo lang("ctn_265") ?></label>
                <div class="col-md-9">
                    <input required="" type="number" name="credit_cost" class="form-control" value="0">
                </div>
            </div>
                                   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
        <input type="submit" class="btn btn-post" value="<?php echo lang("ctn_707") ?>" />
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {

   var st = $('#search_type').val();
    var table = $('#member-table').DataTable({
        "dom" : "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      "processing": false,
        "pagingType" : "full_numbers",
        "pageLength" : 15,
        "serverSide": true,
        "orderMulti": false,
        "order": [
          [1, "asc" ]
        ],
        "columns": [
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,


        { "orderable" : false }
    ],
        "ajax": {
            url : "<?php echo site_url("admin/ads_plan_page") ?>",
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
        "reason-exact",
        "user-exact",
        "page-exact",
        "from-exact",
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