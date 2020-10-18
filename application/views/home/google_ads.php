<!-- Hi i'm an advert -->
 <?php //echo form_open(site_url("admin/edit_rotation_ad_pro"), array("class" => "form-horizontal")) ?>
 <?php 
 if($this->home_model->get_random_ad()>0)
 {
 	$ad = $this->home_model->get_random_ad()->row();
 	$image = $ad->image;
 }
 else
 {
 	$image = 'ad.jpg';
 }
 
 ?>
<img src="<?php echo base_url() ?>uploads/<?php echo $image; ?>" style="width: 100%; height: 100%; border-radius: 1rem;" />