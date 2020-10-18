<!-- <script src="<?php echo base_url();?>scripts/custom/get_usernames.js"></script> -->
<div class="row">

<div class="col-md-3">
<?php include(APPPATH . "views/user_settings/sidebar.php"); ?>
</div>

 <div class="col-md-9">
<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="fa  fa-address-book"></span> <?php echo lang("ctn_544") ?></div>
    <div class="db-header-extra">
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li class="active"><?php echo lang("ctn_544") ?></li>
</ol>

<hr>

<div class="panel panel-default">
<div class="panel-body">
<p class="panel-subheading"><?php echo lang("ctn_227") ?></p>
<?php echo form_open_multipart(site_url("user_settings/contact_us/save"), array("class" => "form-horizontal")) ?>

<div class="form-group"><!-- title -->
    <label for="inputEmail3" class="col-sm-3 control-label"><?php echo lang("ctn_11") ?></label>
    <div class="col-sm-9">
    	<input type="text" class="form-control" name="title" id="title" />
    </div>
</div>

<div class="form-group"><!-- Message -->
    <label for="inputEmail3" class="col-sm-3 control-label"><?php echo lang("ctn_12") ?></label>
    <div class="col-sm-9">
    	<textarea type="text" class="form-control" name="description" id="description" rows="10" ></textarea>
    </div>
</div>
 <input type="submit" name="s" value="<?php echo lang("ctn_61") ?>" class="btn btn-post form-control" />
<?php echo form_close() ?>
</div>
</div>
</div>


</div>
</div>
<!-- <script type="text/javascript">
$(document).ready(function() {
	$('#relationship').on("change", function() {
		var status = $('#relationship').val();
		if(status == 2 || status == 3) {
			$('#relationship_user').fadeIn(10);
		} else {
			$('#relationship_user').fadeOut(10);
		}
	});
});
</script> -->