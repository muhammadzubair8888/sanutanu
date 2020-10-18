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
      <div style="background-color: #efefef; padding: 5px; color: #b14343; font-weight: bold; margin-bottom: 10px;">Update Partner's Lifestyle</div>
      <div  class="panelbodycustom">
        <?php echo form_open_multipart(site_url("marriage/update_p_lifestyle"), array("class" => "form-horizontal")) ?>
          <input type="hidden" value="<?php echo $marriageprofile->marriage_profile_id; ?>" name="marriage_profile_id">
          <div class="row form-group">
                    <div class="col-md-3 ">
                      <label >Diet  : </label>
                    </div>
                    <div class="col-md-9 ">
                      <div class="row">
                        <div class="col-md-2">
                          <input type="radio" value="Veg"  name="diet" <?php if($patnerprofile->diet== "Veg")echo 'checked'; ?>> Veg
                        </div>
                        <div class="col-md-3">
                          <input type="radio" value="Eggetarian"  name="diet" <?php if($patnerprofile->diet== "Eggetarian")echo 'checked'; ?>> Eggetarian
                        </div>
                        <div class="col-md-3">
                          <input type="radio" value="Non Veg"  name="diet" <?php if($patnerprofile->diet== "Non Veg")echo 'checked'; ?>> Non Veg
                        </div>  
                        <div class="col-md-2">
                          <input type="radio" value="Jain"  name="diet" <?php if($patnerprofile->diet== "Jain")echo 'checked'; ?>> Jain
                        </div>
                        <div class="col-md-4">
                          <input type="radio" value="Vegan"  name="diet" <?php if($patnerprofile->diet== "Vegan")echo 'checked'; ?>>  Vegan
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
                          <input type="radio" value="Yes"  name="smoke" <?php if($patnerprofile->smoke== "Yes")echo 'checked'; ?>> Yes
                        </div>
                        <div class="col-md-2">
                          <input type="radio" value="No"  name="smoke" <?php if($patnerprofile->smoke== "No")echo 'checked'; ?>> No
                        </div>
                        <div class="col-md-4">
                          <input type="radio" value="Occassionaly"  name="smoke" <?php if($patnerprofile->smoke== "Occassionaly")echo 'checked'; ?>> Occassionaly
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
                          <input type="radio" value="Yes"  name="drink" <?php if($patnerprofile->drink== "Yes")echo 'checked'; ?>> Yes
                        </div>
                        <div class="col-md-2">
                          <input type="radio" value="No"  name="drink" <?php if($patnerprofile->drink== "No")echo 'checked'; ?>> No
                        </div>
                        <div class="col-md-4">
                          <input type="radio" value="Occassionaly"  name="drink" <?php if($patnerprofile->drink== "Occassionaly")echo 'checked'; ?>> Occassionaly
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
