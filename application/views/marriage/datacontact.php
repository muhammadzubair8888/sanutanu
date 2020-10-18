<div style="margin-top: 20px;" class="row">
	<div class="col-md-4 col-xs-4">
		<?php include(APPPATH . "/views/marriage/sidebar.php"); ?>
	</div>
	<div class="col-md-8 col-xs-8">
		<div style="box-shadow: 0 0 6px rgba(0,0,0,.2); border-radius: 10px; padding: 10px;">
			<p>All Contact Record of  (Profile ID : <b><?php echo $marriageprofile->marriage_profile_id ?></b> )</p> 
			<table class="table table-bordered">
				<tr>
					<th>From</th>
					<th>Action</th>
				</tr>
				<tbody>
					<?php foreach ($allcontacts->result() as $p) { ?>				
					<tr>
						<td><a target="_blank" href="<?php echo site_url('marriage/view/').$p->frommarriageid ?>"><?php echo $this->marriage_model->get_marriage_profile($p->frommarriageid)->row()->first_name." ".$this->marriage_model->get_marriage_profile($p->frommarriageid)->row()->last_name; ?></a></td>
						<td style="text-align: center;"><button onclick="viewcontact(<?php echo $p->ID; ?>)" class="btn btn-success btn-xs">View</button></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>			
		</div>

		<div  id="showsendcontactdetails" style="margin-top: 20px; display: none; box-shadow: 0 0 6px rgba(0,0,0,.2); border-radius: 10px; padding: 10px;">
			 		
			 		<div> <b>Contact Number : </b> <span id="contactnumber"></span></div>
			 		<div> <b>Address : </b> <span id="address"></span></div>
			 		<div> <b>Message : </b> <span id="message"></span></div>
		</div>

	</div>
</div>
<script type="text/javascript">
	function viewcontact(id)
	{
		$.ajax({ 
	      url: '<?php echo site_url('marriage/getsinglecontact/'); ?>',
	      type: 'POST',
	      dataType: "json",
		  data: { id : id},
	      success: function(resp){
      		$('#showsendcontactdetails').fadeIn();
			$('#contactnumber').html(resp.contactnumber);
			$('#address').html(resp.address);
			$('#message').html(resp.message);
	      }
	    });
	}
</script>