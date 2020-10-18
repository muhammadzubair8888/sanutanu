<div class="row">

<div class="col-md-3">
<?php include(APPPATH . "views/user_settings/sidebar.php"); ?>
</div>

<?php foreach($singleadvert->result() as $r) : 
$src = base_url() . $this->settings->info->upload_path_relative.'/' . $r->image;

 endforeach; ?>


 <div class="col-md-9">


<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <i class="fa fa-newspaper"></i> <?php echo lang("ctn_1003") ?></div>
    <div class="db-header-extra">
</div>
</div>
	

<div style="text-align: center;">
	<div class="row">
		<div class="col-md-5">
			<img style="width:100%; height:100%;" src="<?php echo $src; ?>">
		</div>
		<div class="col-md-9">
			
		</div>
	</div>
</div>














</div>

</div>
</div>
