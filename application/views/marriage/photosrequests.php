<div style="margin-top: 20px;" class="row">
	<div class="col-md-4">
		<?php include(APPPATH . "/views/marriage/sidebar.php"); ?>
	</div>
	<div class="col-md-8">
		<div style="box-shadow: 0 0 6px rgba(0,0,0,.2); border-radius: 10px; padding: 10px;">
			<p>All Request of  (Profile ID : <b><?php echo $marriageprofile->marriage_profile_id ?></b> )</p> 
			<table class="table table-bordered">
				<tr>
					<th>From</th>
					<th>Status</th>
					<th>Name</th>
					<th>Action</th>
				</tr>
				<tbody>
					<?php foreach ($requests->result() as $r) { ?>			
					<tr>
						<td><a target="_blank" href="<?php echo site_url('marriage/view/').$r->from_marriage_profile_id; ?>"><?php echo $r->from_marriage_profile_id; ?></a></td>
						<td style="text-align: center;"><?php if($r->status == 0){ echo "<span class='label label-danger'>Not Sended</span>";}else{echo "<span class='label label-success'> Sended</span>";} ?></td>
						<td><?php echo $r->name; ?></td>
						<td> <?php if($r->status == 0) { if($r->name == 'Photos'){ ?> <button onclick="viewmessage(<?php echo $r->ID; ?>)" class="btn btn-success btn-xs">View</button><?php }else{?> <button onclick="viewmessagecontact(<?php echo $r->ID; ?>)" class="btn btn-success btn-xs">View</button><?php } } ?> </td>
					</tr>
					<?php } ?>
				</tbody>
			</table>			
		</div>
		<div id="showsendphotos" style="display: none; margin-top: 20px; box-shadow: 0 0 6px rgba(0,0,0,.2); border-radius: 10px; padding: 10px;">
			<?php echo form_open_multipart(site_url("marriage/sendphotos"), array("class" => "form-horizontal")) ?>
			<p style="font-weight: bold;">Message</p>
			<p id="showmessage"></p>
			<p style="font-weight: bold;">Send Photos</p>
			<div style="margin-top: 10px; margin-bottom: 20px;">
				<input required="" type="file" name="image" id="image" style="height: 36px;"  class="form-control">
				<input type="hidden" id="showtoprofileid" name="toprofileid">
				<input type="hidden" id="showfromprofileid" name="fromprofileid">
				<input type="hidden" id="showrequestid" name="requestid">
			</div>
			<div style="margin-top: 10px; margin-bottom: 10px;">
				<textarea required="" name="message" placeholder="Type any Message here............." class="form-control" rows="5"></textarea>
			</div>
			<div style="margin-top: 10px;">
				<button class="btn btn-primary" type="submit">Send Photos</button>
			</div>
			<?php echo form_close() ?>					
		</div>
		<div id="showsendcontactdetails" style="display: none; margin-top: 20px; box-shadow: 0 0 6px rgba(0,0,0,.2); border-radius: 10px; padding: 10px;">
			<?php echo form_open_multipart(site_url("marriage/sendcontact"), array("class" => "form-horizontal")) ?>
			<p style="font-weight: bold;">Message</p>
			<p id="showmessagecontact"></p>
			<p style="font-weight: bold;">Send Contact Details</p>
			<div style="margin-top: 10px; margin-bottom: 20px;">
				<input required="" placeholder="Enter Contact Number....." type="text" name="contactnumber"  class="form-control">
				<input type="hidden" id="showtoprofileidcontact" name="toprofileid">
				<input type="hidden" id="showfromprofileidcontact" name="fromprofileid">
				<input type="hidden" id="showrequestidcontact" name="requestid">
			</div>
			<div style="margin-top: 10px; margin-bottom: 10px;">
				<input type="text" class="form-control" name="address" placeholder="Enter Address">
			</div>
			<div style="margin-top: 10px; margin-bottom: 10px;">
				<textarea name="message" placeholder="Type any Message here............." class="form-control" rows="5"></textarea>
			</div>
			<div style="margin-top: 10px;">
				<button class="btn btn-primary" type="submit">Send Contact Details</button>
			</div>
			<?php echo form_close() ?>					
		</div>
	</div>
</div>
<script type="text/javascript">
	function viewmessage(id)
	{
		$.ajax({ 
	      url: '<?php echo site_url('marriage/getsinglerequests/'); ?>',
	      type: 'POST',
	      dataType: "json",
		  data: { profileid : id},
	      success: function(resp){
	      	$('#showsendcontactdetails').hide();
      		$('#showsendphotos').fadeIn();
			$('#showrequestid').val(resp.ID);
			$('#showid').html(resp.from_marriage_profile_id);
			$('#showmessage').html(resp.message);
			$('#showtoprofileid').val(resp.to_marriage_profile_id);
			$('#showfromprofileid').val(resp.from_marriage_profile_id);
	      }
	    });
	}
	function viewmessagecontact(id)
	{
		$.ajax({ 
	      url: '<?php echo site_url('marriage/getsinglerequests/'); ?>',
	      type: 'POST',
	      dataType: "json",
		  data: { profileid : id},
	      success: function(resp){
      		$('#showsendphotos').hide();
      		$('#showsendcontactdetails').fadeIn();
			$('#showrequestidcontact').val(resp.ID);
			$('#showidcontact').html(resp.from_marriage_profile_id);
			$('#showmessagecontact').html(resp.message);
			$('#showtoprofileidcontact').val(resp.to_marriage_profile_id);
			$('#showfromprofileidcontact').val(resp.from_marriage_profile_id);
	      }
	    });
	}
</script>