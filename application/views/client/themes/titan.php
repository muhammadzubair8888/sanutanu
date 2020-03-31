<!DOCTYPE html>
<?php if($enable_rtl) : ?>
<html dir="rtl">
<?php else : ?>
<html lang="en">
<?php endif; ?>
    <head>
        <title><?php if(isset($page_title)) : ?><?php echo $page_title ?> - <?php endif; ?><?php echo $this->settings->info->site_name ?></title>         
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap -->
        <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">

        <link href="<?php echo base_url();?>scripts/libraries/mention/jquery.mentions.css" rel="stylesheet" type="text/css">
        

         <!-- Styles -->
        <link href="<?php echo base_url();?>styles/client/themes/titan/main.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url();?>styles/client/themes/titan/responsive.css" rel="stylesheet" type="text/css">

        
        <link href="<?php echo base_url();?>styles/client/responsive.css" rel="stylesheet" type="text/css">
        
        <link href="<?php echo base_url();?>styles/client/elements.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,500,550,600,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />

        <link href="<?php echo base_url();?>styles/chat.css" rel="stylesheet" type="text/css">

        <!-- SCRIPTS -->
        <script type="text/javascript">
        var global_base_url = "<?php echo site_url('/') ?>";
        var global_hash = "<?php echo $this->security->get_csrf_hash() ?>";
        </script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

        <script src="<?php echo base_url() ?>scripts/libraries/jquery.form.min.js"></script> <!-- processing forms ajax -->

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.js"></script> <!-- datatables -->

        <script src="<?php echo base_url();?>scripts/libraries/mention/jquery.mentions.js"></script> <!-- @mentions and #hastags -->
        <script src="<?php echo base_url();?>scripts/libraries/jquery.jscroll.js"></script> <!-- infinite scroll -->

        <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script> <!-- text editor -->

        <script src="//twemoji.maxcdn.com/2/twemoji.min.js?2.3.0"></script> <!-- for emoji -->

        <?php if(isset($datatable_lang) && !empty($datatable_lang)) : ?>
        <script type="text/javascript">
            $(document).ready(function() {
              $.extend( true, $.fn.dataTable.defaults, {
              "language": {
                "url": "<?php echo $datatable_lang ?>"
            }
              });
          });
     
        </script>
        <?php endif; ?>

        <?php if(isset($fullcalendar_lang) && !empty($fullcalendar_lang)) : ?>
        <script src="<?php echo base_url() . $fullcalendar_lang ?>"></script>
        <?php endif; ?>

         <link href="<?php echo base_url();?>scripts/libraries/select2.min.css" rel="stylesheet" type="text/css">
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBo0l7EcNxwWoTYIgE3-p3J0m5_W844_Pg&libraries=places"></script>
        <script src="<?php echo base_url() ?>scripts/libraries/jquery.geocomplete.min.js"></script>
        <script src="<?php echo base_url() ?>scripts/libraries/select2.full.min.js"></script>

        <?php if(!$this->settings->info->disable_chat) : ?>
          <script src="<?php echo base_url() ?>scripts/custom/chat.js" type="text/javascript"></script>
          <script type="text/javascript">
          time_to_update = 5000;
          </script>
        <?php endif; ?>

        <link  href="<?php echo base_url() ?>scripts/libraries/viewer/viewer.css" rel="stylesheet">
      <script src="<?php echo base_url() ?>scripts/libraries/viewer/viewer.js"></script> <!-- Gallery viewer -->

        
        <!-- CODE INCLUDES -->
        <?php echo $cssincludes ?> 

        <!-- Favicon: http://realfavicongenerator.net -->
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url() ?>images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="<?php echo base_url() ?>images/favicon/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="<?php echo base_url() ?>images/favicon/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="<?php echo base_url() ?>images/favicon/manifest.json">
        <link rel="mask-icon" href="<?php echo base_url() ?>images/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        

    </head>
    <body>

    <nav class="navbar navbar-fixed-top" style="background: #FFF;">

      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <div class="row">
              <div class="col-md-2" style=" height: 50px;">
                <?php if($this->settings->info->logo_option) : ?>
              <a class="navbar-brand-two" href="<?php echo site_url() ?>" title="<?php echo $this->settings->info->site_name ?>"><img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->settings->info->site_logo ?>" width="123" height="32"></a>
            <?php else : ?>
              <a class="navbar-brand" href="<?php echo site_url() ?>" title="<?php echo $this->settings->info->site_name ?>"><?php echo $this->settings->info->site_name ?></a>
            <?php endif; ?>
            <div class="clearfix"></div>
              </div>
              <div class="col-md-6" style="padding-top: 8px; height: 50px;">
                <?php include(APPPATH . "views/search/searchform.php"); ?>
              </div>
              <div class="col-md-4" style="padding-top: 10px; height: 50px;">
                <? //=$this->uri->segment(2);?>
                <?php
                if($this->uri->segment(1)=="profile")
                {
                  $username = $this->uri->segment(2);
                  $CI =& get_instance();
                  $CI->load->model('user_model');
                  $result = $CI->user_model->get_user_by_username($username);
                  if($result->num_rows()>0)
                  {
                    $user = $result->row_array();
                    $user_name = $user['first_name'].' '.$user['last_name'];
                  }
                  else
                  {
                    $userid = $this->uri->segment(3);
                    $result = $CI->user_model->get_user_by_id($userid);
                    $user = $result->row_array();
                    $user_name = $user['first_name'].' '.$user['last_name'];
                    $username = $user['username'];
                  }
                  
                  ?>
                  <a class="header-home-button" href="<?php echo site_url().'/profile/'.$username ?>"><?php echo $user_name; ?></a>
                  <?php
                }
                else
                {
                  ?>
                  <a class="header-home-button" href="<?php echo site_url() ?>">Home</a>
                  <?php
                }
                ?>
                
              </div>
            </div>
          </div>
          
        </div>
        
      </div>
    </nav>




    <div id="main-content">
    
        <?php include(APPPATH . "views/client/client_links.php") ?>
         <div class="container">
          <div class="row">
          <!-- <div class="col-md-12 col-md-offset-sidebar"> -->
            <div class="col-md-10">

        <?php if($this->settings->info->install) : ?>
          <div class="row">
            <div class="col-md-12">
                    <div class="alert alert-info"><b>NOTICE</b> - <a href="<?php echo site_url("install") ?>">Great job on uploading all the files and setting up the site correctly! Let's now create the Admin account and set the default settings. Click here! This message will disappear once you have run the install process.</a></div>
            </div>
        </div>
        <?php endif; ?>
      <?php $gl = $this->session->flashdata('globalmsg'); ?>
        <?php if(!empty($gl)) :?>
          <div class="alert alert-success"><b><span class="glyphicon glyphicon-ok"></span></b> <?php echo $this->session->flashdata('globalmsg') ?></div>
        <?php endif; ?>

     

        <?php echo $content ?>

      </div>
      <div class="col-md-2">
            <div class="sidebar">
      <?php if(isset($sidebar)) : ?>
          <?php echo $sidebar ?>
        <?php endif; ?>
          <?php include(APPPATH . "views/client/friends_bar.php") ?>
    </div>
      </div>
    <!-- </div> -->
  </div>


    </div>

    <?php include(APPPATH . "views/client/chat.php"); ?>

    <!--<div id="footer" class="clearfix">-->
    <!--  <span class="pull-left"> <a href="<?php echo site_url("home/change_language") ?>"><?php echo lang("ctn_171") ?></a></span>-->
    <!--</div>-->

    <!-- SCRIPTS -->
     <script src="<?php echo base_url();?>scripts/custom/global.js"></script>
    <script src="<?php echo base_url();?>scripts/libraries/jquery.nicescroll.min.js"></script>
    <script type="text/javascript">
      $.widget.bridge('uitooltip', $.ui.tooltip);
    </script>
    
    <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>

     <script type="text/javascript">
            $(document).ready(function() {
              $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
        <?php if(isset($datetimepicker) && !empty($datetimepicker)) : ?>
        <script type="text/javascript">
          jQuery.datetimepicker.setLocale('<?php echo $datetimepicker ?>');
        </script>
        <?php endif; ?>
    <script type="text/javascript">
     $(document).ready(function() {

        // Get sidebar height
       resize_layout();

        $('.nav-sidebar li').on('shown.bs.collapse', function () {
           $(this).find(".glyphicon-menu-right")
                 .removeClass("glyphicon-menu-right")
                 .addClass("glyphicon-menu-down");
            resize_layout();
        });
        $('.nav-sidebar li').on('hidden.bs.collapse', function () {
           $(this).find(".glyphicon-menu-down")
                 .removeClass("glyphicon-menu-down")
                 .addClass("glyphicon-menu-right");
            resize_layout();
        });

        function resize_layout() 
        {
          var sb_h = $('.sidebar').height();
          var mc_h = $('#main-content').height();
          var w_h = $(window).height();
          $('.sidebar').height($(window).height());
          if(sb_h > mc_h) {
            $('#main-content').css("min-height", sb_h+50 + "px");
          }
          if(w_h > mc_h) {
            $('#main-content').css("min-height", (w_h-(51+30)) +"px");
          }
        }
     });
    </script>
    </body>
</html>