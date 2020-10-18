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
      <div style="background-color: #efefef; padding: 5px; color: #b14343; font-weight: bold; margin-bottom: 10px;">Update  My Family Background</div>
  </div>
    
      <div  class="panelbodycustom">
        <?php echo form_open_multipart(site_url("marriage/updatefamily"), array("class" => "form-horizontal")) ?>
          <input type="hidden" value="<?php echo $marriageprofile->marriage_profile_id; ?>" name="marriage_profile_id">
           <div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
                <div><b>Use this space to describe your personality, life goals, expectations from marriage-any such information which your prospective partner will find useful. </b></div>
                </div>
                <div class="row form-group">
                  <div class="col-md-12">
                    <textarea required="" name="describepersonality" class="form-control"  value="<?php echo $marriageprofile->describepersonality ?>" rows="8"  ><?php echo $marriageprofile->describepersonality ?></textarea> 
                  </div>  
                        
                </div>
                <div style="border: 1px solid #DDD; background-color: #f6f6f6; padding: 5px; margin-bottom: 10px;">
                <div><b>Family Details</b><small style="color: red;"> [ Visible Only You ]</small></div>
                </div>                                    
                <div class="row form-group">
                  <div class="col-md-3 ">
                    <label >Family Status : </label>
                  </div>
                  <div class="col-md-9 ">
                    <div class="row">
                      <div class="col-md-4">
                        <input type="radio"  value="Middle Class" name="familystatus" <?php if($marriageprofile->familystatus== "Middle Class")echo 'checked'; ?>> Middle Class
                      </div>
                      <div class="col-md-4">
                        <input type="radio" value="Upper Middle Class"  name="familystatus" <?php if($marriageprofile->familystatus== "Upper Middle Class")echo 'checked'; ?>> Upper Middle Class
                      </div>
                      <div class="col-md-4">
                        <input type="radio" value="Rich/Affluent"  name="familystatus" <?php if($marriageprofile->familystatus== "Rich/Affluent")echo 'checked'; ?>> Rich/Affluent
                      </div>                        
                    </div>
                  </div>                    
                </div>
                <div class="row form-group">
                  <div class="col-md-3 ">
                    <label >Father Name: </label>
                  </div>
                  <div class="col-md-9 ">
              <input type="text" class="form-control" name="fathername" value="<?php echo $marriageprofile->fathername ?>">
                  </div>                    
                </div>
                <div class="row form-group">
                  <div class="col-md-3 ">
                    <label >Father Occupation: </label>
                  </div>
                  <div class="col-md-9 ">
                  <select name="father_occup"  class="form-control">
                  <option value="">-Select-</option>
                 <?php  foreach ($father_occup as $r) { ?>
                       <option value="<?php echo $r['value'] ?>" <?php if($marriageprofile->father_occup==$r['value'])echo 'selected'; ?> ><?php echo $r['name'] ?></option>
                       <?php } ?>
                  </select>
                  </div>                    
                </div>
                <div class="row form-group">
                  <div class="col-md-3 ">
                    <label >Mother Name: </label>
                  </div>
                  <div class="col-md-9 ">
              <input type="text" class="form-control" name="mothername" value="<?php echo $marriageprofile->mothername ?>">
                  </div>                    
                </div>
                <div class="row form-group">
                  <div class="col-md-3 ">
                    <label >Mother Occupation: </label>
                  </div>
                  <div class="col-md-9 ">
              <select name="mother_occup"  class="form-control">
                  <option value="">-Select-</option>
                   <?php  foreach ($mother_occup as $r) { ?>
                    <option value="<?php echo $r['value'] ?>" <?php if($marriageprofile->mother_occup==$r['value'])echo 'selected'; ?>><?php echo $r['name'] ?></option>
                    <?php } ?> 
              </select>
                  </div>                    
                </div>
                <div class="row form-group">
                  <div class="col-md-3 ">
                    <label>Have Brothers : </label>
                  </div>
                  <div class="col-md-9 ">
                    <div class="row">
                      <div class="col-md-4">
                        <input type="radio"  value="Yes" name="havebrothers" <?php if($marriageprofile->havebrothers== "Yes")echo 'checked'; ?> > Yes
                      </div>
                      <div class="col-md-4">
                        <input type="radio" value="No"  name="havebrothers" <?php if($marriageprofile->havebrothers== "No")echo 'checked'; ?>> No
                      </div>                        
                    </div>
                  </div>                    
                </div>
                <script>
            $('input[type=radio][name=havebrothers]').change(function() {
                if (this.value == 'No') {
                    $('#noofsiblings').fadeOut('slow');
                }
                else if (this.value == 'Yes') {
                    $('#noofsiblings').fadeIn('slow');
                }
            });
          </script>
          <div style="display: none;" id="noofsiblings" class="row form-group">
                  <div class="col-md-3 ">
                    <label >Marital Status  : </label>
                  </div>
                  <div class="col-md-9 ">
                    <div class="row">
                      <div class="col-md-3"><label>Married</label></div>
                      <div class="col-md-3">
                        <select class="form-control" name="marriedbrother">
                          <?php for ($i=0; $i < 15 ; $i++) {  ?>
                          <option value="<?php echo $i ?>"><?php echo $i ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="col-md-3"><label>Unmaried</label></div>
                      <div class="col-md-3">
                        <select class="form-control" name="unmarriedbrother">
                          <?php for ($i=0; $i < 15 ; $i++) {  ?>
                          <option value="<?php echo $i ?>"><?php echo $i ?></option>
                          <?php } ?>
                        </select>
                      </div>                        
                    </div>
                  </div>                    
                </div>
                <div class="row form-group">
                  <div class="col-md-3 ">
                    <label>Have Sisters : </label>
                  </div>
                  <div class="col-md-9 ">
                    <div class="row">
                      <div class="col-md-4">
                        <input type="radio"  value="Yes" name="havesisters" <?php if($marriageprofile->havesisters== "Yes")echo 'checked'; ?>> Yes
                      </div>
                      <div class="col-md-4">
                        <input type="radio" value="No"  name="havesisters" <?php if($marriageprofile->havesisters== "No")echo 'checked'; ?>> No
                      </div>                        
                    </div>
                  </div>                    
                </div>
                <script>
            $('input[type=radio][name=havesisters]').change(function() {
                if (this.value == 'No') {
                    $('#sistersmaritalstatus').fadeOut('slow');
                }
                else if (this.value == 'Yes') {
                    $('#sistersmaritalstatus').fadeIn('slow');
                }
            });
          </script>
          <div style="display: none;" id="sistersmaritalstatus" class="row form-group">
                  <div class="col-md-3 ">
                    <label >Marital Status  : </label>
                  </div>
                  <div class="col-md-9 ">
                    <div class="row">
                      <div class="col-md-3"><label>Married</label></div>
                      <div class="col-md-3">
                        <select class="form-control" name="marriedsister">
                          <?php for ($i=0; $i < 15 ; $i++) {  ?>
                          <option value="<?php echo $i ?>"><?php echo $i ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="col-md-3"><label>Unmaried</label></div>
                      <div class="col-md-3">
                        <select class="form-control" name="unmarriedsister">
                          <?php for ($i=0; $i < 15 ; $i++) {  ?>
                          <option value="<?php echo $i ?>"><?php echo $i ?></option>
                          <?php } ?>
                        </select>
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
