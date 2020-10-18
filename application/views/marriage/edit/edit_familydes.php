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
      <div style="background-color: #efefef; padding: 5px; color: #b14343; font-weight: bold; margin-bottom: 10px;">Update  My Family Background</div

      <div  class="panelbodycustom">
        <?php echo form_open_multipart(site_url("marriage/updatefamilydescription"), array("class" => "form-horizontal")) ?>
          <input type="hidden" value="<?php echo $marriageprofile->marriage_profile_id; ?>" name="marriage_profile_id">
          
         <div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
		            <div><b>Use this space to write about your family e.g., whether joint or not, number of members, cultural values, overall approach to life and so on. </b></div>
		            </div>
               <div class="row form-group">
	            		<div class="col-md-12">
	            			<textarea required="" name="describefamily"  class="form-control" rows="8" value="<?php echo $marriageprofile->describefamily ?>"><?php echo $marriageprofile->describefamily ?></textarea> 
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
