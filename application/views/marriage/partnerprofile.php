<style type="text/css">
	.jsad_nsja{
		display: block;
	    color: #201f1f;
	    box-shadow: 0 0 6px rgba(0,0,0,.2);
	    padding: 15px 15px;
	    border-radius: 5px;
	    background-color: white;
	    -webkit-border-radius: 5px;
	}
	.roundcircleborder{
		border: 1px solid #DDD;
		height: 112.984px;
		border-radius: 50%;
	}
	.form-top-left{
		margin-bottom: 30px;
	}
	label{
		font-weight: 600;
	}
</style>
<div class="row half-separator">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="jsad_nsja">
			<div style="text-align: center;" class="row">
					
			</div>
			<?php echo form_open_multipart(site_url("marriage/partnerprofile"), array("class" => "form-horizontal")) ?>
				<input type="hidden" name="profileid" value="<?php echo $profileid; ?>">
		        	<div class="form-top">
		        		<div class="form-top-left">
		        			<h3 style="color: red;">Create Partner Profile</h3>
		        			<p>Let visitors to your profile know about your expectations from your partner. Creating partner profile helps you use Re-marriage eMatch (two way matchmaking) service to provide you with matches of people who meet your partner profile and whose partner profile you meet.</p>
		        			<div style="background-color: #F0F0F0; border-radius: 5px;padding: 5px;">
		        				<b style="color: #990000;">Note</b>
		        				<div style="padding: 5px;">
		        					<p>- All visitors viewing your profile will also be able to view your partner profile.</p>
		        					<p>- You can update your partner profile at any time.</p>
		        				</div>
		        			</div>
		        		</div>
		            </div>
		            <div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
		            <div><b>Partner's - Basic Information</b></div>
		            </div>	            	
		            	<div  class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Gender: </label>
		            		</div>
		            		<div class="col-md-9 ">
		            			<div class="row">
		            				<div class="col-md-3">
		            					<input type="radio"  name="gender" required=""> Male
		            				</div>
		            				<div class="col-md-3">
		            					<input type="radio" name="gender"> Female
		            				</div>
		            			</div>
		            		</div>
		            	</div>
		            	<div  class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Age Range: </label>
		            		</div>
		            		<div class="col-md-9 ">
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>From</label>
		            				</div>
		            				<div class="col-md-3">
		            					<select class="form-control" name="yearfrom" required="">
		            						<?php for ($i=18; $i < 101 ; $i++) {  ?>
		            						<option value="<?php echo $i ?>"><?php echo $i ?></option>
		            					 	<?php } ?>
		            					</select>
		            				</div>
		            				<div class="col-md-1">
		            					<label>To</label>
		            				</div>
		            				<div class="col-md-3">
		            					<select class="form-control" name="yearto">
		            						<?php for ($i=18; $i < 101 ; $i++) {  ?>
		            						<option value="<?php echo $i ?>"><?php echo $i ?></option>
		            					 	<?php } ?>
		            					</select>
		            				</div>
		            			</div>
		            		</div>
		            	</div>		            			            		
		            	<div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label>Marital Status : </label>
		            		</div>
		            		<div class="col-md-9 ">
		            			<div class="row">
		            				<div class="col-md-4">
		            					<input type="radio"  value="Navermarried" name="maritalstatus" required=""> Navermarried
		            				</div>
		            				<div class="col-md-4">
		            					<input type="radio" value="Divorced"  name="maritalstatus"> Divorced
		            				</div>
		            				<div class="col-md-4">
		            					<input type="radio" value="Widowed"  name="maritalstatus"> Widowed
		            				</div>
		            				<div class="col-md-4">
		            					<input type="radio" value="Separated"  name="maritalstatus"> Separated
		            				</div>
		            				<div class="col-md-4">
		            					<input type="radio" value="Annulled"  name="maritalstatus"> Annulled
		            				</div>		            				
		            			</div>
		            		</div>		            		
		            	</div>
		            	<script>
							$('input[type=radio][name=maritalstatus]').change(function() {
							    if (this.value == 'Navermarried') {
							        $('#havechildren').fadeOut('slow');
							    }
							    else if (this.value == 'Divorced') {
							        $('#havechildren').fadeIn('slow');
							    }
							    else if (this.value == 'Widowed') {
							        $('#havechildren').fadeIn('slow');
							    }
							    else if (this.value == 'Separated') {
							        $('#havechildren').fadeIn('slow');
							    }
							    else if (this.value == 'Annulled') {
							        $('#havechildren').fadeIn('slow');
							    }
							});
						</script>
		            	<div style="display: none;" id="havechildren" class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Having Children  : </label>
		            		</div>
		            		<div class="col-md-9 ">
		            			<div class="row">
		            				<div class="col-md-2">
		            					<input type="radio"  value="No" name="havchildren"> No
		            				</div>
		            				<div class="col-md-5">
		            					<input type="radio" value="Yes. Living together"  name="havchildren"> Yes. Living together
		            				</div>
		            				<div class="col-md-2">
		            					<input type="radio" value="Widowed"  name="havchildren"> Yes
		            				</div>		            				
		            			</div>
		            		</div>		            		
		            	</div>
		            	<div  class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Height: </label>
		            		</div>
		            		<div class="col-md-9 ">
		            			<div class="row">
		            				<div class="col-md-1">
		            					<label>From</label>
		            				</div>
		            				<div class="col-md-5">
		            					<select name="heightfrom" class="form-control" required="">
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
		            				<div class="col-md-1">
		            					<label>To</label>
		            				</div>
		            				<div class="col-md-5">
		            					<select name="heightto" class="form-control">
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
		            		</div>
		            	</div>
		            	<div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Body type  : </label>
		            		</div>
		            		<div class="col-md-9 ">
		            			<div class="row">
		            				<div class="col-md-3">
		            					<input type="radio"  value="Slim" name="bodytype" required=""> Slim
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
		            	</div>
		            	<div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Complexion  : </label>
		            		</div>
		            		<div class="col-md-9 ">
		            			<div class="row">
		            				<div class="col-md-3">
		            					<input type="radio"  value="Very Fair" name="bodytypecomplexion" required=""> Very Fair   
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
		            	</div>
		            	<div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Special Cases  : </label>
		            		</div>
		            		<div class="col-md-9 ">
		            			<div class="row">
		            				<div class="col-md-3">
		            					<input type="radio"  value="Yes" name="specialcases" required=""> Yes   
		            				</div>
		            				<div class="col-md-3">
		            					<input type="radio" value="No"  name="specialcases"> No
		            				</div>
		            				<div class="col-md-5">
		            					<input type="radio" value="Does't Matter "  name="specialcases"> Does't Matter   
		            				</div>		            						            				
		            			</div>
		            		</div>		            		
		            	</div>
		            	<div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
			            <div><b>Partner's Religious & Social Background </b></div>
			            </div>
			            <div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Select Religion : </label>
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
					                $( "select[id='religions']" ).change(function (){
					                    var religion = $(this).val();
					                    if(religion == "") {
					                        $('select[id="state"]').empty();
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
						            <div id="showcomunity" style="display: none;" class="col-md-6">
						                <select id="comunity" name="comunity" class="form-control" required="">
						                </select>
						            </div>		            					            				
		            			</div>
		            		</div>		            		
		            	</div>
		            	<div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Faimly Values  : </label>
		            		</div>
		            		<div class="col-md-9 ">
		            			<div class="row">
		            				<div class="col-md-4">
		            					<input type="radio" value="Doesn't Matter"  name="family_values" required=""> Doesn't Matter
		            				</div>
		            				<div class="col-md-4">
		            					<input type="radio" value="Traditional"  name="family_values"> Traditional
		            				</div>
		            				<div class="col-md-3">
		            					<input type="radio" value="Moderate"  name="family_values"> Moderate
		            				</div>
		            				<div class="col-md-3">
		            					<input type="radio" value="Librel"  name="family_values"> Librel
		            				</div>		            						            				
		            			</div>
		            		</div>		            		
		            	</div>
		            	<div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
		            		<div><b>Partner's Education & Career</b></div>
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
		            			<label >Ocupation  : </label>
		            		</div>
		            		<div class="col-md-9 ">
								<input type="text" placeholder="IT Professional" class="form-control" name="ocupation">
		            		</div>		            		
		            	</div>
		            	<div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
		            		<div><b>Partner's Lifestyle</b></div>
		            	</div>
		            	<div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Diet  : </label>
		            		</div>
		            		<div class="col-md-9 ">
		            			<div class="row">
		            				<div class="col-md-2">
		            					<input type="radio" value="Veg"  name="diet" required=""> Veg
		            				</div>
		            				<div class="col-md-3">
		            					<input type="radio" value="Eggetarian"  name="diet"> Eggetarian
		            				</div>
		            				<div class="col-md-3">
		            					<input type="radio" value="Non Veg"  name="diet"> Non Veg
		            				</div>	
		            				<div class="col-md-2">
		            					<input type="radio" value="Jain"  name="diet"> Jain
		            				</div>
		            				<div class="col-md-4">
		            					<input type="radio" value="Vegan"  name="diet"> Vegan
		            				</div>     						            				
		            			</div>
		            		</div>		            		
		            	</div>
		            	
		            	<div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Smoke  : </label>
		            		</div>
		            		<div class="col-md-9 ">
		            			<div class="row">
		            				<div class="col-md-2">
		            					<input type="radio" value="Yes"  name="smoke" required=""> Yes
		            				</div>
		            				<div class="col-md-2">
		            					<input type="radio" value="No"  name="smoke"> No
		            				</div>
		            				<div class="col-md-4">
		            					<input type="radio" value="Occassionaly"  name="smoke"> Occassionaly
		            				</div>	    						            				
		            			</div>
		            		</div>		            		
		            	</div>
		            	<div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Drink  : </label>
		            		</div>
		            		<div class="col-md-9 ">
		            			<div class="row">
		            				<div class="col-md-2">
		            					<input type="radio" value="Yes"  name="drink" required=""> Yes
		            				</div>
		            				<div class="col-md-2">
		            					<input type="radio" value="No"  name="drink"> No
		            				</div>
		            				<div class="col-md-4">
		            					<input type="radio" value="Occassionaly"  name="drink"> Occassionaly
		            				</div>	    						            				
		            			</div>
		            		</div>		            		
		            	</div>
		            	<div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
		            		<div><b>Partner's Location</b></div>
		            	</div>
		            	<div class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >Country: </label>
		            		</div>
		            		<div class="col-md-9 ">
		            			<select id="countryofresident" class="form-control" name="country" required="">
		            				<option value="">Select Country</option>
		            				<?php foreach ($countries->result() as $r) { ?>
		            					<option value="<?php echo $r->name; ?>"><?php echo $r->name; ?></option>
		            				<?php } ?>
		            			</select>		            			
		            		</div>		            		
		            	</div>		            	
		            	<div  id="showstateresident" class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >State : </label>
		            		</div>
		            		<div class="col-md-9 ">
				               <input class="form-control" type="text" placeholder="Optional" name="state" required="">
		            		</div>		            		
		            	</div>		            	
		            	<div  id="showcityresident" class="row form-group">
		            		<div class="col-md-3 ">
		            			<label >City : </label>
		            		</div>
		            		<div class="col-md-9 ">
				                <input class="form-control" type="text" placeholder="Optional" name="city" required="">
		            		</div>		            		
		            	</div>			            	
		               	<div style="text-align: right;">
		            		<button type="submit" class="btn btn-success">Submit</button>
		            	</div>	
    		<?php echo form_close() ?>
		</div>
	</div>
	<div class="col-md-2"></div>			
</div>