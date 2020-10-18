<div style="margin-top: 20px;" class="row">
	<div class="col-md-4">
		<?php include(APPPATH . "/views/marriage/sidebar.php"); ?>
	</div>
	<div class="col-md-8">
		<div style="box-shadow: 0 0 6px rgba(0,0,0,.2); border-radius: 10px; padding: 10px;">
			<p>All Photos Record of  (Profile ID : <b><?php echo $marriageprofile->marriage_profile_id ?></b> )</p> 
			<div class="row">
				<?php foreach ($allfavourities->result() as $f) { ?>
				<div style="margin-top: 20px;" class="col-md-4">
					<div style="border:1px solid #DDD">
						<div style="width: 100%; height: 200px;">
							<img style="width: 100%;height: 100%;" src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->marriage_model->get_marriage_profile($f->formmarriageprofile)->row()->profileimage ?>">
						</div>
						<div style="padding: 10px; text-align: center;">
							<a href="<?php echo site_url('marriage/view/'.$f->formmarriageprofile) ?>"><?php echo $this->marriage_model->get_marriage_profile($f->formmarriageprofile)->row()->first_name." ".$this->marriage_model->get_marriage_profile($f->formmarriageprofile)->row()->last_name ?></a>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>