<?php
  $ad = $this->home_model->get_random_ad_for_profile();
  if($ad->num_rows() > 0) {
    $ad = $ad->row();
    // Reduce pageviews
    $this->home_model->decrease_ad_pageviews($ad->ID);
?>
<a href="<?php echo $ad->link; ?>">
<div style="margin-top: 5px; border-radius: 0px;" class="page-block half-separator">
<div style="padding: 0px; border-radius: 0px;" class="page-block-page clearfix">
<!-- <?php echo $ad->advert ?>  -->
<div style="width: 100%; height:300px;">
<img style="width: 100%;height: 100%; border-radius: 0px;" src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $ad->image; ?>">
</div>
</div>
</div>
</a>
<?php
}
?>