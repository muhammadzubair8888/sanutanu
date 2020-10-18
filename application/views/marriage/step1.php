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
		}

		.form-control{ width: 100% !important;}
	}
</style>
<div class="row half-separator">
	<div class="col-md-2"></div>
	<div class="col-md-8 form-content-form">
		<div class="jsad_nsja">
			<div style="text-align: center;" class="row">
				<img style="width: 100%; height: 100%;" src="<?php echo base_url('uploads/') ?>createprofile1.jpg">
			</div>
			<?php echo form_open_multipart(site_url("marriage/insertprofile"), array("class" => "form-horizontal")) ?>
			<input type="hidden" name="profileid" value="<?php echo $profileid; ?>">
			<div class="form-top">
				<div class="form-top-left">
					<h3>Step 1</h3>
					<p style="color: red;">Create Profile</p>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-3 ">
					<label>Profile By:</label>
				</div>
				<div class="col-md-9 ">
					<select id="profileby" class="form-control" name="createdby">
						<option value="Self">Self</option>
						<option value="Parent">Parent</option>
						<option value="Guardian">Guardian</option>
						<option value="Friend">Friend</option>
						<option value="Sibling">Sibling</option>
						<option value="Son">Son</option>
						<option value="Daughter">Daughter</option>
						<option value="Relative">Relative</option>
					</select>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-3 ">
					<label>Name : </label>
				</div>
				<div class="col-md-9 ">
					<div class="row">
						<div class="col-xs-6">
							<input required="" type="text" placeholder="Enter First Name" class="form-control" name="first_name">
						</div>
						<div class="col-xs-6">
							<input required="" type="text" placeholder="Enter Last Name" class="form-control" name="last_name">
						</div>
					</div>
				</div>
			</div>
			<div id="selfgender" class="row form-group">
				<div class="col-md-3 ">
					<label>Gender : </label>
				</div>
				<div class="col-md-9 ">
					<div class="row">
						<div class="col-xs-6">
							<input required="" type="radio" value="Male" name="gender"> Male
						</div>
						<div class="col-xs-6">
							<input type="radio" value="FeMale" name="gender"> FeMale
						</div>
					</div>
				</div>
			</div>
			<div style="display: none;" id="othergender" class="row form-group">
				<div class="col-md-3 ">
					<label>Gender : </label>
				</div>
				<div class="col-md-9 ">
					<div class="row">
						<div class="col-md-6">
							<input type="radio" value="Male" name="gender"> Male
						</div>
						<div class="col-md-6">
							<input type="radio" value="FeMale" name="gender"> FeMale
						</div>
					</div>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-3 ">
					<label>Date of Birth : </label>
				</div>
				<div class="col-md-9 ">
					<div class="row">
						<div class="col-md-4">
							<select class="form-control" name="day" required="">
								<?php for ($i = 1; $i < 32; $i++) {  ?>
									<option value="<?php echo $i ?>"><?php echo $i ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-4">
							<select class="form-control" name="month">
								<?php foreach ($months as $m) : ?>
									<option value="<?php echo $m['value'] ?>"><?php echo $m['name'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col-md-4">
							<select class="form-control" name="year">
								<?php for ($i = 1950; $i < 2041; $i++) {  ?>
									<option value="<?php echo $i ?>"><?php echo $i ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-3 ">
					<label>Select Country : </label>
				</div>
				<div class="col-md-9 ">
					<select class="form-control" name="country" required="">
						<option value="">Select Country</option>
						<?php foreach ($countries->result() as $r) { ?>
							<option value="<?php echo $r->id ?>"><?php echo $r->name; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-3 ">
					<label>Enter City Name : </label>
				</div>
				<div class="col-md-9 ">
					<input type="text" name="city" class="form-control" required="">
				</div>
			</div>
			<!-- <div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Enter Number : </label>
		            		</div>
		            		<div class="col-md-9 ">
		            			<input type="text" placeholder="Enter Contact Number" name="contact"  class="form-control" required="">
		            		</div>		            		
		            	</div> -->
			<div class="row form-group">
				<div class="col-md-3 ">
					<label>Profile Image : </label>
				</div>
				<div class="col-md-9 ">
					<input type="file" name="image" id="image" style="height: 36px;" class="form-control">
				</div>
			</div>
			<div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
				<div><b>Basic Information</b></div>
			</div>

			<div class="row form-group">
				<div class="col-md-3 ">
					<label>Marital Status : </label>
				</div>
				<div class="col-md-9 ">
					<div class="row">
						<div class="col-md-4">
							<input type="radio" value="Singel" name="maritalstatus" required=""> Singel
						</div>
						<div class="col-md-4">
							<input type="radio" value="Divorced" name="maritalstatus"> Divorced
						</div>
						<div class="col-md-4">
							<input type="radio" value="Widowed" name="maritalstatus"> Widowed
						</div>
						<div class="col-md-4">
							<input type="radio" value="Separated" name="maritalstatus"> Separated
						</div>
						<div class="col-md-4">
							<input type="radio" value="Annulled" name="maritalstatus"> Annulled
						</div>
					</div>
				</div>
			</div>
			<script>
				$('input[type=radio][name=maritalstatus]').change(function() {
					if (this.value == 'Navermarried') {
						$('#havechildren').fadeOut('slow');
						$('#noofchildren').fadeOut('slow');
					} else if (this.value == 'Divorced') {
						$('#havechildren').fadeIn('slow');
						$('#noofchildren').fadeIn('slow');
					} else if (this.value == 'Widowed') {
						$('#havechildren').fadeIn('slow');
						$('#noofchildren').fadeIn('slow');
					} else if (this.value == 'Separated') {
						$('#havechildren').fadeIn('slow');
						$('#noofchildren').fadeIn('slow');
					} else if (this.value == 'Annulled') {
						$('#havechildren').fadeIn('slow');
						$('#noofchildren').fadeIn('slow');
					}
				});
			</script>
			<div style="display: none;" id="havechildren" class="row form-group">
				<div class="col-md-3 ">
					<label>Having Children : </label>
				</div>
				<div class="col-md-9 ">
					<div class="row">
						<div class="col-md-2">
							<input type="radio" value="No" name="havchildren"> No
						</div>
						<div class="col-md-5">
							<input type="radio" value="Yes. Living together" name="havchildren"> Yes. Living together
						</div>
						<div class="col-md-2">
							<input type="radio" value="Widowed" name="havchildren"> Yes
						</div>
					</div>
				</div>
			</div>
			<div style="display: none;" id="noofchildren" class="row form-group">
				<div class="col-md-3 ">
					<label>No Of Children : </label>
				</div>
				<div class="col-md-9 ">
					<div class="row">
						<div class="col-md-3"><label>Male</label></div>
						<div class="col-md-3">
							<select class="form-control" name="malechildren">
								<?php for ($i = 1; $i < 15; $i++) {  ?>
									<option value="<?php echo $i ?>"><?php echo $i ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-3"><label>FeMale</label></div>
						<div class="col-md-3">
							<select class="form-control" name="femalechildren">
								<?php for ($i = 1; $i < 15; $i++) {  ?>
									<option value="<?php echo $i ?>"><?php echo $i ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-3 ">
					<label>Height : </label>
				</div>
				<div class="col-md-9 ">
					<select name="height" class="form-control" required="">
						<option value="">Select Height</option>
						<option value="4ft 5in">4ft 5in - 134cm</option>
						<option value="4ft 6in">4ft 6in - 137cm</option>
						<option value="4ft 7in">4ft 7in - 139cm</option>
						<option value="4ft 8in">4ft 8in - 142cm</option>
						<option value="4ft 9in">4ft 9in - 144cm</option>
						<option value="4ft 10in">4ft 10in - 147cm</option>
						<option value="4ft 11in">4ft 11in - 149cm</option>
						<option value="5ft">5ft - 152cm</option>
						<option value="5ft 1in">5ft 1in - 154cm</option>
						<option value="5ft 2in">5ft 2in - 157cm</option>
						<option value="5ft 3in">5ft 3in - 160cm</option>
						<option value="5ft 4in">5ft 4in - 162cm</option>
						<option value="5ft 5in">5ft 5in - 165cm</option>
						<option value="5ft 6in">5ft 6in - 167cm</option>
						<option value="5ft 7in">5ft 7in - 170cm</option>
						<option value="5ft 8in">5ft 8in - 172cm</option>
						<option value="5ft 9in">5ft 9in - 175cm</option>
						<option value="5ft 10in">5ft 10in - 177cm</option>
						<option value="5ft 11in">5ft 11in - 180cm</option>
						<option value="6ft">6ft - 182cm</option>
						<option value="6ft 1in">6ft 1in - 185cm</option>
						<option value="6ft 2in">6ft 2in - 187cm</option>
						<option value="6ft 3in">6ft 3in - 190cm</option>
						<option value="6ft 4in">6ft 4in - 193cm</option>
						<option value="6ft 5in">6ft 5in - 195cm</option>
						<option value="6ft 6in">6ft 6in - 198cm</option>
						<option value="6ft 7in">6ft 7in - 200cm</option>
						<option value="6ft 8in">6ft 8in - 203cm</option>
						<option value="6ft 9in">6ft 9in - 205cm</option>
						<option value="6ft 10in">6ft 10in - 208cm</option>
						<option value="6ft 11in">6ft 11in - 210cm</option>
						<option value="7ft">7ft - 213cm</option>
					</select>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-3 ">
					<label>Weight : </label>
				</div>
				<div class="col-md-9 ">
					<select class="form-control" name="weight">
						<option value="">Select Weight</option>
						<?php for ($i = 30; $i < 201; $i++) {  ?>
							<option value="<?php echo $i ?>"><?php echo $i ?> KG</option>
						<?php } ?>
					</select>
				</div>
			</div>
			<!-- <div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Blood Group  : </label>
		            		</div>
		            		<div class="col-md-9 ">
								<select name="bloodgroup" class="form-control" >
									<option value="">Select Blood Group</option>
									<option value="A+">A+  (A positive)</option> 
									<option value="A-">A-  (A negative)</option> 
									<option value="B+">B+  (B positive)</option> 
									<option value="B-">B-  (B negative)</option> 
									<option value="AB+">AB+ (AB positive)</option> 
									<option value="AB-">AB- (AB negative)</option> 
									<option value="O+">O+  (O positive)</option>
									 <option value="O-">O-  (O negative)</option> 
								</select>
		            		</div>		            		
		            	</div> -->
			<!-- <div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Body type  : </label>
		            		</div>
		            		<div class="col-md-9 ">
		            			<div class="row">
		            				<div class="col-md-3">
		            					<input type="radio"  value="Slim" name="bodytype" > Slim
		            				</div>
		            				<div class="col-md-3">
		            					<input type="radio" value="Average"  name="bodytype"> Average
		            				</div>
		            				<div class="col-md-3">
		            					<input type="radio" value="Athletic"  name="bodytype"> Athletic
		            				</div>
		            				<div class="col-md-3">
		            					<input type="radio" value="Heavy"  name="bodytype"> Heavy
		            				</div>		            						            				
		            			</div>
		            		</div>		            		
		            	</div> -->
			<!-- <div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Complexion  : </label>
		            		</div>
		            		<div class="col-md-9 ">
		            			<div class="row">
		            				<div class="col-md-3">
		            					<input type="radio"  value="Very Fair" name="bodytypecomplexion" > Very Fair   
		            				</div>
		            				<div class="col-md-3">
		            					<input type="radio" value="Fair"  name="bodytypecomplexion"> Fair
		            				</div>
		            				<div class="col-md-5">
		            					<input type="radio" value="Wheatish Medium"  name="bodytypecomplexion"> Wheatish Medium   
		            				</div>
		            				<div class="col-md-4">
		            					<input type="radio" value="Wheatish Brown"  name="bodytypecomplexion"> Wheatish Brown  
		            				</div>
		            				<div class="col-md-4">
		            					<input type="radio" value="Wheatish Brown"  name="bodytypecomplexion"> Dark  
		            				</div>		            						            				
		            			</div>
		            		</div>		            		
		            	</div> -->
			<!-- <div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Special Cases   : </label>
		            		</div>
		            		<div class="col-md-9 ">
								<select name="special_cases" class="form-control">
									<option value="">Select Special Case</option>
									<option value="None">None</option> 
									<option value="Physically challenged from birth">Physically challenged from birth</option> 
									<option value="Physically challenged due to accident">Physically challenged due to accident</option> 
									<option value="Mentally challenged from birth">Mentally challenged from birth</option> 
									<option value="Mentally challenged due to accident">Mentally challenged due to accident</option> 
									<option value="Physically abnormality affecting only looks">Physical abnormality affecting only looks</option>
									<option value="Physical abnormality affecting bodily functions">Physical abnormality affecting bodily functions</option>
									<option value="Physically &amp; mentally challenged">Physically &amp; mentally challenged</option> 
									<option value="HIV positive">HIV positive</option> 
								</select>
		            		</div>		            		
		            	</div> -->
			<div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
				<div><b>Religious and Social Background</b></div>
			</div>
			<div class="row form-group">
				<div class="col-md-3 ">
					<label>Select Religion : </label>
				</div>
				<div class="col-md-9 ">
					<div class="row">
						<div class="col-md-6">
							<select id="religions" class="form-control" name="religion" required="">
								<option value="">Select Religion</option>
								<?php foreach ($religions->result() as $r) { ?>
									<option value="<?php echo $r->ID; ?>"><?php echo $r->name; ?></option>
								<?php } ?>
							</select>
						</div>
						<script>
							$("select[id='religions']").change(function() {
								var religion = $(this).val();
								if (religion == "") {
									$('select[id="state"]').empty();
								} else {
									$.ajax({
										type: 'GET',
										url: "<?php echo site_url('marriage/getcomunities/'); ?>" + religion,
										success: function(resp) {
											$("#showcomunity").fadeIn();
											$('select[id="comunity"]').html(resp);
										}
									});

								}
							});
						</script>
						<div id="showcomunity" style="display: none;" class="col-md-6">
							<select id="comunity" name="comunity" class="form-control">
							</select>
						</div>
					</div>
				</div>
			</div>

			<div class="row form-group">
				<div class="col-md-3 ">
					<label>Other Caste : </label>
				</div>
				<div class="col-md-9 ">
					<input type="text" class="form-control" name="othercaste">
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-3 ">
					<label>Mother Tongue : </label>
				</div>
				<div class="col-md-9 ">
					<select name="mother_tongue" class="form-control">
						<option value="">-Select-</option>
						<option value="Aka">Aka</option>
						<option value="Arabic">Arabic</option>
						<option value="Arunachali">Arunachali</option>
						<option value="Assamese">Assamese</option>
						<option value="Awadhi">Awadhi</option>
						<option value="Baluchi">Baluchi</option>
						<option value="Bengali">Bengali</option>
						<option value="Bhojpuri">Bhojpuri</option>
						<option value="Bhutia">Bhutia</option>
						<option value="Brahui">Brahui</option>
						<option value="Brij">Brij</option>
						<option value="Burmese">Burmese</option>
						<option value="Chattisgarhi">Chattisgarhi</option>
						<option value="Chinese">Chinese</option>
						<option value="Coorgi">Coorgi</option>
						<option value="Dogri">Dogri</option>
						<option value="English">English</option>
						<option value="French">French</option>
						<option value="Garhwali">Garhwali</option>
						<option value="Garo">Garo</option>
						<option value="Gujarati">Gujarati</option>
						<option value="Haryanavi">Haryanavi</option>
						<option value="Himachali/Pahari">Himachali/Pahari</option>
						<option value="Hindi">Hindi</option>
						<option value="Hindko">Hindko</option>
						<option value="Kakbarak">Kakbarak</option>
						<option value="Kanauji">Kanauji</option>
						<option value="Kannada">Kannada</option>
						<option value="Kashmiri">Kashmiri</option>
						<option value="Khandesi">Khandesi</option>
						<option value="Khasi">Khasi</option>
						<option value="Konkani">Konkani</option>
						<option value="Koshali">Koshali</option>
						<option value="Kumaoni">Kumaoni</option>
						<option value="Kutchi">Kutchi</option>
						<option value="Ladakhi">Ladakhi</option>
						<option value="Lepcha">Lepcha</option>
						<option value="Magahi">Magahi</option>
						<option value="Maithili">Maithili</option>
						<option value="Malay">Malay</option>
						<option value="Malayalam">Malayalam</option>
						<option value="Manipuri">Manipuri</option>
						<option value="Marathi">Marathi</option>
						<option value="Marwari">Marwari</option>
						<option value="Miji">Miji</option>
						<option value="Mizo">Mizo</option>
						<option value="Monpa">Monpa</option>
						<option value="Nepali">Nepali</option>
						<option value="Odia">Odia</option>
						<option value="Other">Other</option>
						<option value="Pashto">Pashto</option>
						<option value="Persian">Persian</option>
						<option value="Punjabi">Punjabi</option>
						<option value="Rajasthani">Rajasthani</option>
						<option value="Russian">Russian</option>
						<option value="Sanskrit">Sanskrit</option>
						<option value="Santhali">Santhali</option>
						<option value="Seraiki">Seraiki</option>
						<option value="Sindhi">Sindhi</option>
						<option value="Sinhala">Sinhala</option>
						<option value="Spanish">Spanish</option>
						<option value="Swedish">Swedish</option>
						<option value="Tagalog">Tagalog</option>
						<option value="Tamil">Tamil</option>
						<option value="Telugu">Telugu</option>
						<option value="Tulu">Tulu</option>
						<option value="Urdu">Urdu</option>
					</select>
				</div>
			</div>

			<div class="row form-group">
				<div class="col-md-3 ">
					<label>Faimly Values : </label>
				</div>
				<div class="col-md-9 ">
					<div class="row">
						<div class="col-md-4">
							<input type="radio" value="Traditional" name="family_values"> Traditional
						</div>
						<div class="col-md-4">
							<input type="radio" value="Moderate" name="family_values"> Moderate
						</div>
						<div class="col-md-4">
							<input type="radio" value="Librel" name="family_values"> Librel
						</div>
					</div>
				</div>
			</div>

			<div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
				<div><b>Horoscope Information</b></div>
			</div>
			<div class="row form-group">
				<div class="col-md-3 ">
					<label>Country Of Birth : </label>
				</div>
				<div class="col-md-9 ">
					<select id="countryofbirth" class="form-control" name="country_of_birth" required="">
						<option value="">Select Country</option>
						<?php foreach ($countries->result() as $r) { ?>
							<option value="<?php echo $r->id ?>"><?php echo $r->name; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<script>
				$("select[id='countryofbirth']").change(function() {
					var country_for_add_rotation = $(this).val();
					if (country_for_add_rotation == "") {
						$('select[id="state"]').empty();
					} else {

						$.ajax({
							type: 'GET',
							url: "<?php echo site_url('marriage/get_states_against_country_for_add_rotation/'); ?>" + country_for_add_rotation,
							success: function(state) {
								$("#showstate").fadeIn('slow');
								$('select[id="state"]').html(state);
							}
						});

					}
				});
			</script>
			<div style="display: none;" id="showstate" class="row form-group">
				<div class="col-md-3 ">
					<label>State Of Birth : </label>
				</div>
				<div class="col-md-9 ">
					<select id="state" name="state_of_birth" class="form-control">

					</select>
				</div>
			</div>
			<script>
				$("select[id='state']").change(function() {
					var state = $(this).val();
					if (state == "") {
						$('select[id="city"]').empty();
					} else {

						$.ajax({
							type: 'GET',
							url: "<?php echo site_url('marriage/get_city_against_country_for_add_rotation/'); ?>" + state,
							success: function(city) {
								$("#showcity").fadeIn();
								$('select[id="city"]').html(city);
							}
						});

					}
				});
			</script>
			<div style="display: none;" id="showcity" class="row form-group">
				<div class="col-md-3 ">
					<label>City Of Birth : </label>
				</div>
				<div class="col-md-9 ">
					<select id="city" name="city_of_birth" class="form-control" required="">

					</select>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-3 ">
					<label>Star : </label>
				</div>
				<div class="col-md-9 ">
					<!-- 	<select name="star" class="form-control">
									      <option value=" ">Select Star</option>
			                              <option value="Anuradha">Anuradha</option>
			                              <option value="Anuradha">Aries </option>
			                              <option value="Aswini">Aswini</option>
			                              <option value="Ashlisha">Ashlisha</option>
			                              <option value="Bahrani">Bahrani</option>
			                              <option value="Chitra">Chitra</option>
			                              <option value="Chitra">Cancer</option>
			                              <option value="Danistha">Danistha</option>
			                              <option value="Hanista">Hanista</option>
			                              <option value="Jasika">Jasika</option>
			                              <option value="Kythikta">Kythikta</option>
			                              <option value="Maka">Maka</option>
			                              <option value="Moal">Moal</option>
			                              <option value="Margasira">Margasira</option>
			                              <option value="Poorvabarhabula">Poorvabarhabula</option>
			                              <option value="PoorvaPalgunhi">PoorvaPalgunhi</option>
			                              <option value="poorvashada">poorvashada</option>
								</select> -->
					<select name="star" class="form-control">
						<option value=" ">Select Star</option>
						<option value="Aries">Aries</option>
						<option value="Taurus">Taurus</option>
						<option value="Gemini">Gemini </option>
						<option value="Cancer">Cancer</option>
						<option value="Leo">Leo </option>
						<option value="Virgo">Virgo</option>
						<option value="Libra">Libra</option>
						<option value="Scorpio">Scorpio</option>
						<option value="Sagittarius">Sagittarius</option>
						<option value="Capricorn">Capricorn</option>
						<option value="Aquarius">Aquarius</option>
						<option value="Pisces">Pisces</option>
					</select>
				</div>
			</div>
			<!-- <div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Raasi/Moon sign : </label>
		            		</div>
		            		<div class="col-md-9 ">
								<select name="moon_sign" class="form-control">
							              <option value="">Select Moon sign</option>
			                              <option value="Mesh">Mesh</option>
			                              <option value="Virshbah">Virshbah</option>
			                              <option value="Mithun">Mithun</option>
			                              <option value="Kark">Kark</option>
			                              <option value="Simha">Simha</option>
			                              <option value="Kanya">Kanya</option>
			                              <option value="Vrishchik">Vrishchik</option>
			                              <option value="Dhanu">Dhanu</option>
			                              <option value="Makhra">Makhra</option>
			                              <option value="Kumbh">Kumbh</option>
			                              <option value="Meen">Meen</option>
			                              <option value=">D'ont know">D'ont know</option>
								</select>
		            		</div>		            		
		            	</div> -->
			<!-- <div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Are you Manglik?  : </label>
		            		</div>
		            		<div class="col-md-9 ">
		            			<div class="row">
		            				<div class="col-md-2">
		            					<input type="radio" value="Traditional"  name="manglik" > Yes
		            				</div>
		            				<div class="col-md-2">
		            					<input type="radio" value="Moderate"  name="manglik"> No
		            				</div>
		            				<div class="col-md-4">
		            					<input type="radio" value="Librel"  name="manglik"> Don't Know
		            				</div>	
		            				<div class="col-md-4">
		            					<input type="radio" value="Librel"  name="manglik"> Not Applicable
		            				</div>		            						            				
		            			</div>
		            		</div>		            		
		            	</div> -->
			<!-- <div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
		            		<div><b>Education and Career</b></div>
		            	</div>
		            		<div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Education : </label>
		            		</div>
		            		<div class="col-md-9 ">
		            			<div class="row">
		            				<div class="col-md-5">
		            					<input type="text" class="form-control" placeholder="Bachelors" name="education_in" required="">
		            				</div>
		            				<div class="col-md-1"  style="margin-top: 8px;">IN</div>
		            				<div class="col-md-6">
										<input type="text" class="form-control" placeholder="Comupter Science" name="education_to" required="">
		            				</div>		            				
		            			</div>
		            		</div>	            		
		            	</div>
		            	<div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Education Description  : </label>
		            		</div>
		            		<div class="col-md-9 ">
								<textarea class="form-control" name="educational_description" ></textarea>
		            		</div>		            		
		            	</div>
		            	<div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Ocupation  : </label>
		            		</div>
		            		<div class="col-md-9 ">
								<input type="text" placeholder="IT Professional" class="form-control" name="ocupation" >
		            		</div>		            		
		            	</div>
		            	<div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Ocupation Description  : </label>
		            		</div>
		            		<div class="col-md-9 ">
								<textarea class="form-control" name="ocupation_description"></textarea>
		            		</div>		            		
		            	</div>
		            	<div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Assets  : </label>
		            		</div>
		            		<div class="col-md-9 ">
								<input type="text" class="form-control" name="assets">
		            		</div>		            		
		            	</div> -->
			<div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
				<div><b>Lifestyle</b></div>
			</div>
			<div class="row form-group">
				<div class="col-md-3 ">
					<label>Diet : </label>
				</div>
				<div class="col-md-9 ">
					<div class="row">
						<div class="col-md-2">
							<input type="radio" value="Veg" name="diet"> Veg
						</div>
						<div class="col-md-3">
							<input type="radio" value="Eggetarian" name="diet"> Eggetarian
						</div>
						<div class="col-md-3">
							<input type="radio" value="Non Veg" name="diet"> Non Veg
						</div>
						<div class="col-md-2">
							<input type="radio" value="Jain" name="diet"> Jain
						</div>
						<div class="col-md-4">
							<input type="radio" value="Vegan" name="diet"> Vegan
						</div>
					</div>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-3 ">
					<label>Smoke : </label>
				</div>
				<div class="col-md-9 ">
					<div class="row">
						<div class="col-md-2">
							<input type="radio" value="Yes" name="smoke"> Yes
						</div>
						<div class="col-md-2">
							<input type="radio" value="No" name="smoke"> No
						</div>
						<div class="col-md-4">
							<input type="radio" value="Occassionaly" name="smoke"> Occassionaly
						</div>
					</div>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-3 ">
					<label>Drink : </label>
				</div>
				<div class="col-md-9 ">
					<div class="row">
						<div class="col-md-2">
							<input type="radio" value="Yes" name="drink"> Yes
						</div>
						<div class="col-md-2">
							<input type="radio" value="No" name="drink"> No
						</div>
						<div class="col-md-4">
							<input type="radio" value="Occassionaly" name="drink"> Occassionaly
						</div>
					</div>
				</div>
			</div>

			<!-- <div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
		            		<div><b>Address Details</b></div>
		            	</div>
		            	<div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Country Of Resident : </label>
		            		</div>
		            		<div class="col-md-9 ">
		            			<select id="countryofresident" class="form-control" name="country_of_resedence" >
		            				<option value="">Select Country</option>
		            				<?php foreach ($countries->result() as $r) { ?>
		            					<option value="<?php echo $r->id ?>"><?php echo $r->name; ?></option>
		            				<?php } ?>
		            			</select>		            			
		            		</div>		            		
		            	</div>
			            <script>
			                $( "select[id='countryofresident']" ).change(function (){
			                    var country_for_add_rotation = $(this).val();
			                    if(country_for_add_rotation == "") {
			                        $('select[id="state"]').empty();
			                    }else{

			                      $.ajax({
			                            type: 'GET',
			                            url: "<?php echo site_url('marriage/get_states_against_country_for_add_rotation/'); ?>"+country_for_add_rotation,
			                            success: function(state) {
			                                $("#showstateresident").fadeIn('slow');
			                                $('select[id="stateresedence"]').html(state);
			                            }
			                        });
			                        
			                    }
			                });
			            </script>		            	
		            	<div style="display: none;" id="showstateresident" class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >State Of Resident   : </label>
		            		</div>
		            		<div class="col-md-9 ">
				                <select id="stateresedence" name="state_of_resedence" class="form-control" required="">

				                </select>
		            		</div>		            		
		            	</div>
			            <script>
			                $( "select[id='stateresedence']" ).change(function (){
			                    var state = $(this).val();
			                    if(state == "") {
			                        $('select[id="stateresedence"]').empty();
			                    }else{

			                      $.ajax({
			                            type: 'GET',
			                            url: "<?php echo site_url('marriage/get_city_against_country_for_add_rotation/'); ?>"+state,
			                            success: function(city) {
			                                $("#showcityresident").fadeIn();
			                                $('select[id="cityresident"]').html(city);
			                            }
			                        });
			                        
			                    }
			                });
			            </script>		            	
		            	<div style="display: none;" id="showcityresident" class="row form-group" >
		            		<div class="col-md-3 ">
		            			<label >City  Of Resident   : </label>
		            		</div>
		            		<div class="col-md-9 ">
				                <select id="cityresident" name="city_of_resedence" class="form-control">

				                </select>
		            		</div>		            		
		            	</div>		            	
		            	<div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Zip Code  : </label>
		            		</div>
		            		<div class="col-md-9 ">
								<input type="text" class="form-control" name="zip_code">
		            		</div>		            		
		            	</div>	
		            	<div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Address Line 1  : </label>
		            		</div>
		            		<div class="col-md-9 ">
								<input type="text" class="form-control" name="address_line_1" >
		            		</div>		            		
		            	</div>
		            	<div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Address Line 2  : </label>
		            		</div>
		            		<div class="col-md-9 ">
								<input type="text" class="form-control" name="address_line_2">
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