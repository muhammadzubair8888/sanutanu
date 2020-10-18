<?php
  $ad = $this->home_model->get_random_ad_for_homepage();
  if($ad->num_rows() > 0) {
    $ad = $ad->row();
    // Reduce pageviews
    $this->home_model->decrease_ad_pageviews($ad->ID);
?>
<script type="text/javascript">
	$(document).ready(function(){
    $("#hidewhenaddshow").hide();
});
</script>
<div style="margin-top: 0px; border-radius: 0px;" class="page-block half-separator">
<div style="padding: 0px; border-radius: 0px;" class="page-block-page clearfix">
<!-- <?php echo $ad->advert ?>  -->
<div class="responsiveimage" style="width: 100%; height:300px;">
<img style="width: 100%;height: 100%; border-radius: 0px;" src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $ad->image; ?>" onclick="change_location('<?php echo $ad->link ?>')">
</div>
</div>
</div>
<?php
}


?>
<script>
	function change_location($link)
	{
		// window.location.href = 'http://stackoverflow.com';
		window.open($link, '_blank');
	}

</script>