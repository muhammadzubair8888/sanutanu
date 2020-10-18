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
      <div style="background-color: #efefef; padding: 5px; color: #b14343; font-weight: bold; margin-bottom: 10px;">Update Partner's Location</div>
      <div  class="panelbodycustom">
        <?php echo form_open_multipart(site_url("marriage/update_p_location"), array("class" => "form-horizontal")) ?>
          <input type="hidden" value="<?php echo $marriageprofile->marriage_profile_id; ?>" name="marriage_profile_id">
         <div class="row form-group">
                    <div class="col-md-3 ">
                      <label >Country: </label>
                    </div>
                    <div class="col-md-9 ">
                      <select id="countryofresident" class="form-control" name="country">
                        <option value="">Select Country</option>
                        <?php foreach ($countries->result() as $r) { ?>
                          <option value="<?php  echo $r->id?>"><?php echo $r->name; ?></option>
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
                  <div  id="showstateresident" class="row form-group">
                    <div class="col-md-3 ">
                      <label >State : </label>
                    </div>
                    <div class="col-md-9 ">
                       <input class="form-control" type="text" placeholder="Optional" name="state" value="<?php echo $patnerprofile->statename ?>">
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
                  <div  id="showcityresident" class="row form-group">
                    <div class="col-md-3 ">
                      <label >City : </label>
                    </div>
                    <div class="col-md-9 ">
                        <input class="form-control" type="text" placeholder="Optional" name="city" value="<?php echo $patnerprofile->cityname ?>">
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
