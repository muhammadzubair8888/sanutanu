<div style="margin-top: 20px;" class="row">
	<div class="col-md-4">
		<?php include(APPPATH . "/views/marriage/sidebar.php"); ?>
	</div>
	<div class="col-md-8">
		<div style="box-shadow: 0 0 6px rgba(0,0,0,.2); border-radius: 10px; padding: 10px;">
			<p>All Photos Record of  (Profile ID : <b><?php echo $marriageprofile->marriage_profile_id ?></b> )</p> 
			<table class="table table-bordered">
				<tr>
					<th>From</th>
					<th>Action</th>
				</tr>
				<tbody>
					<?php foreach ($allphotos->result() as $p) { ?>				
					<tr>
						<td><a target="_blank" href="<?php echo site_url('marriage/view/').$p->frommarriageid ?>"><?php echo $this->marriage_model->get_marriage_profile($p->frommarriageid)->row()->first_name." ".$this->marriage_model->get_marriage_profile($p->frommarriageid)->row()->last_name; ?></a></td>
						<td style="text-align: center;"><a target="_blank" href="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $p->image ?>"><button class="btn btn-success btn-xs">View</button></a></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>			
		</div>
	</div>
</div>