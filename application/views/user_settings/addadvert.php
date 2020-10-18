<div class="row">
	<div class="col-md-3">
	   <?php include(APPPATH . "views/user_settings/sidebar.php"); ?>
	</div>
<div class="col-md-9">
	<div class="white-area-content">
		<div class="db-header clearfix">
		    <div class="page-header-title"> <span class="glyphicon glyphicon-file"></span> <?php echo lang("ctn_707") ?></div>
		    <div class="db-header-extra">
			</div>
		</div>
            <label>Select Plan</label>
			<div id="allplans" style="margin-left: 0px; margin-right: 0px;" class="row">
            <?php  foreach($alluserplans as $p)
                    { ?>
                        
                            <div id="<?php echo $p->id ?>" onclick="showbuttonborder(<?php echo $p->id ?>)" class=" col-md-3 theme_box">
                                <div style="font-size:22px;"><?php echo $p->plan_name ?> </div>
                                    <div style="margin-top:50px;"> <b> Remaining Ads :</b><?php echo $p->remaining_adds ?></div>
                            </div>

                        
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
                            url: "<?php echo site_url('User_Settings/get_plansby_id_for_insertadd/'); ?>"+id,
                            dataType: 'json',
                            success: function(data) {
                                var id = data.id;
                                var country_id = data.country_id;
                                var state_id = data.state_id;
                                var city_id = data.city_id;
                                $("#showinputfields").fadeIn();
                                $('#planid').val(id);
                                $('#countryid').val(country_id);
                                $('#stateid').val(state_id);
                                $('#cityid').val(city_id);
                            }
                        });
                }
            </script>
            
            <div style="display: none;" id="showinputfields">
                <?php echo form_open_multipart(site_url("admin/add_rotation_ad"), array("class" => "form-horizontal")) ?>
                    <input type="hidden" name="redirect" value="1">
                    <input type="hidden"  id="planid" name="planidforadduser">
                    <input type="hidden" id="countryid" name="country_id">
                    <input type="hidden" id="stateid" name="state_id">
                    <input type="hidden" id="cityid" name="city_id">
                   <div class="form-group">
                    <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_984") ?></label>
                    <div class="col-md-9">
                       <input required="" type="file" class="form-control" id="image" name="image">
                    </div>
                    </div>
                  <div class="form-group">
                  <div class="post-text" itemprop="text">
                    <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_8") ?></label>
                     <div class="col-md-9">

                    <input required="" type="text" class="form-control" name="link" id="link">
                  
                   </div>

                  </div>
                 </div>
                 <input type="submit" class="btn btn-post" value="<?php echo lang("ctn_707") ?>" />
                 <?php echo form_close() ?>
            </div>
            
	</div>
	</div>
</div>