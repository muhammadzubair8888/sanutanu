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
      <div style="background-color: #efefef; padding: 5px; color: #b14343; font-weight: bold; margin-bottom: 10px;">Update Patner Profile</div>
      
      <div  class="panelbodycustom">
        <?php echo form_open_multipart(site_url("marriage/updateptnerprofile"), array("class" => "form-horizontal")) ?>
          <input type="hidden" value="<?php echo $marriageprofile->marriage_profile_id; ?>" name="marriage_profile_id">
                       
                  <div  class="row form-group">
                    <div class="col-md-3 ">
                      <label >Gender: </label>
                    </div>
                    <div class="col-md-9 ">
                      <div class="row">
                        <div class="col-md-3">
                          <input type="radio" name="gender" value="male" <?php if($patnerprofile->gender== "male")echo 'checked'; ?>> Male
                        </div>
                        <div class="col-md-3">
                          <input type="radio" name="gender" value="female" <?php if($patnerprofile->gender== "female")echo 'checked'; ?>> Female
                        </div>
                      </div>
                    </div>
                  </div>
        
                 <div  class="row form-group">
                    <div class="col-md-3 ">
                      <label >Age Range: </label>
                    </div>
                    <div class="col-md-9 ">
                      <div class="row">
                        <div class="col-md-2">
                          <label>From</label>
                        </div>
                        <div class="col-md-3">
                          <select class="form-control" name="agerange">
                            <?php for ($i=18; $i < 101 ; $i++) {  ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-md-1">
                          <label>To</label>
                        </div>
                        <div class="col-md-3">
                          <select class="form-control" name="agerange">
                            <?php for ($i=18; $i < 101 ; $i++) {  ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
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
                          <input type="radio"  value="Navermarried" name="maritalstatus" <?php if($patnerprofile->maritalstatus== "Navermarried")echo 'checked'; ?>> Navermarried
                        </div>
                        <div class="col-md-4">
                          <input type="radio" value="Divorced"  name="maritalstatus" <?php if($patnerprofile->maritalstatus== "Divorced")echo 'checked'; ?>> Divorced
                        </div>
                        <div class="col-md-4">
                          <input type="radio" value="Widowed"  name="maritalstatus" <?php if($patnerprofile->maritalstatus== "Widowed")echo 'checked'; ?>> Widowed
                        </div>
                        <div class="col-md-4">
                          <input type="radio" value="Separated"  name="maritalstatus" <?php if($patnerprofile->maritalstatus== "Separated")echo 'checked'; ?>> Separated
                        </div>
                        <div class="col-md-4">
                          <input type="radio" value="Annulled"  name="maritalstatus" <?php if($patnerprofile->maritalstatus== "Annulled")echo 'checked'; ?>> Annulled
                        </div>                        
                      </div>
                    </div>                    
                  </div>
                  <script>
              $('input[type=radio][name=maritalstatus]').change(function() {
                  if (this.value == 'Navermarried') {
                      $('#havchildren').fadeOut('slow');
                      $('#noofchildren').fadeOut('slow');         
                  }
                  else if (this.value == 'Divorced') {
                      $('#havchildren').fadeIn('slow');
                      $('#noofchildren').fadeIn('slow');
                  }
                  else if (this.value == 'Widowed') {
                      $('#havchildren').fadeIn('slow');
                      $('#noofchildren').fadeIn('slow');
                  }
                  else if (this.value == 'Separated') {
                      $('#havchildren').fadeIn('slow');
                      $('#noofchildren').fadeIn('slow');
                  }
                  else if (this.value == 'Annulled') {
                      $('#havchildren').fadeIn('slow');
                      $('#noofchildren').fadeIn('slow');
                  }
              });
            </script>
                  <div style="display: none;" id="havchildren" class="row form-group">
                    <div class="col-md-3 ">
                      <label >Having Children  : </label>
                    </div>
                    <div class="col-md-9 ">
                      <div class="row">
                        <div class="col-md-2">
                          <input type="radio"  value="No" name="havchildren" <?php if($patnerprofile->havchildren== "No")echo 'checked'; ?>> No
                        </div>
                        <div class="col-md-5">
                          <input type="radio" value="Yes. Living together"  name="havchildren" <?php if($patnerprofile->havchildren== "Yes. Living together")echo 'checked'; ?>> Yes. Living together
                        </div>
                        <div class="col-md-2">
                          <input type="radio" value="Widowed"  name="havchildren" <?php if($patnerprofile->havchildren== "Widowed")echo 'checked'; ?>> Yes
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
                            <?php for ($i=1; $i < 15 ; $i++) {  ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-md-3"><label>FeMale</label></div>
                        <div class="col-md-3">
                          <select class="form-control" name="femalechildren">
                            <?php for ($i=1; $i < 15 ; $i++) {  ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php } ?>
                          </select>
                        </div>                        
                      </div>
                    </div>                    
                  </div>
                  <div  class="row form-group">
                    <div class="col-md-3 ">
                      <label >Height: </label>
                    </div>
                    <div class="col-md-9 ">
                      <div class="row">
                        <div class="col-md-1">
                          <label>From</label>
                        </div>
                        <div class="col-md-5">
                          <select name="height" class="form-control">
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
                        <div class="col-md-1">
                          <label>To</label>
                        </div>
                        <div class="col-md-5">
                          <select name="heightto" class="form-control">
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
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-md-3 ">
                      <label >Body type  : </label>
                    </div>
                    <div class="col-md-9 ">
                      <div class="row">
                        <div class="col-md-3">
                          <input type="radio"  value="Slim" name="bodytype" <?php if($patnerprofile->bodytype== "Slim")echo 'checked'; ?>> Slim
                        </div>
                        <div class="col-md-3">
                          <input type="radio" value="Average"  name="bodytype" <?php if($patnerprofile->bodytype== "Average")echo 'checked'; ?> > Average
                        </div>
                        <div class="col-md-3">
                          <input type="radio" value="Athletic"  name="bodytype" <?php if($patnerprofile->bodytype== "Athletic")echo 'checked'; ?>> Athletic
                        </div>
                        <div class="col-md-3">
                          <input type="radio" value="Heavy"  name="bodytype" <?php if($patnerprofile->bodytype== "Heavy")echo 'checked'; ?> > Heavy
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
                          <input type="radio"  value="Very Fair" name="complexion" <?php if($patnerprofile->complexion== "Very Fair")echo 'checked'; ?> > Very Fair   
                        </div>
                        <div class="col-md-3">
                          <input type="radio" value="Fair"  name="complexion"  <?php if($patnerprofile->complexion== "Fair")echo 'checked'; ?>> Fair
                        </div>
                        <div class="col-md-5">
                          <input type="radio" value="Wheatish Medium"  name="complexion" <?php if($patnerprofile->complexion== "Wheatish Medium")echo 'checked'; ?>> Wheatish Medium   
                        </div>
                        <div class="col-md-4">
                          <input type="radio" value="Wheatish Brown"  name="complexion"<?php if($patnerprofile->complexion== "Wheatish Brown")echo 'checked'; ?> > Wheatish Brown  
                        </div>
                        <div class="col-md-4">
                          <input type="radio" value="Wheatish Brown"  name="complexion" <?php if($patnerprofile->complexion== "Wheatish Brown")echo 'checked'; ?>> Dark  
                        </div>                                                
                      </div>
                    </div>                    
                  </div>
                  <div class="row form-group">
                    <div class="col-md-3 ">
                      <label >Special Cases  : </label>
                    </div>
                    <div class="col-md-9 ">
                      <div class="row">
                        <div class="col-md-3">
                          <input type="radio"  value="Yes" name="specialcases"  <?php if($patnerprofile->specialcases== "Yes")echo 'checked'; ?> > Yes   
                        </div>
                        <div class="col-md-3">
                          <input type="radio" value="No"  name="specialcases"  <?php if($patnerprofile->specialcases== "No")echo 'checked'; ?>> No
                        </div>
                        <div class="col-md-5">
                          <input type="radio" value="Does't Matter"  name="specialcases"  <?php if($patnerprofile->specialcases== "Does't Matter")echo 'checked'; ?>> Does't Matter   
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
