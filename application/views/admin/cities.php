<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
  <li class="active"><?php echo lang("ctn_1055") ?></li>
</ol>
 <script >
    $(document).ready( function () {
    $('#member-table1').DataTable();
} );
</script>

<div class="table-responsive">
<table id="member-table1" class="table table-striped table-hover table-bordered table-image">
<thead>
<tr class="table-header">
  <td><?php echo lang("ctn_1056") ?></td>
  <td><?php echo lang("ctn_1057") ?></td>
  <td><?php echo lang("ctn_1058") ?></td>
</tr>
</thead>
<tbody>
  <?php 
  $counter = 1;
 foreach($cities as $city)
 {   ?>
  <tr>
      <td><?php  echo $counter++ ?></td>
      <td><?php  echo $city->name ?></td>
      <td><?php  if($city->papulation > 0){echo $city->papulation;}else{ ?><div class="db-header-extra"> <input type="button" class="btn btn-post btn-sm" value="<?php echo lang("ctn_1053") ?> " onclick="add_papulation(<?php echo $city->id; ?>)">
</div><?php }?></td>
  </tr>
<?php }
  ?>
</tbody>
</table>
</div>


</div>

<div class="modal fade" id="add_city_papulation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">ADD Papulation</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart(site_url("admin/add_city_papulation"), array("class" => "form-horizontal")) ?>
            
            <div class="form-group">
                <label for="email-in" class="col-md-3 label-heading">Papulation</label>
                <div class="col-md-9">
                   <input placeholder="Enter Country Papulation" required="" type="text" class="form-control" id="city_papulation" name="city_papulation">
                </div>
                <input type="hidden" name="city_id" value="" id="city_id">
            </div>
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
        <input type="submit" class="btn btn-post" value="<?php echo lang("ctn_1054") ?>" />
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function add_papulation($id)
  {
    $('#city_id').val($id);
    $('#add_city_papulation').modal('show');
  }
</script>

