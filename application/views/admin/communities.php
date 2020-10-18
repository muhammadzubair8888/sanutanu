<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    <div class="db-header-extra"> <input type="button" class="btn btn-post btn-sm" value="Add New Comunity" data-toggle="modal" data-target="#myModal">
</div>
</div>
<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
  <li class="active"><?php echo lang("ctn_1042") ?></li>
</ol>
 

<div class="table-responsive">
<table  id="example1" class="table table-striped table-hover table-bordered table-image">
<thead>
<tr class="table-header">
  <td>Religion Name</td>
   <td>Comunity Name</td> 
  <td><?php echo lang("ctn_52") ?></td> 
</tr>
</thead>
<tbody>
  <?php foreach ($allcomunities as $r) { ?>
    <tr>
    <td><?php echo $r->religionname; ?></td>
    <td><?php echo $r->comunityname; ?></td>
    <td style="text-align: center;"><a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/delete_communities/').$r->ID; ?>"><i class="glyphicon glyphicon-trash"></i></a></td>
    </tr>
  <?php } ?> 
</tbody>
</table>
</div>


</div>

 
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Comunity</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart(site_url("admin/add_community_category"), array("class" => "form-horizontal")) ?>
            <div class="form-group">
              <label for="email-in" class="col-md-3 label-heading">Select Religion</label>
              <div class="col-md-9">
                  <select class="form-control" name="religion_id">
                    <?php foreach ($religions as $key) { ?>
                      <option value="<?php  echo $key->ID ?>"><?php echo $key->name; ?></option>
                    <?php } ?>
                </select>
              </div>
            </div> 
            <div class="form-group">
                <label for="email-in" class="col-md-3 label-heading">Comunity Name</label>
                <div class="col-md-9">
                   <input placeholder="Enter Comunity name" required="" type="text" class="form-control" id="name" name="name">
                </div>
            </div>
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
        <input type="submit" class="btn btn-post" value="Add New Comunity" />
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>




<script >
    $(document).ready( function () {
    $('#example1').DataTable();
} );
</script>