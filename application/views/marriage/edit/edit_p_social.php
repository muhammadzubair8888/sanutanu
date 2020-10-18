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
      <div style="background-color: #efefef; padding: 5px; color: #b14343; font-weight: bold; margin-bottom: 10px;">Update Partner's Religious & Social Background</div>
      <div  class="panelbodycustom">
        <?php echo form_open_multipart(site_url("marriage/update_P_social"), array("class" => "form-horizontal")) ?>
          <input type="hidden" value="<?php echo $marriageprofile->marriage_profile_id; ?>" name="marriage_profile_id">
          <div class="row form-group">
                    <div class="col-md-3 ">
                      <label >Select Religion : </label>
                    </div>
                    <div class="col-md-9 ">
                      <div class="row">
                        <div class="col-md-6">
                          <select id="religions" class="form-control" name="religion"  >
                            <option value="">Select Religion</option>
                            <?php foreach ($religions->result() as $r) { ?>
                              <option value="<?php echo $r->ID; ?>" <?php if($patnerprofile->relijion==$r->ID)echo 'selected'; ?> ><?php echo $r->name; ?></option>
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
                            <select id="comunity" name="comunity" class="form-control">
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
                          <input type="radio" value="Doesnt Matter"  name="familyvalues" <?php if($patnerprofile->familyvalues== "Doesnt Matter")echo 'checked'; ?>> Doesn't Matter
                        </div>
                        <div class="col-md-4">
                          <input type="radio" value="Traditional"  name="familyvalues" <?php if($patnerprofile->familyvalues== "Traditional")echo 'checked'; ?>> Traditional
                        </div>
                        <div class="col-md-3">
                          <input type="radio" value="Moderate"  name="familyvalues" <?php if($patnerprofile->familyvalues== "Moderate")echo 'checked'; ?>> Moderate
                        </div>
                        <div class="col-md-3">
                          <input type="radio" value="Librel"  name="familyvalues" <?php if($patnerprofile->familyvalues== "Librel")echo 'checked'; ?>> Librel
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
