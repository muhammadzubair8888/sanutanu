<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    <div class="db-header-extra"> <input type="hidden" class="btn btn-post btn-sm" value="" data-toggle="modal" data-target="#myModal">
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
  <li class="active"><?php echo lang("ctn_1007") ?></li>
</ol>
 <?php 
 foreach ($editplan as $key ) {
    $name  = $key->plan_name;
    $no_of_ads  = $key->no_of_ads;
    $country_id  = $key->country_id;
    $state_id  = $key->state_id;
    $city_id  = $key->city_id;
    $no_of_credits  = $key->no_of_credits;
    $status  = $key->status;
    $planid  = $key->id;
 }
   $cityname = @$this->home_model->get_city($city_id)->row()->name;
  $statename = @$this->home_model->get_state($state_id)->row()->name;
  $countryname = @$this->home_model->get_country($country_id)->row()->name;
 ?>


<ol id="hidebeardcumb" class="breadcrumb">
  <li><?php echo lang("ctn_1008") ?> : </li>
  <li> <b> <?php echo $countryname ;?> </b> </li>
  <li><?php echo lang("ctn_1009") ?> : </li>
  <li> <b> <?php echo $statename ;?> </b> </li>
  <li><?php echo lang("ctn_1010") ?> : </li>
  <li> <b> <?php echo $cityname ;?>  </b></li>
  <li><b><span id="changeeverything" style="color: blue; cursor: pointer;"><?php echo lang("ctn_1011") ?></span></b></li>
</ol>

<?php echo form_open_multipart(site_url("admin/update_ads_plan"), array("class" => "form-horizontal")) ?>
<input type="hidden" value="<?php echo $planid ?>" name="planid">
      <div id="allcountriews">
          <label ><?php echo lang("ctn_987") ?></label>
              <select  id="country_for_add_rotation" name="country_id" class="form-control">
                <option value=""><?php echo lang("ctn_987") ?></option> 
                <?php foreach ($all_countries as $key) { ?>
                    <option value="<?php echo $key->id; ?>"><?php echo $key->name; ?></option>
                <?php  } ?>
              </select>
              <script>
                $( "select[id='country_for_add_rotation']" ).change(function (){
                    var country_for_add_rotation = $(this).val();
                    if(country_for_add_rotation == "") {
                        $('select[id="state"]').empty();
                    }else{

                      $.ajax({
                            type: 'GET',
                            url: "<?php echo site_url('admin/get_states_against_country_for_add_rotation/'); ?>"+country_for_add_rotation,
                            success: function(state) {
                                $("#showstate").fadeIn();
                                $('select[id="state"]').html(state);
                            }
                        });
                        
                    }
                });
            </script>            
            <div id="showstate" style="display: none;" >
                    <label for="email-in" ><?php echo lang("ctn_988") ?></label>
                        <select id="state" name="state_id" class="form-control">

                        </select>
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
            <div id="showcity" style="display: none;" >
                    <label for="email-in" ><?php echo lang("ctn_989") ?></label>
                        <select id="city" name="city_id" class="form-control">

                        </select>
            </div>
</div> 
<label style="margin-top: 20px;" ><?php echo lang("ctn_260") ?></label>
<input required="" type="text" value="<?php echo $name; ?>" class="form-control" name="plan_tittle" >
<label style="margin-top: 10px;"><?php echo lang("ctn_606") ?></label>
<select  required="" name="status" class="form-control">
  <?php if ($status == 0) { ?>
   <option value="0"><?php echo lang("ctn_702") ?></option>
   <option value="1"><?php echo lang("ctn_703") ?></option>
 <?php }else{ ?>
  <option value="1"><?php echo lang("ctn_703") ?></option>
  <option value="0"><?php echo lang("ctn_702") ?></option>
<?php } ?>
</select>
<label><?php echo lang("ctn_997") ?></label>
<input required="" type="number" name="no_of_ads"  class="form-control" value="<?php echo $no_of_ads; ?>">
<label><?php echo lang("ctn_265") ?></label> 
<input required="" type="number" name="credit_cost" class="form-control" value="<?php echo $no_of_credits; ?>">
<br>
<input type="submit" class="btn btn-primary" name="">
<?php echo form_close() ?>
<script type="text/javascript">
    $(document).ready(function(){
      $("#allcountriews").hide();
      $("#changeeverything").click(function(){
        $("#hidebeardcumb").fadeOut();
        $("#allcountriews").fadeIn();
      });
    });
</script>

</div>

