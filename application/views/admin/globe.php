<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
  <li class="active"><?php echo lang("ctn_1048") ?></li>
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
  <td><?php echo lang("ctn_1049") ?></td>
  <td><?php echo lang("ctn_1050") ?></td>
  <td><?php echo lang("ctn_1051") ?></td>
  <td><?php echo lang("ctn_1052") ?></td>
</tr>
</thead>
<tbody>
  <?php 
  $counter = 1;
 foreach($globe as $glb)
 {   ?>
  <tr>
      <td><?php  echo $counter++ ?></td>
      <td><?php  echo $glb->name ?></td>
      <td><?php  if($glb->papulation > 0){echo $glb->papulation;}else{ ?><div class="db-header-extra"> <input type="button" class="btn btn-post btn-sm" value="<?php echo lang("ctn_1053") ?> " onclick="add_papulation(<?php echo $glb->id; ?>)">
</div><?php }?></td>
      <td><?php  if($glb->rate_per > 0){echo '$'.$glb->rate_per;}else{ ?><div class="db-header-extra"> <input type="button" class="btn btn-post btn-sm" value="<?php echo lang("ctn_1059") ?> " onclick="add_rate(<?php echo $glb->id; ?>)">
</div><?php }?></td>
  </tr>
<?php }
  ?>
</tbody>
</table>
</div>


</div>

<div class="modal fade" id="add_country_papulation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">ADD Papulation</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart(site_url("admin/add_country_papulation"), array("class" => "form-horizontal")) ?>
            
            <div class="form-group">
                <label for="email-in" class="col-md-3 label-heading">Papulation</label>
                <div class="col-md-9">
                   <input placeholder="Enter Country Papulation" required="" type="text" class="form-control" id="country_papulation" name="country_papulation">
                </div>
                <input type="hidden" name="country_id" value="" id="country_id">
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

<div class="modal fade" id="add_country_rate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">ADD Papulation</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart(site_url("admin/add_country_rate"), array("class" => "form-horizontal")) ?>
            
            <div class="form-group">
                <label for="email-in" class="col-md-3 label-heading">rate</label>
                <div class="col-md-9">
                   <input placeholder="Enter Country Rate" required="" type="text" class="form-control" id="country_rate" name="country_rate">
                </div>
                <input type="hidden" name="cntry_id" value="" id="cntry_id">
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
    $('#country_id').val($id);
    $('#add_country_papulation').modal('show');
  }

  function add_rate($id)
  {
    $('#cntry_id').val($id);
    $('#add_country_rate').modal('show');
  }
</script>

