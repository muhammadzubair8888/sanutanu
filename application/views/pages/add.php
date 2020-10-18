<script src="<?php echo base_url() ?>scripts/custom/get_usernames.js"></script>
<div class="row">
     <!-- <h3 style="font-weight: bold;">Create a Page</h3>
     <p>Connect your business, yourself or your cause to the worldwide community of people on Facebook. To get started, choose a Page category.</p>

     <div style="margin-top: 50px;" class="row">
         <div class="col-md-6">
             <div class="box1" style="background-color: #e9ebee; border-radius: 10px;">
                <div style="text-align: center; padding: 28px;">
                    <img src="https://www.facebook.com/images/pages/create/biz_illustration.png">
                    <h3>Business or Brand</h3>
                    <p>Showcase your products and services, spotlight your brand and reach more customers on <b>Sanutanu</b></p>
                    <button id="buisness" style="margin-top: 30px;" class="btn btn-primary">Get Started</button>
                </div>
             </div>
             <div class="box2" style="background-color: #e9ebee; border-radius: 10px; display: none;">
                <div style="padding: 28px;">
                    <h3 style="font-weight: bold;">Business or Brand</h3>
                    <p>Connect with customers, grow your audience and showcase your products with a free business Page.</p>
                    <div class="form-group">
                        <label>Page Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <?php if(!$this->settings->info->page_slugs) : ?>
                    <div class="form-group">
                        <label><?php echo lang("ctn_535") ?></label>
                        <input type="text" name="slug" class="form-control" id="slug-check">
                        <div id="slug-msg"></div>
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="categoryid" class="form-control">
                            <?php foreach($categories->result() as $r) : ?>
                                <option value="<?php echo $r->ID ?>"><?php echo $r->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button style="margin-top: 10px;" class="btn btn-sm btn-primary">Continue</button>
                </div>
             </div>
         </div>
         <div class="col-md-6">
             <div class="box3" style="background-color: #e9ebee; border-radius: 10px;">
                <div style="text-align: center; padding: 28px;">
                    <img src="https://www.facebook.com/images/pages/create/community_illustration.png">
                    <h3>Community or Public Figure</h3>
                    <p>Connect and share with people in your community, organization, team, group or club.</p>
                    <button id="public" style="margin-top: 30px;" class="btn btn-sm btn-primary">Get Started</button>
                </div>
             </div>
             <div class="box4" style="background-color: #e9ebee; border-radius: 10px; display: none;">
                <div style="padding: 28px;">
                    <h3 style="font-weight: bold;">Community or Public Figure</h3>
                    <p>Connect and share with people in your community, organization, team, group or club.</p>
                    <div class="form-group">
                        <label>Page Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <?php if(!$this->settings->info->page_slugs) : ?>
                    <div class="form-group">
                        <label><?php echo lang("ctn_535") ?></label>
                        <input type="text" name="slug" class="form-control" id="slug-check">
                        <div id="slug-msg"></div>
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="categoryid" class="form-control">
                            <?php foreach($categories->result() as $r) : ?>
                                <option value="<?php echo $r->ID ?>"><?php echo $r->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button style="margin-top: 10px;" class="btn btn-sm btn-primary">Continue</button>
                </div>
             </div>
         </div>
     </div> -->
     <div class="col-md-12">
            
            <div class="mx1 mb2 h6 sm-h4 flex justify-center filter-buttons-group filter-buttons x-btn-group topbuttons" data-filter-group="type">
                <a href="<?php echo site_url('pages/joined'); ?>" class="btn btn-post btn-tab"><?php echo lang('ctn_982'); ?></a>
                <a href="<?php echo site_url('pages/your'); ?>" class="btn btn-post btn-tab"><?php echo lang('ctn_577'); ?></a>
                <?php if( (isset($member) && $member != null && $member->roleid == 1) || ($this->common->has_permissions(array("admin", "page_admin", "page_creator"), $this->user)) ) : ?>
                <a href="<?php echo site_url("pages/add") ?>" class="btn btn-post btn-tab btn-active"><?php echo lang("ctn_531") ?></a>
                <?php endif; ?>
            </div>


                <?php echo form_open_multipart(site_url("pages/add_pro"), array("class" => "form-horizontal")) ?>
                <div class="panel panel-default">
                <div class="panel-body">
                <p class="panel-subheading"><?php echo lang("ctn_532") ?></p>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_533") ?></label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_534") ?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="description" value="">
                    </div>
                </div>
                <?php if(!$this->settings->info->page_slugs) : ?>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_535") ?></label>
                        <div class="col-sm-7">
                            <input type="text" name="slug" class="form-control" id="slug-check">
                            <span class="help-block"><?php echo lang("ctn_536") ?>: <?php echo site_url("pages/view/") ?><strong>my-unique-slug</strong></span>
                        </div>
                        <div class="col-sm-3" id="slug-msg">

                        </div>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_537") ?></label>
                    <div class="col-sm-10">
                        <select name="categoryid" class="form-control">
                            <?php foreach($categories->result() as $r) : ?>
                                <option value="<?php echo $r->ID ?>"><?php echo $r->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_538") ?></label>
                    <div class="col-sm-10">
                        <select name="type" class="form-control">
                            <option value="0"><?php echo lang("ctn_539") ?></option>
                            <option value="1"><?php echo lang("ctn_540") ?></option>
                        </select>
                    </div>
                </div>
               <!--  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_829") ?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="pay_to_join" value="0">
                        <span class="help-block"><?php echo lang("ctn_830") ?></span>
                    </div>
                </div> -->
               <!--  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_831") ?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="pay_to_user" id="username-search" value="">
                        <span class="help-block"><?php echo lang("ctn_832") ?></span>
                    </div>
                </div> -->

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_541") ?></label>
                    <div class="col-sm-10">
                    
                    
                    <input type="file" name="userfile" /> 
                    
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_542") ?></label>
                    <div class="col-sm-10">
                   
                        <input type="file" name="userfile_profile" /> 
                    </div>
                </div>
                <h4><?php echo lang("ctn_543") ?></h4>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_497") ?></label>
                    <div class="col-sm-10">
                        <input type="text" name="location" class="form-control map_name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_24") ?></label>
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_544") ?></label>
                    <div class="col-sm-10">
                        <input type="text" name="phone" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_545") ?></label>
                    <div class="col-sm-10">
                        <input type="text" name="website" class="form-control">
                    </div>
                </div>
                <h4><?php echo lang("ctn_156") ?></h4>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_546") ?></label>
                    <div class="col-sm-10">
                    <select name="posting_status" class="form-control">
                        <option value="0"><?php echo lang("ctn_547") ?></option>
                        <option value="1"><?php echo lang("ctn_548") ?></option>
                        <option value="2"><?php echo lang("ctn_549") ?></option>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_550") ?></label>
                    <div class="col-sm-10">
                    <select name="nonmembers_view" class="form-control">
                        <option value="0"><?php echo lang("ctn_53") ?></option>
                        <option value="1"><?php echo lang("ctn_54") ?></option>
                    </select>
                    </div>
                </div>

                <input type="submit" class="btn btn-post form-control" value="<?php echo lang("ctn_531") ?>">

                </div>
                </div>
                <?php echo form_close() ?>


        </div>
</div>

    <script type="text/javascript">

        // $(document).ready(function() { 
        //     $("#buisness").click(function() { 
        //         $('.box1').fadeOut(); 
        //         $('.box2').fadeIn(); 
        //     });
        //     $("#public").click(function() { 
        //         $('.box3').fadeOut(); 
        //         $('.box4').fadeIn(); 
        //     }); 
        // });
        $(document).ready(function() {
            $('#slug-check').on("change", function() {
                var slug = $('#slug-check').val();
                $.ajax({
                    url: global_base_url + 'pages/check_slug',
                    type: 'GET',
                    data: {
                        slug : slug
                    },
                    dataType : 'json',
                    success: function(msg) {
                        if(msg.error) {
                            $('#slug-msg').html(msg.error_msg);
                            return;
                        }
                        if(msg.status == 0) {
                            $('#slug-msg').html(msg.status_msg);
                        } else if(msg.status == 1) {
                            $('#slug-msg').html(msg.status_msg);
                        }
                        return;
                    }
                })
            });
        });
    </script> 
