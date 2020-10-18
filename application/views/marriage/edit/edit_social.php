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
    <div style="background-color: #efefef; padding: 5px; color: #b14343; font-weight: bold; margin-bottom: 10px;">Update My Religious & Social Background</div>
      <div  class="panelbodycustom">
        <?php echo form_open_multipart(site_url("marriage/updatemysocial"), array("class" => "form-horizontal")) ?>
          <input type="hidden" value="<?php echo $marriageprofile->marriage_profile_id; ?>" name="marriage_profile_id">
          <div class="row form-group">
                    <div class="col-md-3 ">
                      <label >Select Religion : </label>
                    </div>
                    <div class="col-md-9 ">
                      <div class="row">
                        <div class="col-md-6">
                          <select id="religions" class="form-control" name="religion">
                            <option value="">Select Religion</option>
                            <?php foreach ($religions->result() as $r) { ?>
                              <option value="<?php echo $r->ID; ?>" <?php if($marriageprofile->relegion==$r->ID)echo 'selected'; ?>><?php echo $r->name; ?></option>
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
                                        $('#hidecomunity').hide();
                                          $("#showcomunity").show();
                                          $('select[id="comunity"]').html(resp);
                                      }
                                  });
                                  
                              }
                          });
                      </script>
                      <div id="hidecomunity" class="col-md-6">
                          <select class="form-control">
                            <?php foreach ($comunitiesall->result() as $c )  { ?>
                              <option value="<?php echo $c->ID; ?>" <?php if($marriageprofile->relegion_comunity==$c->ID)echo 'selected'; ?> ><?php echo $c->name; ?></option>
                            <?php } ?>
                            
                          </select>
                      </div>
                        <div id="showcomunity" style="display: none;" class="col-md-6">
                         
                            <select id="comunity" name="comunity" class="form-control">
                            </select>
                        </div>                                              
                      </div>
                    </div>                    
                  </div>

          <div class="row form-group">
                    <div class="col-md-3 ">
                      <label >Other Caste   : </label>
                    </div>
                    <div class="col-md-9 ">
                <input type="text" value="<?php echo $marriageprofile->other_caste ?>" class="form-control" name="othercaste">
                    </div>                    
                  </div>
                  <div class="row form-group">
                    <div class="col-md-3 ">
                      <label >Mother Tongue   : </label>
                    </div>
                    <div class="col-md-9 ">
                <select name="mother_tongue" class="form-control">
                <option value="">-Select-</option>  
                    <?php  foreach ($mothertounge as $r) { ?>
                      <option value="<?php echo $r['value'] ?>" <?php if($marriageprofile->mother_tounge==$r['value'])echo 'selected'; ?> ><?php echo $r['name'] ?></option>
                    <?php } ?>
          </select>
                    </div>                    
                  </div>

                    <div class="row form-group">
                    <div class="col-md-3 ">
                      <label >Faimly Values  : </label>
                    </div>
                    <div class="col-md-9 ">
                      <div class="row">
                        <div class="col-md-4">
                          <input type="radio" value="Traditional"  name="family_values" <?php if($marriageprofile->family_values== "Traditional")echo 'checked'; ?>> Traditional
                        </div>
                        <div class="col-md-4">
                          <input type="radio" value="Moderate"  name="family_values" <?php if($marriageprofile->family_values== "Moderate")echo 'checked'; ?>> Moderate
                        </div>
                        <div class="col-md-4">
                          <input type="radio" value="Librel"  name="family_values"  <?php if($marriageprofile->family_values== "Librel")echo 'checked'; ?>> Librel
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
</div>
