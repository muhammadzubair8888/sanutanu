<style type="text/css">
	.selectasdasd {
  border-radius: 0;
  cursor: pointer;
  font-size: 18px;
  width: 20%;
  padding: 3px;
</style>
<div class="row">
	<div class="col-md-3">
		<img style="width: 100%;height: 100%;" src="http://192.168.10.102/sanutanu/uploads/7b287d01a491176a923915265ad9f973.gif">
	</div>
	<div class="col-md-9">
		<div >
		<div style="background-color: #dddddd;  padding: 20px; border:1px solid #DDD;border-radius: 5px;">
			<div>
				<div style="margin-bottom: 20px;"><img src="https://www.re-marriage.in/images/qs-title.gif"></div>
			</div>
			<div class="row form-group">
				<div style="margin-top: 8px;" class="col-md-3">
					<label>Looking For</label>
				</div>
				<div class="col-md-3">
					<select id="looking" class="form-control">
						<option value="">Select</option>
						<option value="male">Groom</option>
						<option value="female">Bride</option>
					</select>
				</div>
				<div style="margin-top: 8px;" class="col-md-3">
					<input id="withphoto" type="checkbox" name="withphoto"><label style="padding-left: 10px;">With Photo</label> 
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-3">
					<label>Age From</label>
				</div>
				<div class="col-md-3">
					<select id="agefrom" class="form-control" name="selectasdasd">
						<?php for ($i=18; $i < 101 ; $i++) {  ?>
						<option value="<?php echo $i ?>"><?php echo $i ?></option>
					 	<?php } ?>
					</select>
				</div>
				<div style="margin-top: 8px;" class="col-md-1">
					<label>TO</label>
				</div>
				<div class="col-md-3">
					<select id="ageto" class="form-control" name="selectasdasd">
						<?php for ($i=18; $i < 101 ; $i++) {  ?>
						<option value="<?php echo $i ?>"><?php echo $i ?></option>
					 	<?php } ?>
					</select>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-3">
					<label>Religion</label>
				</div>
				<div class="col-md-3">
					<select id="religions" class="form-control" name="selectasdasd">
						<option value="">Select Religion</option>
						<?php foreach($religions->result() as $r) {  ?>
						<option value="<?php echo $r->ID ?>"><?php echo $r->name; ?></option>
					 	<?php } ?>
					</select>
				</div>
				<div class="col-md-1"></div>
				<div style="display: none;" id="showcomunity" class="col-md-3">
					<select id="comunity" name="comunity" class="form-control">
					</select>
				</div>
			</div>
			<script>
                $( "select[id='religions']" ).change(function (){
                    var religion = $(this).val();
                    if(religion == "") {
                        $("#showcomunity").fadeOut();
                    }else{
                      $.ajax({
                            type: 'GET',
                            url: "<?php echo site_url('marriage/getcomunities/'); ?>"+religion,
                            success: function(resp) {
                                $("#showcomunity").fadeIn();
                                $('select[id="comunity"]').html(resp);
                            }
                        });
                        
                    }
                });
            </script>
			<div class="row form-group">
				<div class="col-md-3">
					<label>Country</label>
				</div>
				<div class="col-md-7">
					<select id="country" name="country" class="form-control">
						<option value="">Select Country</option>
						<?php foreach($country as $r) {  ?>
						<option value="<?php echo $r->id ?>"><?php echo $r->name; ?></option>
					 	<?php } ?>
					</select>
				</div>
				<div class="col-md-2">
					<input onclick="quicksearch()" type="submit" class="btn btn-success" value="GO" name="">
				</div>
			</div>	
			<hr>

			<div class="row form-group">
				<div style="margin-top: 8px;" class="col-md-3">
					<label>Smart Search</label>
				</div>
				<div class="col-md-7">
					<input id="searchbyid" type="text" placeholder="Search By Profile ID" class="form-control" name="">
				</div>
				<div class="col-md-2">
					<input onclick="searchbyid()" type="submit" class="btn btn-success" value="GO" name="">
				</div>
			</div>	

		</div>
		</div>
	</div>
</div>
<style type="text/css">
	.bordercolorchange{
		border-color: red;
	}
</style>
<script type="text/javascript">
	function searchbyid(){
		var id  = $('#searchbyid').val();
		if (id === "") {
			$('#searchbyid').addClass('bordercolorchange');
		}else{
		    $.ajax({ 
		      url: '<?php echo site_url('marriage/getmemberprofilesbysearchid/'); ?>'+id,
		      type: 'GET',
		      success: function(resp){
		      	$('#changetext').html(' <b>Your Searched </b><b>'+id+'</b>');
		      	$('#hidenewstprofiles').hide();
		      	$('#showprofiles').html(resp);
		      }
		    });
		}
	}
	function quicksearch(){
		var looking  = $('#looking').val();
		var withphoto  = $('#withphoto').prop("checked");
		var agefrom  = $('#agefrom').val();
		var ageto  = $('#ageto').val();
		var comunity  = $('#comunity').val();
		var religions  = $('#religions').val();
		var country  = $('#country').val();
		if (looking === "") {
			$('#looking').addClass('bordercolorchange');
		}else{
		    $.ajax({
		      url: '<?php echo site_url('marriage/quicksearch/'); ?>',
		      type: 'POST',
		      data: { look : looking, photo : withphoto, agefrom : agefrom, ageto : ageto, religions : religions,comunity : comunity, country : country},
		      success: function(resp){
		      	$('.loadmorebtn').hide();
		      	$('#changetext').hide();
		      	$('#hidenewstprofiles').hide();
		      	$('#showprofiles').html(resp);
		      }
		    });
		}
	}
</script>
<div style="margin-top: 20px;border: 1px solid #DDD;padding: 10px;background-color: #dddddd;border-radius: 10px;">
	<div id="changetext" style="font-weight: bold;font-size: 20px;">Latest Profiles</div>
</div>
<div id="showprofiles" style="" class="row">
	
</div>


<div id="hidenewstprofiles" class="row" style=" display: flex; flex-wrap: wrap;">
	<?php foreach ($newprofiles->result() as $r) { ?>
		<div style="margin-top: 20px;" class="col-md-6 sfjksdfsidfhn">
		<div style="border: 1px solid #DDD; border-radius: 2px;">
			<div class="row">
				<div class="col-md-5">
					<div style="width: 100%; border-right: 1px solid #DDD;">
						<img style="width: 100%;height: 170px; object-fit: contain;" src="<?php  echo base_url() ?><?php echo $this->settings->info->upload_path_relative.'/'.$r->profileimage ?>">
					</div>
				</div>
				<div class="col-md-7">
					<div style="margin-left: 10px; padding: 10px;">
						<div >
							<b style="color: red;">Profile ID:</b><span style="padding-left: 20px; color: red;"><?php echo $r->marriage_profile_id ?></span>
						</div>
						<div >
							<b >Profile By:</b><span style="padding-left: 20px;"><a target="_blank" href="<?php echo site_url('marriage/profile/').$this->marriage_model->getuser($r->users_id)->row()->username ?>"><?php echo $this->marriage_model->getuser($r->users_id)->row()->first_name; ?> <?php echo $this->marriage_model->getuser($r->users_id)->row()->last_name; ?></a></span>
						</div>
						<div>
							<b>Name:</b><span style="padding-left: 35px;"><?php echo $r->first_name.' '.$r->last_name ?> </span>
						</div>
						<div >
							<b>Age:</b><span style="padding-left: 50px;"><?php echo $r->age ?> Years</span>
						</div>
						<div >
							<b>Religion:</b><span style="padding-left: 20px;"><?php if (!empty($r->relegion)) { echo $this->marriage_model->getreligionname($r->relegion)->row()->name; }else{echo " N/A ";} ?></span>
						</div>
						<div >
							<b>Country:</b><span style="padding-left: 20px;"><?php if (!empty($r->country)) {
							 echo $this->marriage_model->getcountryname($r->country)->row()->name; }else{echo " N/A ";} ?></span>
						</div>
						<div style="text-align: right;" >
							<a class="btn btn-success" href="<?php echo site_url('marriage/view/').$r->marriage_profile_id; ?>">View</a>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>

</div>
	<div class="loadmorebtn" style="text-align: center; margin-top: 20px; margin-bottom: 100px;">
		<input type="hidden" id="pagevalue">
		<button id="loadmorebutton" onclick="loadmore()"  class="btn btn-primary btn-lg">Load More</button>
	</div>


<script type="text/javascript">
	function loadmore()
	{
		var pagenumber = $("#pagevalue").val();
		if(pagenumber == ""){
			var pageno = 1;
			$("#pagevalue").val(pageno);
		}else{
			var page = $("#pagevalue").val()*1;
			var pageno = page+1;
			$("#pagevalue").val(pageno);
		}
		$('#loadmorebutton').html('Loading.......')
	 $.ajax({
	      url: '<?php echo site_url('marriage/loadmoreprofiles/'); ?>',
	      type: 'POST',
	      data: {pagenumber : pageno, '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
	      success: function(resp){
	      	setTimeout(function(){
	      		$('#loadmorebutton').html('Load More')
	      		$('#hidenewstprofiles').append(resp);
	      		var count = $('.sfjksdfsidfhn').length;
	      		var rows = <?php echo $numberofrows; ?>;
	      		if(count>=rows)
	      		{
	      			$('.loadmorebtn').hide();
	      		}
	      	}, 2000);
	      }
	    });
	}
</script>
