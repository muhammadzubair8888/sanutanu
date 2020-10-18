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
      <div style="background-color: #efefef; padding: 5px; color: #b14343; font-weight: bold; margin-bottom: 10px;">UpdateMy Location and Contact Details</div>
      <div  class="panelbodycustom">
        <?php echo form_open_multipart(site_url("marriage/updatelocation"), array("class" => "form-horizontal")) ?>
          <input type="hidden" value="<?php echo $marriageprofile->marriage_profile_id; ?>" name="marriage_profile_id">
       <!-- <div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
                    <div><b>Address Details</b></div>
                  </div> -->
                  <div class="row form-group">
                    <div class="col-md-3 ">
                      <label >Country Of Resident : </label>
                    </div>
                    <div class="col-md-9 ">
                      <select id="countryofresident" class="form-control" name="country_of_resedence">
                        <option value="">Select Country</option>
                          <?php foreach ($countries->result() as $r) { ?>
                          <option value="<?php  echo $r->id?>" <?php if($marriageprofile->country==$r->id)echo 'selected'; ?>><?php echo $r->name; ?></option>
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
                                  url: "<?php echo site_url('admin/get_states_against_country_for_add_rotation/'); ?>"+country_for_add_rotation,
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
                        <select id="stateresedence" name="state_of_resedence" class="form-control" value="<?php echo $marriageprofile->state_of_resedence ?>">

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
                                  url: "<?php echo site_url('admin/get_city_against_country_for_add_rotation/'); ?>"+state,
                                  success: function(city) {
                                      $("#showcityresident").fadeIn();
                                      $('select[id="cityresident"]').html(city);
                                  }
                              });
                              
                          }
                      });
                  </script>
                      <div style="display: none;" id="showcityresident" class="row form-group">
                    <div class="col-md-3 ">
                      <label >City  Of Resident   : </label>
                    </div>
                    <div class="col-md-9 ">
                        <select id="cityresident" name="city_of_resedence" class="form-control" >

                        </select>
                    </div>                    
                  </div>  

                  <div class="row form-group">
                    <div class="col-md-3 ">
                      <label >Zip Code  : </label>
                    </div>
                    <div class="col-md-9 ">
                <input type="text" class="form-control"  value="<?php echo $marriageprofile->zip_code ?>" name="zip_code">
                    </div>                    
                  </div>  
                  <div class="row form-group">
                    <div class="col-md-3 ">
                      <label >Address Line 1  : </label>
                    </div>
                    <div class="col-md-9 ">
                <input type="text" class="form-control" value="<?php echo $marriageprofile->address_line_1 ?>" name="address_line_1">
                    </div>                    
                  </div>
                  <div class="row form-group">
                    <div class="col-md-3 ">
                      <label >Address Line 2  : </label>
                    </div>
                    <div class="col-md-9 ">
                <input type="text" class="form-control" value="<?php echo $marriageprofile->address_line_2 ?>" name="address_line_2">
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
