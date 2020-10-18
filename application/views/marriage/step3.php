<style type="text/css">
	.jsad_nsja {
		display: block;
		color: #201f1f;
		box-shadow: 0 0 6px rgba(0, 0, 0, .2);
		padding: 15px 15px;
		border-radius: 5px;
		background-color: white;
		-webkit-border-radius: 5px;
	}

	.roundcircleborder {
		border: 1px solid #DDD;
		height: 112.984px;
		border-radius: 50%;
	}

	.form-top-left {
		margin-bottom: 30px;
	}

	label {
		font-weight: 600;
	}

	@media screen and (max-width: 1024px) {
		.form-content-form {
			width: 100vw !important;
			padding-right: 10vw;
		}

		.form-control {
			width: 100% !important;
		}

		.t-area
		{
			padding-left: 15px !important;
			padding-right: 15px !important;
		}
	}
</style>
<div class="row half-separator">
	<div class="col-md-2"></div>
	<div class="col-md-8 form-content-form">
		<div class="jsad_nsja">
			<div style="text-align: center;" class="row">
				<img style="width: 100%; height: 100%;" src="<?php echo base_url('uploads/') ?>createprofile 3.jpg">
			</div>
			<?php echo form_open_multipart(site_url("marriage/step3"), array("class" => "form-horizontal")) ?>
			<input type="hidden" name="profileid" value="<?php echo $profileid; ?>">
			<div class="form-top">
				<div class="form-top-left">
					<h3>Step 3</h3>
					<p style="color: red;">More About Yourself</p>
				</div>
			</div>
			<div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
				<label>Use this space to describe your personality, life goals, expectations from marriage-any such information which your prospective partner will find useful. </label>
			</div>
			<div class="row form-group">
				<div class="col-md-12 t-area">
					<textarea required="" name="describepersonality" class="form-control" rows="8" style="min-height: 60px;"></textarea>
				</div>
			</div>
			<!-- <div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
		            <div><b>Family Details</b><small style="color: red;"> [ Visible Only You ]</small></div>
		            </div>	            			            		
	            	<div class="row form-group">
	            		<div class="col-md-3 ">
	            			<label >Family Status : </label>
	            		</div>
	            		<div class="col-md-9 ">
	            			<div class="row">
	            				<div class="col-md-4">
	            					<input type="radio"  value="Middle Class" name="familystatus" required=""> Middle Class
	            				</div>
	            				<div class="col-md-4">
	            					<input type="radio" value="Upper Middle Class"  name="familystatus" required=""> Upper Middle Class
	            				</div>
	            				<div class="col-md-4">
	            					<input type="radio" value="Rich/Affluent"  name="familystatus" required=""> Rich/Affluent
	            				</div>		            				
	            			</div>
	            		</div>		            		
	            	</div>
	            	<div class="row form-group">
	            		<div class="col-md-3 ">
	            			<label >Father Name: </label>
	            		</div>
	            		<div class="col-md-9 ">
							<input type="text" class="form-control" name="fathername" required="">
	            		</div>		            		
	            	</div>
	            	<div class="row form-group">
	            		<div class="col-md-3 ">
	            			<label >Father Occupation: </label>
	            		</div>
	            		<div class="col-md-9 ">
							<select name="father_occup"  class="form-control" required="">
							    <option value="">-Select-</option>
								<option value="Employed">Employed</option>
							 	<option value="Business">Business</option>
							 	<option value="Professional">Professional</option> 
							    <option value="Retired">Retired</option> 
							    <option value="Not Employed">Not Employed</option> 
							</select>
	            		</div>		            		
	            	</div>
	            	<div class="row form-group">
	            		<div class="col-md-3 ">
	            			<label >Mother Name: </label>
	            		</div>
	            		<div class="col-md-9 ">
							<input type="text" class="form-control" name="mothername" required="">
	            		</div>		            		
	            	</div>
	            	<div class="row form-group">
	            		<div class="col-md-3 ">
	            			<label >Mother Occupation: </label>
	            		</div>
	            		<div class="col-md-9 ">
							<select name="mother_occup"  class="form-control" required="">
							    <option value="">-Select-</option>
							    <option value="HouseWife">HouseWife</option>
								<option value="Employed">Employed</option>
							 	<option value="Business">Business</option>
							 	<option value="Professional">Professional</option> 
							    <option value="Retired">Retired</option> 
							    <option value="Not Employed">Not Employed</option> 
							</select>
	            		</div>		            		
	            	</div>
	            	<div class="row form-group">
	            		<div class="col-md-3 ">
	            			<label>Have Brothers : </label>
	            		</div>
	            		<div class="col-md-9 ">
	            			<div class="row">
	            				<div class="col-md-4">
	            					<input type="radio"  value="Yes" name="havebrothers"> Yes
	            				</div>
	            				<div class="col-md-4">
	            					<input type="radio" value="No"  name="havebrothers"> No
	            				</div>		            				
	            			</div>
	            		</div>		            		
	            	</div>
	            	<script>
						$('input[type=radio][name=havebrothers]').change(function() {
						    if (this.value == 'No') {
						        $('#noofsiblings').fadeOut('slow');
						    }
						    else if (this.value == 'Yes') {
						        $('#noofsiblings').fadeIn('slow');
						    }
						});
					</script>
					<div style="display: none;" id="noofsiblings" class="row form-group">
	            		<div class="col-md-3 ">
	            			<label >Marital Status  : </label>
	            		</div>
	            		<div class="col-md-9 ">
	            			<div class="row">
	            				<div class="col-md-3"><label>Married</label></div>
	            				<div class="col-md-3">
	            					<select class="form-control" name="marriedbrother">
	            						<?php for ($i = 0; $i < 15; $i++) {  ?>
	            						<option value="<?php echo $i ?>"><?php echo $i ?></option>
	            					 	<?php } ?>
	            					</select>
	            				</div>
	            				<div class="col-md-3"><label>Unmaried</label></div>
	            				<div class="col-md-3">
	            					<select class="form-control" name="unmarriedbrother">
	            						<?php for ($i = 0; $i < 15; $i++) {  ?>
	            						<option value="<?php echo $i ?>"><?php echo $i ?></option>
	            					 	<?php } ?>
	            					</select>
	            				</div>		            				
	            			</div>
	            		</div>		            		
	            	</div>
	            	<div class="row form-group">
	            		<div class="col-md-3 ">
	            			<label>Have Sisters : </label>
	            		</div>
	            		<div class="col-md-9 ">
	            			<div class="row">
	            				<div class="col-md-4">
	            					<input type="radio"  value="Yes" name="havesisters"> Yes
	            				</div>
	            				<div class="col-md-4">
	            					<input type="radio" value="No"  name="havesisters"> No
	            				</div>		            				
	            			</div>
	            		</div>		            		
	            	</div>
	            	<script>
						$('input[type=radio][name=havesisters]').change(function() {
						    if (this.value == 'No') {
						        $('#sistersmaritalstatus').fadeOut('slow');
						    }
						    else if (this.value == 'Yes') {
						        $('#sistersmaritalstatus').fadeIn('slow');
						    }
						});
					</script>
					<div style="display: none;" id="sistersmaritalstatus" class="row form-group">
	            		<div class="col-md-3 ">
	            			<label >Marital Status  : </label>
	            		</div>
	            		<div class="col-md-9 ">
	            			<div class="row">
	            				<div class="col-md-3"><label>Married</label></div>
	            				<div class="col-md-3">
	            					<select class="form-control" name="marriedsister">
	            						<?php for ($i = 0; $i < 15; $i++) {  ?>
	            						<option value="<?php echo $i ?>"><?php echo $i ?></option>
	            					 	<?php } ?>
	            					</select>
	            				</div>
	            				<div class="col-md-3"><label>Unmaried</label></div>
	            				<div class="col-md-3">
	            					<select class="form-control" name="unmarriedsister">
	            						<?php for ($i = 0; $i < 15; $i++) {  ?>
	            						<option value="<?php echo $i ?>"><?php echo $i ?></option>
	            					 	<?php } ?>
	            					</select>
	            				</div>		            				
	            			</div>
	            		</div>		            		
	            	</div>
	            	<div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
		            <div><b>Use this space to write about your family e.g., whether joint or not, number of members, cultural values, overall approach to life and so on. </b></div>
		            </div>
		            <div class="row form-group">
	            		<div class="col-md-12">
	            			<textarea required="" name="describefamily" class="form-control" rows="8"></textarea> 
	            		</div>    		
	            	</div> -->
			<div style="text-align: right;">
				<button type="submit" class="btn btn-success">Submit</button>
			</div>
			<?php echo form_close() ?>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>