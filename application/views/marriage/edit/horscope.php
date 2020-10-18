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
      <div style="background-color: #efefef; padding: 5px; color: #b14343; font-weight: bold; margin-bottom: 10px;">Update My Horoscope Information</div>
      <div  class="panelbodycustom">
        <?php echo form_open_multipart(site_url("marriage/updatehorscope"), array("class" => "form-horizontal")) ?>
          <input type="hidden" value="<?php echo $marriageprofile->marriage_profile_id; ?>" name="marriage_profile_id">
        <div class="row form-group">
                    <div class="col-md-3 ">
                      <label >Country Of Birth: </label>
                    </div>
                    <div class="col-md-9 ">
                      <select id="countryofbirth" class="form-control" name="country_of_birth">
                        <option value="">Select Country</option>
                        <?php foreach ($countries->result() as $r) { ?>
                          <option value="<?php  echo $r->id?>" ><?php echo $r->name; ?></option>
                        <?php } ?>

                      </select>                     
                    </div>                    
                  </div>
                  <script>
                      $( "select[id='countryofbirth']" ).change(function (){
                          var country_for_add_rotation = $(this).val();
                          if(country_for_add_rotation == "") {
                              $('select[id="state"]').empty();
                          }else{

                            $.ajax({
                                  type: 'GET',
                                  url: "<?php echo site_url('admin/get_states_against_country_for_add_rotation/'); ?>"+country_for_add_rotation,
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
                      <label >State Of Birth: </label>
                    </div>
                    <div class="col-md-9 ">
                        <select id="state" name="state_of_birth" class="form-control">

                        </select>
                    </div>                    
                  </div>
                  <script>
                      $( "select[id='state']" ).change(function (){
                          var state = $(this).val();
                          if(state == "") {
                              $('select[id="city"]').empty();
                          }else{

                            $.ajax({
                                  type: 'GET',
                                  url: "<?php echo site_url('admin/get_city_against_country_for_add_rotation/'); ?>"+state,
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
                      <label >City  Of Birth: </label>
                    </div>
                    <div class="col-md-9 ">
                        <select id="city" name="city_of_birth" class="form-control">

                        </select>
                    </div>                    
                  </div>
                  <div class="row form-group">
                    <div class="col-md-3 ">
                      <label >Star : </label>
                    </div>
                    <div class="col-md-9 ">
                     <select name="star" class="form-control">
                        <option value=" ">Select Star</option>
                        <?php  foreach ($star as $r) { ?>
                       <option value="<?php echo $r['value'] ?>" <?php if($marriageprofile->star==$r['value'])echo 'selected'; ?> ><?php echo $r['name'] ?></option>
                       <?php } ?>
                     </select>
                    </div>                    
                  </div>
                  <div class="row form-group">
                    <div class="col-md-3 ">
                      <label >Raasi/Moon sign: </label>
                    </div>
                    <div class="col-md-9 ">
                    <select name="moon_sign" class="form-control">
                    <option value="">Select Moon sign</option>
                    <?php  foreach ($moon_sign   as $r) { ?>
                    <option value="<?php echo $r['value'] ?>" <?php if($marriageprofile->moon_sign  ==$r['value'])echo 'selected'; ?> ><?php echo $r['name'] ?></option>
                    <?php } ?>   
                     </select>
                    </div>                    
                  </div>
                  <div class="row form-group">
                    <div class="col-md-3 ">
                      <label >Are you Manglik? </label>
                    </div>
                    <div class="col-md-9 ">
                      <div class="row">
                        <div class="col-md-2">
                          <input type="radio" value="Yes"  name="manglik" <?php if($marriageprofile->manglink== "Yes")echo 'checked'; ?>> Yes
                        </div>
                        <div class="col-md-2">
                          <input type="radio" value="No"  name="manglik" <?php if($marriageprofile->manglink== "No")echo 'checked'; ?> > No
                        </div>
                        <div class="col-md-4">
                          <input type="radio" value="dont_know"  name="manglik" <?php if($marriageprofile->manglink== "dont_know")echo 'checked'; ?>> Don't Know
                        </div>  
                        <div class="col-md-4">
                          <input type="radio" value="not_aaplicable"  name="manglik" <?php if($marriageprofile->manglink== "not_aaplicable")echo 'checked'; ?>> Not Applicable
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
