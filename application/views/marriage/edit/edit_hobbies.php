<style type="text/css">
  .panelbodycustom{
    border:1px solid #DDD;
    padding: 10px;
  }
</style>
<div style="margin-top: 20px;" class="row">
  <div class="col-md-4">
    <?php include(APPPATH . "/views/marriage/sidebar.php"); ?>
  </div>
  <div class="col-md-8">
    <div style="box-shadow: 0 0 6px rgba(0,0,0,.2); border-radius: 10px; padding: 10px;">
      <?php include(APPPATH . "/views/marriage/profileinformation.php"); ?>
      <div style="background-color: #efefef; padding: 5px; color: #b14343; font-weight: bold; margin-bottom: 10px;">Update My  My Hobbies & Intrests</div>
      
      <div  class="panelbodycustom">
        <?php echo form_open_multipart(site_url("marriage/update_hobbies"), array("class" => "form-horizontal")) ?>
          <input type="hidden" value="<?php echo $marriageprofile->marriage_profile_id; ?>" name="marriage_profile_id">
         <div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
		            <div><b>Hobbies</b></div>
		            </div>
		            	<div class="row form-group">
		            		<div class="col-md-12 ">
		            			<div class="row">
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Acting" name="hobbies[]" <?php if($marriageprofile->hobies== "Acting")echo 'checked'; ?>> Acting
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Animalbreeding" name="hobbies[]" <?php if($marriageprofile->hobies== "Animalbreeding")echo 'checked'; ?>> Animal breeding
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Art/Handicraft" name="hobbies[]" <?php if($marriageprofile->hobies== "Art/Handicraft")echo 'checked'; ?>> Art / Handicraft
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="CollectingCoins" name="hobbies[]" <?php if($marriageprofile->hobies== "CollectingCoins")echo 'checked'; ?>> Collecting Coins
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="CollectingStamps" name="hobbies[]" <?php if($marriageprofile->hobies== "CollectingStamps")echo 'checked'; ?>> Collecting Stamps
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Cooking" name="hobbies[]" <?php if($marriageprofile->hobies== "Cooking")echo 'checked'; ?>> Cooking
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Dancing" name="hobbies[]" <?php if($marriageprofile->hobies== "Dancing")echo 'checked'; ?>> Dancing
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Film-making" name="hobbies[]" <?php if($marriageprofile->hobies== "Film-making")echo 'checked'; ?>> Film-makinghobies
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Fishing" name="hobbies[]" <?php if($marriageprofile->hobies== "Fishing")echo 'checked'; ?>> Fishing
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Gardening/Landscaping" name="hobbies[]" <?php if($marriageprofile->hobies== "Gardening/Landscaping")echo 'checked'; ?>> Gardening 
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Graphology" name="hobbies[]" <?php if($marriageprofile->hobies== "Graphology")echo 'checked'; ?>> Graphology
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Hamradio" name="hobbies[]" <?php if($marriageprofile->hobies== "Hamradio")echo 'checked'; ?>> Ham radio
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Interiordecoration" name="hobbies[]" <?php if($marriageprofile->hobies== "Interiordecoration")echo 'checked'; ?>> Interior decoration
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="LongDrives" name="hobbies[]" <?php if($marriageprofile->hobies== "LongDrives")echo 'checked'; ?>> Long Drives
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Modelbuilding" name="hobbies[]" <?php if($marriageprofile->hobies== "Modelbuilding")echo 'checked'; ?>> Model building
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Painting" name="hobbies[]" <?php if($marriageprofile->hobies== "Painting")echo 'checked'; ?>> Painting
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Photography" name="hobbies[]" <?php if($marriageprofile->hobies== "Photography")echo 'checked'; ?>> Photography
		            				</div>
		            				<div class="col-md-4  ">
		            					<input type="checkbox" value="Graphology" name="hobbies[]" <?php if($marriageprofile->hobies== "Graphology")echo 'checked'; ?>> Graphology
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
		            					<input type="checkbox" value="Alternative healing" name="intrests[]" <?php if($marriageprofile->intrests== "Alternative healing")echo 'checked'; ?>> Alternative healing
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Blogging" name="intrests[]" <?php if($marriageprofile->intrests== "Blogging")echo 'checked'; ?>> Blogging
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Health & Fitness" name="intrests[]" <?php if($marriageprofile->intrests== "Health & Fitness")echo 'checked'; ?>> Health & Fitness
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Learning" name="intrests[]" <?php if($marriageprofile->intrests== "Learning")echo 'checked'; ?>> Learning
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Listening to music" name="intrests[]" <?php if($marriageprofile->intrests== "Listening to music")echo 'checked'; ?>> Listening to music
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Motor Sport / Racing " name="intrests[]" <?php if($marriageprofile->intrests== "Motor Sport / Racing ")echo 'checked'; ?>> Motor Sport / Racing 
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Movies" name="intrests[]" <?php if($marriageprofile->intrests== "Movies")echo 'checked'; ?>> Movies
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Net surfing" name="intrests[]" <?php if($marriageprofile->intrests== "Net surfing")echo 'checked'; ?>> Net surfing
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Politics" name="intrests[]" <?php if($marriageprofile->intrests== "Politics")echo 'checked'; ?>> Politics
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Reading / Book clubs" name="intrests[]" <?php if($marriageprofile->intrests== "Reading / Book clubs")echo 'checked'; ?>> Reading / Book clubs
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Sports - Indoor" name="intrests[]" <?php if($marriageprofile->intrests== "Sports - Indoor")echo 'checked'; ?>> Sports - Indoor
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Sports - Outdoor" name="intrests[]" <?php if($marriageprofile->intrests== "Sports - Outdoor")echo 'checked'; ?>> Sports - Outdoor
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Theatre" name="intrests[]" <?php if($marriageprofile->intrests== "Theatre")echo 'checked'; ?>> Theatre
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Travel / Sightseeing" name="intrests[]" <?php if($marriageprofile->intrests== "Travel / Sightseeing")echo 'checked'; ?>> Travel / Sightseeing   
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Trekking / Adventure sports" name="intrests[]" <?php if($marriageprofile->intrests== "Trekking / Adventure sports")echo 'checked'; ?>> Adventure sports
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Computer games" name="intrests[]" <?php if($marriageprofile->intrests== "Computer games")echo 'checked'; ?>> Computer games
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Volunteering" name="intrests[]" <?php if($marriageprofile->intrests== "Volunteering")echo 'checked'; ?>> Volunteering
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Watching television" name="intrests[]" <?php if($marriageprofile->intrests== "Watching television")echo 'checked'; ?>> Watching television
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Writing" name="intrests[]" <?php if($marriageprofile->intrests== "Writing")echo 'checked'; ?>> Writing
		            				</div>
		            				<div class="col-md-4">
		            					<input type="checkbox" value="Yoga / Meditation" name="intrests[]" <?php if($marriageprofile->intrests== "Yoga / Meditation")echo 'checked'; ?>> Yoga / Meditation
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
		            					<input type="radio" value="Business casual - semi-formal" name="prefferddress" <?php if($marriageprofile->prefferddress== "Business casual - semi-formal")echo 'checked'; ?>> Business casual - semi-formal 
		            				</div>
		            				<div class="col-md-6">
		            					<input type="radio" value="Casual - usually in jeans and T-shirts" name="prefferddress" <?php if($marriageprofile->prefferddress== "Casual - usually in jeans and T-shirts")echo 'checked'; ?>>  Casual - usually in jeans and T-shirts
		            				</div>
		            				<div class="col-md-6">
		            					<input type="radio" value="Classic Indian - Indian formal wear" name="prefferddress" <?php if($marriageprofile->prefferddress== "Classic Indian - Indian formal wear")echo 'checked'; ?>> Classic Indian -  Indian formal wear
		            				</div>
		            				<div class="col-md-6">
		            					<input type="radio" value="Classic Western - western formal wear" name="prefferddress" <?php if($marriageprofile->prefferddress== "Classic Western - western formal wear")echo 'checked'; ?>>  Classic Western - western formal wear
		            				</div>
		            				<div class="col-md-6">
		            					<input type="radio" value="Designer - only leading brands will do" name="prefferddress" <?php if($marriageprofile->prefferddress== "Designer - only leading brands will do")echo 'checked'; ?>> Designer - only leading brands will do
		            				</div>
		            				<div class="col-md-6">
		            					<input type="radio" value="Trendy - in line with the latest fashion" name="prefferddress" <?php if($marriageprofile->prefferddress== "Trendy - in line with the latest fashion")echo 'checked'; ?>> Trendy - in line with the latest fashion
		            				</div>
		            			</div>
		            		</div>	            		
		            	</div>
        <div  id="updatebutton" class="row">
            <div style="text-align: right;" class="col-md-12">
              <button type="submit" class="btn btn-success">Update</button>
            </div>
              
          </div> 
          <?php echo form_close() ?>
      </div>           
  </div>
</div>
