<style >
  @media (max-width: 414px){
    .mail-place{
      width: 92% !important;
      height: 19px !important;
      padding: 3px 15px !important;
      font-size: 2vw !important;
      }
    .navbar-header{
     width: 100% !important;
    }
    .btn-default{
      font-size: 1vw !important;
      padding: 4px 4px !important;
      
      }
      .navbar-brand{
        float: left !important;
      }

    .navbar-brand img{
      width: 40px !important;
      height: 11px !important;
    }
    .navbar-nav{
      padding-left: 81px !important;
           }
    .form-group{
      float: left !important;

    }
    .align{
      margin-top: -46px !important;
    }
    .index {
      width: 45% !important;
      margin-left: 4px !important;
    }
    .secure{
    width: 100% !important;
    }
    .resecure{
      width: 100% !important;
    }
    .glyphicon{
      font-size: 8.5px !important;
    }
    .form-control{
     font-size: 2vw !important;
    height: 25px !important;
    }
    .has-feedback .form-control{
      padding-right: 25.5px !important;
    }
    .mycin{
      margin-left: 24px !important;
    }
#countries{
  width: 45% !important;
  float: left !important;
}
#cities{
  width: 45% !important;
  float: left !important;

 margin-left: 28.5px !important;
}
.glyph-icon{
  width: 80px !important;
}
.form-control-feedback{
  line-height: 28px !important;
}
.form-area{
  width: 100% !important;
}
.navbar-nav{
  margin: 4.5px -15px -4.5px -15px !important;
}
.form-error{
  margin-top: -53px !important;
  margin-bottom: 56px !important;
  padding: 3px !important;
  font-size: 2.5vw !important;
}



  }
</style>
<nav class="navbar navbar-inverse">
  <div class="container">
      <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo base_url(); ?>"><img style="width: 155px;height: 28px;" src="http://sanutanu.com/uploads/b99b46931b02b838591eb933f0d6e908.png"></a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <?php $gl = $this->session->flashdata('globalmsg'); ?>
        <?php if(!empty($gl)) :?>
          <div class="alert alert-success"><b><span class="glyphicon glyphicon-ok"></span></b> <?php echo $this->session->flashdata('globalmsg') ?></div> 
        <?php endif; ?>
        <?php if(isset($_GET['redirect'])) : ?>
        <?php echo form_open(site_url("login/pro/" . urlencode($_GET['redirect'])), array("id" => "login_form")) ?>
        <?php else : ?>
        <?php echo form_open(site_url("login/pro"), array("id" => "login_form")) ?>
        <?php endif; ?>
        <div style="margin-top: 10px;" class="row align">
          <div class="col-md-5">
              <div class="form-group">
                <input type="text" class="form-control mail-place" name="email" placeholder=" <?php echo lang("ctn_303") ?>">
              </div>
          </div>
          <div class="col-md-5">
              <div class="form-group">
                <input type="password"

                 name="pass" class="form-control mail-place" 
                 placeholder="*********"  
                >
                <div style="padding-top: 5px;"><a href="<?php echo base_url('login/forgotpw'); ?>" style="color: #DDD;">Forgotten password?</a></div>
              </div>
          </div>
          <div class="col-md-2">
              <div class="form-group">
                <button type="submit" class="btn btn-default" 
                >Login</button>
              </div>
          </div>
        </div>
        <?php echo form_close() ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
    <div class="row">
    <div class="col-md-6 center-block-e">

      

      <div class="login-form">
        <div class="login-form-inner">

          <h1 style="text-align: center;margin-bottom: 30px;" >Register</h1>

    <?php if(!empty($fail)) : ?>
      <div class="alert alert-danger"><?php echo $fail ?></div>
    <?php endif; ?>

        <?php echo form_open(site_url("register"), array("id" => "register_form")) ?>
          <input type="hidden" name="code" value="<?php if(isset($code)) echo $code ?>">
        <div class="form-group login-form-area has-feedback secure">
          <input type="text" class="form-control" name="email" placeholder="<?php echo lang("ctn_214") ?>" id="email" value="<?php if(isset($email)) echo $email; ?>">
                <i class="glyphicon glyphicon-envelope form-control-feedback login-icon-color" id="login-icon-email"></i>
            </div>
            <div class="form-group login-form-area has-feedback resecure">
          <input type="text" class="form-control" name="username" id="username" placeholder="<?php echo lang("ctn_215") ?>" value="<?php if(isset($username)) echo $username; ?>">
                <i class="glyphicon glyphicon-user form-control-feedback login-icon-color" id="login-icon-username"></i>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group login-form-area  index has-feedback">
              <input type="password" class="form-control" name="password" placeholder="<?php echo lang("ctn_216") ?>">
                    <i class="glyphicon glyphicon-lock form-control-feedback login-icon-color"></i>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group login-form-area index has-feedback">
              <input type="password" class="form-control mycin" name="password2" placeholder="<?php echo lang("ctn_217") ?>">
                    <i class="glyphicon glyphicon-lock glyph-icon form-control-feedback login-icon-color"></i>
                </div>
              </div>
            </div>
            
            
            <div class="row">
              <div class=" col-sm-6">
                <div class="form-group login-form-area index has-feedback">
              <input type="text" class="form-control" name="first_name" placeholder="<?php echo lang("ctn_29") ?>">
                    <i class="glyphicon glyphicon-user  form-control-feedback login-icon-color"></i>
                </div>
              </div>
              <div class=" col-sm-6">
                <div class="form-group login-form-area index has-feedback">
              <input type="text" class="form-control mycin" name="last_name" placeholder="<?php echo lang("ctn_30") ?>">
                    <i class="glyphicon glyphicon-user glyph-icon form-control-feedback login-icon-color"></i>
                </div>
              </div>
              
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <select style="font-size: 15px;height: 35px;" class="form-control" id="countries" name="countries">
                            <option value="">Select Country</option>
                            <?php foreach ($this->db->get('countries')->result() as $c) { ?>
                                <option value="<?php echo $c->id ?>"><?php echo $c->name; ?></option>
                            <?php } ?>
                        </select>
              </div>
              <div class=" col-sm-6">
                <select style="font-size: 15px; height: 35px;" class="form-control" id="cities" name="cities">
                            <option value="">Select City</option>
                           
                        </select>
              </div>
              
            </div>
            
          <?php foreach($fields->result() as $r) : ?>
          <div class="form-group login-form-area clearfix">

              <div class="col-md-3 label-heading"><?php echo $r->name ?> <?php if($r->required) : ?>*<?php endif; ?></div>
              <div class="col-md-9">
                <?php if($r->type == 0) : ?>
                  <input type="text" class="form-control" id="name-in" name="cf_<?php echo $r->ID ?>" value="<?php if(isset($_POST['cf_'. $r->ID])) echo $_POST['cf_' . $r->ID] ?>">
                <?php elseif($r->type == 1) : ?>
                  <textarea name="cf_<?php echo $r->ID ?>" rows="8" class="form-control"><?php if(isset($_POST['cf_'. $r->ID])) echo $_POST['cf_' . $r->ID] ?></textarea>
                <?php elseif($r->type == 2) : ?>
                   <?php $options = explode(",", $r->options); ?>
                      <?php if(count($options) > 0) : ?>
                          <?php foreach($options as $k=>$v) : ?>
                          <div class="form-group"><input type="checkbox" name="cf_cb_<?php echo $r->ID ?>_<?php echo $k ?>" value="1" <?php if(isset($_POST['cf_cb_' . $r->ID . "_" . $k])) echo "checked" ?>> <?php echo $v ?></div>
                          <?php endforeach; ?>
                      <?php endif; ?>
                <?php elseif($r->type == 3) : ?>
                  <?php $options = explode(",", $r->options); ?>
                      <?php if(count($options) > 0) : ?>
                          <?php foreach($options as $k=>$v) : ?>
                          <div class="form-group"><input type="radio" name="cf_radio_<?php echo $r->ID ?>" value="<?php echo $k ?>" <?php if(isset($_POST['cf_radio_' . $r->ID]) && $_POST['cf_radio_' . $r->ID] == $k) echo "checked" ?>> <?php echo $v ?></div>
                          <?php endforeach; ?>
                      <?php endif; ?>
                <?php elseif($r->type == 4) : ?>
                  <?php $options = explode(",", $r->options); ?>
                      <?php if(count($options) > 0) : ?>
                          <select name="cf_<?php echo $r->ID ?>" class="form-control">
                          <?php foreach($options as $k=>$v) : ?>
                          <option value="<?php echo $k ?>" <?php if(isset($_POST['cf_' . $r->ID]) && $_POST['cf_'.$r->ID] == $k) echo "selected" ?>><?php echo $v ?></option>
                          <?php endforeach; ?>
                          </select>
                      <?php endif; ?>
                <?php endif; ?>
                <span class="help-text"><?php echo $r->help_text ?></span>
              </div>
          </div>
          <?php endforeach; ?>

          <?php if(!$this->settings->info->disable_captcha) : ?>
          <div class="form-group login-form-area">
              <p><?php echo $cap['image'] ?></p>
            <input type="text" class="form-control" id="captcha-in" name="captcha" placeholder="<?php echo lang("ctn_306") ?>" value="">
        </div>
          <?php endif; ?>

          <?php if($this->settings->info->google_recaptcha) : ?>
            <div class="form-group login-form-area">
            <div class="g-recaptcha" data-sitekey="<?php echo $this->settings->info->google_recaptcha_key ?>"></div> 
          </div>
          <?php endif ?>

        <label><?php echo lang("ctn_954") ?></label><!-- Birthday -->
          <div class="form-group login-form-area has-feedback form-area">
            <div class="input-group">
              <select class="form-control" style="width: inherit;" name="dob_day">
                <?php 
                $d=1; 
                for($d=1; $d<=31; $d++): ?>
                <option value="<?php echo $d; ?>" <?php if($d==18){ echo 'selected'; } ?>><?php echo $d; ?></option>
              <?php endfor; ?>
              </select>
              <select class="form-control" style="width: inherit;" name="dob_month">
                <?php 
                $m=1; 
                for($m=1; $m<=12; $m++): ?>
                <option value="<?php echo $m; ?>" <?php if($m==4){ echo 'selected'; } ?>><?php echo date('M', strtotime('2001-'.$m.'-01')); ?></option>
              <?php endfor; ?>
              </select>
              <select class="form-control" style="width: inherit;" name="dob_year">
                <?php 
                $y=date('Y');
                for($y=date('Y'); $y>=1905; $y--): ?>
                <option value="<?php echo $y; ?>" <?php if($y==1995){ echo 'selected'; } ?>><?php echo $y; ?></option>
              <?php endfor; ?>
              </select>
            </div>
            </div>


            <label><?php echo lang("ctn_951") ?></label><!-- Gender -->
          <div class="form-group login-form-area has-feedback">
            <input type="radio" name="gender" id="male" value="Male" checked />
            <label for="gender" onclick="$('#male').click();" ><?php echo lang("ctn_952") ?></label>
            &nbsp; &nbsp; &nbsp;
            <input type="radio" name="gender" id="female" value="Female" />
            <label for="gender"  onclick="$('#female').click();" ><?php echo lang("ctn_953") ?></label>
            </div>

          <div class="form-group login-form-area has-feedback">
            <input type="hidden" name="allow_newsletter" id="allow_newsletter" value="1" />
          <input type="checkbox" class="" name="getnewsletter" id="getnewsletter" onclick="cheknewsletter();" checked >
                <label for="getnewsletter"><?php echo lang("ctn_955"); ?></label>
            </div>


            <div class="form-group login-form-area has-feedback">
              <input type="hidden" name="allow_privacypolicy" id="allow_privacypolicy" value="1" />
          <input type="checkbox" class="" name="acceptprivacypolicy" id="acceptprivacypolicy" onclick="chekprivacypolicy();" checked >
                <label for="acceptprivacypolicy"><?php echo lang("ctn_979"); ?></label>
            </div>


          <input style="margin-top: 30px;" type="submit" name="s" class="btn btn-flat-login form-control" value="<?php echo lang("ctn_221") ?>" />

          <hr>

          </div>


          <div class="login-form-bottom">
          


           <?php if(!$this->settings->info->disable_social_login) : ?>
              <div class="text-center decent-margin-top">
              <?php if(!empty($this->settings->info->twitter_consumer_key) && !empty($this->settings->info->twitter_consumer_secret)) : ?>
              <div class="btn-group">
                <a href="<?php echo site_url("login/twitter_login") ?>" class="btn btn-flat-social-twitter" >
                  <img src="<?php echo base_url() ?>images/social/twitter.png" height="20" class='social-icon' />
                 Twitter</a>
              </div>
              <?php endif; ?>
              <?php if(!empty($this->settings->info->facebook_app_id) && !empty($this->settings->info->facebook_app_secret)) : ?>
              <div class="btn-group">
                <a href="<?php echo site_url("login/facebook_login") ?>" class="btn btn-flat-social-facebook" >
                  <img src="<?php echo base_url() ?>images/social/facebook.png" height="20" class='social-icon' />
                 Facebook</a>
              </div>
              <?php endif; ?>

              <?php if(!empty($this->settings->info->google_client_id) && !empty($this->settings->info->google_client_secret)) : ?>
              <div class="btn-group">
                <a href="<?php echo site_url("login/google_login") ?>" class="btn btn-flat-social-google" >
                  <img src="<?php echo base_url() ?>images/social/google.png" height="20" class='social-icon' />
                 Google</a>
              </div>
              <?php endif; ?>
              </div>
              <?php endif; ?>


        <?php echo form_close() ?>
      </div>
</div>

</div>
</div>
</div>


    <div class="col-md-12 ">
        <?php $gl = $this->session->flashdata('globalmsg'); ?>
        <?php if(!empty($gl)) :?>
            <div class=" projects-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success"><b><span class="glyphicon glyphicon-ok"></span></b> <?php echo $this->session->flashdata('globalmsg') ?></div>
                        </div>
                    </div>
                </div>
        <?php endif; ?>
    </div>
<script type="text/javascript">
  $(document).ready(function() {
    var form = "login_form";
    $('#'+form + ' input').on("focus", function(e) {
      clearerrors();
    });
    $('#'+form).on("submit", function(e) {

      e.preventDefault();
      // Ajax check
      var data = $(this).serialize();
      $.ajax({
        url : global_base_url + "login/ajax_check_login",
        type : 'POST',
        data : {
          formData : data,
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash() ?>'
        },
        dataType: 'JSON',
        success: function(data) {
          if(data.error) {
            $('#'+form).prepend('<div class="form-error">'+data.error_msg+'</div>');
          }
          if(data.success) {
            // allow form submit
            $('#'+form+ ' input[type="submit"]').val("<?php echo lang("ctn_744") ?> ...");
            $('#'+form).unbind('submit').submit();
          }
          if(data.field_errors) {
            var errors = data.fieldErrors;
            console.log(errors);
            for (var property in errors) {
                if (errors.hasOwnProperty(property)) {
                    // Find form name
                    var field_name = '#' + form + ' input[name="'+property+'"]';
                    $(field_name).addClass("errorField");
                    // Get input group of field
                    $('#'+form).prepend('<div class="form-error">'+errors[property]+'</div>');
                    

                }
            }
          }
        }
      });
      return false;
    });
  });

  function clearerrors() 
  {
    console.log("Called");
    $('.form-error').remove();
    $('.errorField').removeClass('errorField');
  }

   $('#countries').on('change',function(){
    $id = $('#countries').val();
    $.ajax({
      url: global_base_url + 'Login/get_city_id',
      data: {id: $id},
    })
    .done(function(res) {
      // console.log(res);
      $('#cities').html(res);

    })
   
    
  });
</script>
