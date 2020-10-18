<div class="row">

<div class="col-md-3">
<?php include(APPPATH . "views/user_settings/sidebar.php"); ?>
</div>

 <div class="col-md-9">


<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-file"></span> <?php echo lang("ctn_1004") ?></div>
    <div class="db-header-extra">
</div>
</div>

<table class="table table-bordered table-hover table-striped">
<tr class="table-header"><td><?php echo lang("ctn_984") ?></td><td><?php echo lang("ctn_986") ?></td><td><?php echo lang("ctn_1000") ?></td><td><?php echo lang("ctn_1001") ?></td><td><?php echo lang("ctn_52") ?></td></tr>
<?php foreach($adverts->result() as $r) : ?>
<tr>

	<?php
		$src = base_url() . $this->settings->info->upload_path_relative.'/' . $r->image;

	 ?>

	<td><div style="width:100px;height:100px;"><img style="width:100px; height:100px;" src="<?php echo $src; ?>"></div></td>

	<?php
			if ($r->add_duration == 1) {
				$addduration = "One Weak";
			}elseif ($r->add_duration == 2) {
				$addduration = "Two Weak";
			}elseif ($r->add_duration == 3) {
				$addduration = "Three Weak";
			}elseif ($r->add_duration == 4) {
				$addduration =  "One Month";
			}


	 ?>
	<td><?php echo $addduration ?></td>

	<td><?php echo $r->page ?></td>
	<td><?php echo date($this->settings->info->date_format, $r->timestamp); ?></td>
	<td style="text-align: center;"><a href="<?php echo site_url('user_settings/alladverts/') .$r->ID?>"><div style="font-size: 20px; color: green; cursor: pointer;"><i class="fa fa-eye"></i></div></a></td>
</tr>
<?php endforeach; ?>

</table> 

</div>

</div>
</div>
