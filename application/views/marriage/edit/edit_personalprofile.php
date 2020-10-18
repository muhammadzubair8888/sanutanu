<style type="text/css">
  .panelcustom{
    border-top:1px solid #DDD;
    border-left:1px solid #DDD;
    border-right:1px solid #DDD;
    padding: 10px;
    background-color: #efefef;
    margin-top: 10px;
  }
  .panelbodycustom{
    border-bottom:1px solid #DDD;
    border-left:1px solid #DDD;
    border-right:1px solid #DDD;
    padding: 10px;
  }
</style>
<div style="margin-top: 20px;" class="row">
  <div class="col-md-4 col-xs-4">
    <?php include(APPPATH . "/views/marriage/sidebar.php"); ?>
    <div style="margin-top: 20px;">
      <a target="_blank" href="https://www.emailaudience.com/wp-content/uploads/2013/09/cusp-rules-of-cool.gif">
      <img style="height: 100%; width: 100%;" src="https://www.emailaudience.com/wp-content/uploads/2013/09/cusp-rules-of-cool.gif"></a>
    </div>
    <div style="margin-top: 20px;">
      <a target="_blank" href="https://infiniteingenuity.files.wordpress.com/2015/03/animation.gif">
      <img style="height: 100%; width: 100%;" src="https://infiniteingenuity.files.wordpress.com/2015/03/animation.gif"></a>
    </div>
    
  </div>
  <div class="col-md-8 col-xs-8">
    <div style="box-shadow: 0 0 6px rgba(0,0,0,.2); border-radius: 10px; padding: 10px;">
    <?php include(APPPATH . "/views/marriage/profileinformation.php"); ?>
      <div style="margin-top: 20px;">
        <div style="border:1px solid #DDD; border-radius: 10px; padding: 10px;">
          <div class="row">
            <div class="col-md-9">
              <div style="background-color: #efefef; padding: 5px; color: #b14343; font-weight: bold;">Manage <?php echo $marriageprofile->first_name ?> <?php echo $marriageprofile->last_name ?> Profile </div>
              <div style="padding: 10px;">
                <div class="row">
                  <div class="col-md-6">
                    <div>
                      <img src="https://www.re-marriage.in/images/5-add_contact_details_sml.gif"><span style="padding-left: 20px; padding-top: 5px;"><a href="<?php echo site_url('marriage/editbasics/').$marriageprofile->marriage_profile_id ?>">Edit Contact Details</a></span>
                    </div>
                    <div style="margin-top: 10px;">
                      <img src="https://www.re-marriage.in/images/5-profile_sml.gif"><span style="padding-left: 20px; padding-top: 5px;"><a href="<?php echo site_url('marriage/edit_personalprofile/').$marriageprofile->marriage_profile_id ?>">Edit Personal Profile</a></span>
                    </div>
                     <div style="margin-top: 10px;">
                      <img src="https://www.re-marriage.in/images/5-hide_delete_profile_sml.gif"><span style="padding-left: 20px; padding-top: 5px;"><a href="<?php echo site_url('marriage/hide_delete_profile/').$marriageprofile->marriage_profile_id ?>">Hide/Delete Profile</a></span>
                    </div>
                    <div style="margin-top: 10px;">
                      <img src="https://www.re-marriage.in/images/5-my_profile_statistics_sml.gif"><span style="padding-left: 20px; padding-top: 5px;"><a href="">View Profile Statistics</a></span>
                    </div>  
                  </div>
                  <div class="col-md-6">
                    <div>
                      <img src="https://www.re-marriage.in/images/5-add_contact_details_sml.gif"><span style="padding-left: 20px; padding-top: 5px;"><a href="<?php echo site_url('marriage/set_patner_profile/').$marriageprofile->marriage_profile_id ?>">Set Partner Profile</a></span>
                    </div>  
                  </div>
                </div>
              </div>  
            </div>
            <div class="col-md-3">
              <div style="border:1px solid #DDD; border-radius: 10px; padding: 5px;">
                  <img style="height: 100%; width: 100%;" src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $marriageprofile->profileimage ?>">
              </div>
              <div style="text-align: center; margin-top: 10px;">
                <b>Profile Views</b><br>
                <b><?php if (empty($marriageprofile->profileviews)) {
                  echo "0";
                }else{ echo $marriageprofile->profileviews;} ?></b>
              </div>  
            </div>
          </div>
        </div>
      <div style="background-color: #efefef; padding: 5px; color: #b14343; font-weight: bold; margin-bottom: 10px;">Update Basics</div>
      <div  class="panelbodycustom">
        <?php echo form_open_multipart(site_url("marriage/updatemybasics"), array("class" => "form-horizontal")) ?>
          <input type="hidden" value="<?php echo $marriageprofile->marriage_profile_id; ?>" name="marriage_profile_id">
          <div class="row form-group">
              <div class="col-md-3">
                <b>Name</b>
              </div>
              <div class="col-md-9">
                  <div class="row">
                      <div class="col-md-6">
                          <input class="form-control" type="text" value="<?php echo $marriageprofile->first_name ?>" name="first_name">
                      </div>
                      <div class="col-md-6">
                          <input class="form-control" type="text" value="<?php echo $marriageprofile->last_name ?>" name="last_name">
                      </div>
                  </div>
              </div>
          </div>
          <div class="row form-group">
              <div class="col-md-3  ">
                <b>Gender</b>
              </div>
              <div class="col-md-9 ">
                <div class="row">
                  <div class="col-md-2">
                    <input type="radio"  value="Male" name="gender"<?php if($marriageprofile->gender=="Male")echo 'checked'; ?>> Male
                  </div>
                  <div class="col-md-6">
                    <input type="radio" value="FeMale" name="gender"<?php if($marriageprofile->gender== "FeMale")echo 'checked'; ?>> FeMale
                  </div>                        
                </div>
              </div>
          </div>
          <div class="row form-group">
              <div class="col-md-3 ">
                <label >Date of Birth : </label>
              </div>
              <div class="col-md-9 ">
                <div class="row">
                  <div class="col-md-4">
                    <select class="form-control" name="day">
                      <?php for ($i=1; $i < 32 ; $i++) {  ?>
                      <option value="<?php echo $i ?>" <?php if($marriageprofile->day_of_birth==$i)echo 'selected'; ?> ><?php echo $i ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <select class="form-control" name="month">
                      <?php foreach($months as $m): ?>
                        <option value="<?php echo $m['value'] ?>" <?php if($marriageprofile->month_of_birth==$m['value'])echo 'selected'; ?> ><?php echo $m['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>  
                  <div class="col-md-4">
                    <select class="form-control" name="year">
                      <?php for ($i=1950; $i < 2041 ; $i++) {  ?>
                      <option value="<?php echo $i ?> " <?php if($marriageprofile->year_of_birth==$i)echo 'selected'; ?>><?php echo $i ?></option>
                      <?php } ?>
                    </select>
                  </div>                                              
                </div>
              </div>                    
            </div>
                
          <div class="row form-group">
              <div class="col-md-3 ">
                <label>Marital Status : </label>
              </div>
              <div class="col-md-9 ">
                <div class="row">
                  <div class="col-md-4">
                    <input type="radio"   value="Navermarried" name="maritalstatus" <?php if($marriageprofile->marital_status== "Navermarried")echo 'checked'; ?>> Navermarried
                  </div>
                  <div class="col-md-4">
                    <input type="radio" value="Divorced"  name="maritalstatus" <?php if($marriageprofile->marital_status== "Divorced")echo 'checked'; ?>> Divorced
                  </div>
                  <div class="col-md-4">
                    <input type="radio" value="Widowed"  name="maritalstatus" <?php if($marriageprofile->marital_status== "Widowed")echo 'checked'; ?>> Widowed
                  </div>
                  <div class="col-md-4">
                    <input type="radio" value="Separated"  name="maritalstatus" <?php if($marriageprofile->marital_status== "Separated")echo 'checked'; ?>> Separated
                  </div>
                  <div class="col-md-4">
                    <input type="radio" value="Annulled"  name="maritalstatus" <?php if($marriageprofile->marital_status== "Annulled")echo 'checked'; ?>> Annulled
                  </div>                        
                </div>
              </div>                    
            </div>
                  <script>
              $('input[type=radio][name=maritalstatus]').change(function() {
                  if (this.value == 'Navermarried') {
                      $('#havechildren').fadeOut('slow');
                      $('#noofchildren').fadeOut('slow');         
                  }
                  else if (this.value == 'Divorced') {
                      $('#havechildren').fadeIn('slow');
                      $('#noofchildren').fadeIn('slow');
                  }
                  else if (this.value == 'Widowed') {
                      $('#havechildren').fadeIn('slow');
                      $('#noofchildren').fadeIn('slow');
                  }
                  else if (this.value == 'Separated') {
                      $('#havechildren').fadeIn('slow');
                      $('#noofchildren').fadeIn('slow');
                  }
                  else if (this.value == 'Annulled') {
                      $('#havechildren').fadeIn('slow');
                      $('#noofchildren').fadeIn('slow');
                  }
              });
            </script>
                  <div style="display: none;" id="havechildren" class="row form-group">
                    <div class="col-md-3 ">
                      <label >Having Children  : </label>
                    </div>
                    <div class="col-md-9 ">
                      <div class="row">
                        <div class="col-md-2">
                          <input type="radio"  value="No" name="havchildren"> No
                        </div>
                        <div class="col-md-5">
                          <input type="radio" value="Yes. Living together"  name="havchildren"> Yes. Living together
                        </div>
                        <div class="col-md-2">
                          <input type="radio" value="Widowed"  name="havchildren"> Yes
                        </div>                        
                      </div>
                    </div>                    
                  </div>
                  <div style="display: none;" id="noofchildren" class="row form-group">
                    <div class="col-md-3 ">
                      <label >No Of Children  : </label>
                    </div>
                    <div class="col-md-9 ">
                      <div class="row">
                        <div class="col-md-3"><label>Male</label></div>
                        <div class="col-md-3">
                          <select class="form-control" name="malechildren">
                            <?php for ($i=0; $i < 15 ; $i++) {  ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-md-3"><label>FeMale</label></div>
                        <div class="col-md-3">
                          <select class="form-control" name="femalechildren">
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
              <label >Height  : </label>
            </div>
            <div class="col-md-9 ">
              <select required="" name="height" class="form-control">
                <option value="">Select Height</option>
                <option value="4ft 5in">4ft 5in - 134cm</option> 
                <option value="4ft 6in">4ft 6in - 137cm</option> 
                <option value="4ft 7in">4ft 7in - 139cm</option> 
                <option value="4ft 8in">4ft 8in - 142cm</option> 
                <option value="4ft 9in">4ft 9in - 144cm</option> 
                <option value="4ft 10in">4ft 10in - 147cm</option> 
                <option value="4ft 11in">4ft 11in - 149cm</option> 
                <option value="5ft">5ft - 152cm</option> 
                <option value="5ft 1in">5ft 1in - 154cm</option> 
                <option value="5ft 2in">5ft 2in - 157cm</option>
                 <option value="5ft 3in">5ft 3in - 160cm</option> 
                 <option value="5ft 4in">5ft 4in - 162cm</option> 
                 <option value="5ft 5in">5ft 5in - 165cm</option> 
                 <option value="5ft 6in">5ft 6in - 167cm</option> 
                 <option value="5ft 7in">5ft 7in - 170cm</option> 
                 <option value="5ft 8in">5ft 8in - 172cm</option> 
                 <option value="5ft 9in">5ft 9in - 175cm</option> 
                 <option value="5ft 10in">5ft 10in - 177cm</option> 
                 <option value="5ft 11in">5ft 11in - 180cm</option> 
                 <option value="6ft">6ft - 182cm</option> 
                 <option value="6ft 1in">6ft 1in - 185cm</option> 
                 <option value="6ft 2in">6ft 2in - 187cm</option> 
                 <option value="6ft 3in">6ft 3in - 190cm</option> 
                 <option value="6ft 4in">6ft 4in - 193cm</option> 
                 <option value="6ft 5in">6ft 5in - 195cm</option> 
                 <option value="6ft 6in">6ft 6in - 198cm</option> 
                 <option value="6ft 7in">6ft 7in - 200cm</option> 
                 <option value="6ft 8in">6ft 8in - 203cm</option> 
                 <option value="6ft 9in">6ft 9in - 205cm</option> 
                 <option value="6ft 10in">6ft 10in - 208cm</option> 
                 <option value="6ft 11in">6ft 11in - 210cm</option> 
                 <option value="7ft">7ft - 213cm</option> 
              </select>
                  </div>                    
          </div>    
          <div style="padding: 10px;" class="row">
              <div class="col-md-3  ">
                <b>Weight</b>
              </div>
              <div class="col-md-3  ">
                <select class="form-control" name="weight">
                  <option value="">Select Weight</option>
                  <?php for ($i=30; $i < 201 ; $i++) {  ?>
                  <option value="<?php echo $i ?>" <?php if($marriageprofile->weight == $i)echo 'selected'; ?>><?php echo $i ?> KG</option>
                  <?php } ?>
                </select> 
              </div>
              <div class="col-md-3  ">
                <b>Blood Group</b>
              </div>
              <div class="col-md-3  ">
                 <select class="form-control" name="bloodgroup">
                      <?php foreach($bloodgroup as $b): ?>
                        <option value="<?php echo $b['value'] ?>" <?php if($marriageprofile->blood_group==$b['value'])echo 'selected'; ?> ><?php echo $b['name'] ?></option>
                      <?php endforeach; ?>
                  </select> 
              </div>
          </div>
          <div class="row form-group">
            <div class="col-md-3 ">
              <label >Body type  : </label>
            </div>
            <div class="col-md-9 ">
              <div class="row">
                <div class="col-md-3">
                  <input type="radio" value="Slim" name="bodytype" <?php if($marriageprofile->body_type== "Slim")echo 'checked'; ?>> Slim
                </div>
                <div class="col-md-3">
                  <input type="radio" value="Average"  name="bodytype" <?php if($marriageprofile->body_type== "Average")echo 'checked'; ?>> Average
                </div>
                <div class="col-md-3">
                  <input type="radio" value="Athletic"  name="bodytype" <?php if($marriageprofile->body_type== "Athletic")echo 'checked'; ?>> Athletic
                </div>
                <div class="col-md-3">
                  <input type="radio" value="Heavy"  name="bodytype" <?php if($marriageprofile->body_type== "Heavy")echo 'checked'; ?>> Heavy
                </div>                                                
              </div>
            </div>                    
          </div>
          <div class="row form-group">
            <div class="col-md-3 ">
              <label >Complexion  : </label>
            </div>
            <div class="col-md-9 ">
              <div class="row">
                <div class="col-md-3">
                  <input type="radio"  value="Very Fair" name="bodytypecomplexion" <?php if($marriageprofile->complexion== "Very Fair")echo 'checked'; ?>> Very Fair   
                </div>
                <div class="col-md-3">
                  <input type="radio" value="Fair"  name="bodytypecomplexion" <?php if($marriageprofile->complexion== "Fair")echo 'checked'; ?>> Fair
                </div>
                <div class="col-md-5">
                  <input type="radio" value="Wheatish Medium"  name="bodytypecomplexion" <?php if($marriageprofile->complexion== "Wheatish Medium")echo 'checked'; ?>> Wheatish Medium   
                </div>
                <div class="col-md-4">
                  <input type="radio" value="Wheatish Brown"  name="bodytypecomplexion" <?php if($marriageprofile->complexion== "Wheatish Brown")echo 'checked'; ?>> Wheatish Brown  
                </div>
                <div class="col-md-4">
                  <input type="radio" value="Dark"  name="bodytypecomplexion" <?php if($marriageprofile->complexion== "Dark")echo 'checked'; ?>> Dark  
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
     
       <div  class="panelbodycustom">
        <?php echo form_open_multipart(site_url("marriage/updatemypicture"), array("class" => "form-horizontal")) ?>
          <input type="hidden" value="<?php echo $marriageprofile->marriage_profile_id; ?>" name="marriage_profile_id">
           
              <div class="row form-group">
                    <div class="col-md-3 ">
                      <label >Profile Image : </label>
                    </div>
                    <div class="col-md-9 ">
                      <input required="" type="file" name="image" id="image" style="height: 36px;"  class="form-control" value="<?php echo $marriageprofile->profileimage ?>">
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
