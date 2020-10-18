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
					<img style="width: 100%; height: 100%;" src="<?php echo base_url('uploads/') ?>createprofile4.jpg">
			</div>
			<?php echo form_open_multipart(site_url("marriage/step4"), array("class" => "form-horizontal")) ?>
				<input type="hidden" name="profileid" value="<?php echo $profileid; ?>">
		        	<div class="form-top">
		        		<div class="form-top-left">
		        			<h3>Step 4</h3>
		        			<p style="color: red;">Add your Hobbies, Interests, and more...</p>
		        		</div>
		            </div>
		            <div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
		            <div><b>Hobbies</b></div>
		            </div>
		            	<div class="row form-group">
		            		<div class="col-md-12 ">
		            			<div class="row">
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Acting" name="hobbies[]" required=""> Acting
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Animal breeding" name="hobbies[]"> Animal breeding
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Art / Handicraft" name="hobbies[]"> Art / Handicraft
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Collecting Coins" name="hobbies[]"> Collecting Coins
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Collecting Stamps" name="hobbies[]"> Collecting Stamps
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Cooking" name="hobbies[]"> Cooking
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Dancing" name="hobbies[]"> Dancing
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Film-making" name="hobbies[]"> Film-making
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Fishing" name="hobbies[]"> Fishing
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Gardening / Landscaping" name="hobbies[]"> Gardening 
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Graphology" name="hobbies[]"> Graphology
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Ham radio" name="hobbies[]"> Ham radio
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Interior decoration" name="hobbies[]"> Interior decoration
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Long Drives" name="hobbies[]"> Long Drives
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Model building" name="hobbies[]"> Model building
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Painting" name="hobbies[]"> Painting
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Photography" name="hobbies[]"> Photography
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Graphology" name="hobbies[]"> Graphology
		            				</div>
		            			</div>
		            		</div>	            		
		            	</div>
		            	<div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
			            <div><b>Intrests</b></div>
			            </div>
		            	<div class="row form-group">
		            		<div class="col-md-12 ">
		            			<div class="row">
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Alternative healing" name="intrests[]" required=""> Alternative healing
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Blogging" name="intrests[]"> Blogging
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Health & Fitness" name="intrests[]"> Health & Fitness
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Learning" name="intrests[]"> Learning
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Listening to music" name="intrests[]"> Listening to music
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Motor Sport / Racing " name="intrests[]"> Motor Sport / Racing 
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Movies" name="intrests[]"> Movies
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Net surfing" name="intrests[]"> Net surfing
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Politics" name="intrests[]"> Politics
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Reading / Book clubs" name="intrests[]"> Reading / Book clubs
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Sports - Indoor" name="intrests[]"> Sports - Indoor
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Sports - Outdoor" name="intrests[]"> Sports - Outdoor
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Theatre" name="intrests[]"> Theatre
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Travel / Sightseeing" name="intrests[]"> Travel / Sightseeing   
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Trekking / Adventure sports" name="intrests[]"> Adventure sports
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Computer games" name="intrests[]"> Computer games
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Volunteering" name="intrests[]"> Volunteering
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Watching television" name="intrests[]"> Watching television
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Writing" name="intrests[]"> Writing
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Yoga / Meditation" name="intrests[]"> Yoga / Meditation
		            				</div>
		            			</div>
		            		</div>	            		
		            	</div>
		            	<div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
			            <div><b>Preferred dress style </b></div>
			            </div>
			            <div class="row form-group">
		            		<div class="col-md-12 ">
		            			<div class="row">
		            				<div class="col-md-6">
		            					<input type="radio" value="Business casual - semi-formal" name="prefferddress" required=""> Business casual - semi-formal 
		            				</div>
		            				<div class="col-md-6">
		            					<input type="radio" value="Casual - usually in jeans and T-shirts" name="prefferddress">  Casual - usually in jeans and T-shirts
		            				</div>
		            				<div class="col-md-6">
		            					<input type="radio" value="Classic Indian - Indian formal wear" name="prefferddress"> Classic Indian -  Indian formal wear
		            				</div>
		            				<div class="col-md-6">
		            					<input type="radio" value="Classic Western - western formal wear" name="prefferddress">  Classic Western - western formal wear
		            				</div>
		            				<div class="col-md-6">
		            					<input type="radio" value="Designer - only leading brands will do" name="prefferddress"> Designer - only leading brands will do
		            				</div>
		            				<div class="col-md-6">
		            					<input type="radio" value="Trendy - in line with the latest fashion" name="prefferddress"> Trendy - in line with the latest fashion
		            				</div>
		            			</div>
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