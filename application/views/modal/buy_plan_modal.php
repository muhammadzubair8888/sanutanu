<div id="buyplanmodal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo lang("ctn_284") ?></h4>
      </div>
      <div class="modal-body">
       		<div class="row">
				<div class="col-md-6">
					<div style=" height: 225px; " id="specific" class="spend-block theme_box">
						<p><img src="<?php echo base_url() ?>images/pin.png"></p>
						<p><strong><?php echo lang("ctn_1019") ?></strong></p>
						<p><?php echo lang("ctn_1017") ?></p>
					</div>
				</div>
				<div class="col-md-6">
					<div style=" height: 225px; " id="random" class="spend-block theme_box">
						<p><img src="<?php echo base_url() ?>images/pin.png"></p>
						<p><strong><?php echo lang("ctn_1018") ?></strong></p>
						<p><?php echo lang("ctn_1016") ?></p>
					</div>
				</div>	
			</div>
			<script>
				$(document).ready(function(){
				  $("#specific").click(function(){
				    $("#specific").fadeOut();
				    $("#random").fadeOut();
				    $("#showspecific").fadeIn();
				  });
                  $("#random").click(function(){
                    $("#specific").fadeOut();
                    $("#random").fadeOut();
                    $("#showrandom").fadeIn();
                  });                  
				});
			</script>
			<div style="display: none;" id="showspecific">
                <div style="color: white; cursor: pointer;  margin-bottom: 40px;margin-top: 30px;" id="selectrandom"><font style="border:1px solid #ccc; background-color: #182232; padding: 10px; font-size: 18px;">Select Random</font></div>
            <script>
                $(document).ready(function(){
                  $("#selectrandom").click(function(){
                    $("#showrandom").fadeIn();
                    $("#showspecific").fadeOut();

                  });                  
                });
            </script>                
				<label><?php echo lang("ctn_987") ?></label>
            <select id="country_for_add_rotation" name="country_id" class="form-control">
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
            <div id="showstate" style="display: none; margin-top: 10px;" >
            	<label><?php echo lang("ctn_988") ?></label>
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
			<div id="showcity" style="display: none; margin-top: 10px;" >
                <label ><?php echo lang("ctn_989") ?></label>
                <select id="city" name="city_id" class="form-control">

                </select>
        	</div>
        	<script>
                $( "select[id='city']" ).change(function (){
                    var city = $(this).val();
                    if(city == "") {
                        $('select[id="city"]').empty();
                    }else{

                      $.ajax({
                            type: 'GET',
                            url: "<?php echo site_url('admin/get_peoples_against_city/'); ?>"+city,
                            success: function(peoples) {
                                $("#showpeoples").fadeIn();
                                $('#showpeoples').html(peoples);
                            }
                        });
                        
                    }
                });
            </script>
        	<div id="showpeoples" style="display: none; margin-top: 10px;" >
        		
        	</div>
        	<script type="text/javascript">
        		function showplans(id)
        		{
	    			$.ajax({
	                        type: 'GET',
	                        url: "<?php echo site_url('User_Settings/get_all_plans/'); ?>"+id,
	                        success: function(peoples) {
	                            $("#showplans").fadeIn();
	                            $('#allplans').html(peoples);
	                        }
	                    });	
        		}
        	</script>
        	<div style="padding: 15px;" id="showplans">
        		<div id="allplans" style="display: flex;">
        			
        		</div>
        	</div>
        	<script type="text/javascript">
        		function addborder(id)
        		{
                    $('#successmessage').html("");
                    $('.theme_box').removeClass('theme_box_shadow');
        			$('#'+id).addClass('theme_box_shadow');
                    $.ajax({
                            type: 'GET',
                            url: "<?php echo site_url('User_Settings/get_plansby_id/'); ?>"+id,
                            success: function(button) {
                                $("#showbuybutton").fadeIn();
                                $('#showbuybutton').html(button);
                            }
                        });
        		}
        	</script>
	            <div id="showbuybutton" style="display: none; margin-top: 10px;" >
	                    
	            </div>
	            <div style="text-align: center; margin-top: 10px;" id="successmessage"></div>
	            <script type="text/javascript">
	                function buyplan(id)
	                {
	                    $.ajax({
	                        type: 'GET',
	                        url: "<?php echo site_url('User_Settings/buyplan/'); ?>"+id,
	                        success: function(plans) {
                                if (plans == 1) {
                                    $('#successmessage').html("<b><font color='red'>Already Purchased</font></b>");
                                }else if (plans == 2) {
                                    $('#successmessage').html("<b><font color='red'>Your Credites is not Enough to Buy This Plan</font></b><br><a href=''>Buy credits</a>");
                                }else{
                                    $('#successmessage').html("<b><font color='green'>Successfully Purchased</font></b>");
                                    location.reload();
                                }
	                        	
                                 
	                        }
	                    });
	                }
	            </script>
			</div>
            <div style="display: none;" id="showrandom">
                <div style="color: white; cursor: pointer; margin-bottom: 40px;margin-top: 30px;" id="selectspecific"><font style="border:1px solid #ccc; background-color: #182232; padding: 10px; font-size: 18px;">Select Specific</font></div>
            <script>
                $(document).ready(function(){
                  $("#selectspecific").click(function(){
                    $("#showspecific").fadeIn();
                    $("#showrandom").fadeOut();
                  });                  
                });
            </script>                
                <div id="allplans" style="margin-left: 0px; margin-right: 0px;" class="row">
 
                <?php 
                    $get_allplansfor_adver = $this->home_model->get_all_plans_for_advert();
                        foreach($get_allplansfor_adver as $p)
                    { ?>
                        
                            <div id="<?php echo $p->id ?>" onclick="showbuttonborder(<?php echo $p->id ?>)" class=" theme_box col-md-3">
                                <div style="font-size:22px;"><?php echo $p->plan_name ?> </div>
                                <div style="margin-top:30px;"> <b> No Of Ads :</b><?php echo $p->no_of_ads ?></div>
                                <div style="margin-top:10px;"> <b> Credits :</b><?php echo $p->no_of_credits ?></div></div>
                        
                  <?php   }
                    ?>
                    </div>
            <script type="text/javascript">
                function showbuttonborder(id)
                {
                    $('.theme_box').removeClass('theme_box_shadow');
                    $('#'+id).addClass('theme_box_shadow');
                    $('#randomsmessage').html("");
                    $.ajax({
                            type: 'GET',
                            url: "<?php echo site_url('User_Settings/get_plansby_id_for_random/'); ?>"+id,
                            success: function(button) {
                                $("#showbutton").fadeIn();
                                $('#showbutton').html(button);
                            }
                        });
                }
            </script>
            <div id="showbutton" style="display: none; margin-top: 10px;" >
                    
            </div>
            <script type="text/javascript">
                    function buyplan_for_random(id)
                    {
                        $.ajax({
                            type: 'GET',
                            url: "<?php echo site_url('User_Settings/buyplan/'); ?>"+id,
                            success: function(plans) {
                                if (plans == 1) {
                                    $('#randomsmessage').html("<b><font color='red'>Already Purchased</font></b>");
                                }else if (plans == 2) {
                                    $('#randomsmessage').html("<b><font color='red'>Your Credites is not Enough to Buy This Plan</font></b><br><a href=''>Buy credits</a>");
                                }else{
                                    $('#randomsmessage').html("<b><font color='green'>Successfully Purchased</font></b>");
                                    location.reload();
                                }
                                
                                 
                            }
                        });
                    }
                </script>
            
            <div style="text-align: center; margin-top: 10px;" id="randomsmessage"></div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>