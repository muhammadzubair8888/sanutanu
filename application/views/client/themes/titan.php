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
        <!-- <link href="<?php echo base_url();?>styles/client/themes/titan/responsive.css" rel="stylesheet" type="text/css"> -->
        <link href="<?php echo base_url();?>styles/client/themes/titan/mobile.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="<?php echo base_url();?>sweatalert/sweetalert.css">
                <script src="<?php echo base_url();?>sweatalert/sweetalert.js"></script>
        
        <!-- <link href="<?php echo base_url();?>styles/client/responsive.css" rel="stylesheet" type="text/css"> -->
        
        <link href="<?php echo base_url();?>styles/client/elements.css" rel="stylesheet" type="text/css">
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,500,550,600,700' rel='stylesheet' type='text/css'>
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
 <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyBipO3Bxb7dzzAJb5WwaXJ5CuRh4EU1i8k&libraries=places"></script>
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

      <link rel="stylesheet"  href="<?php echo base_url() ?>styles/croppie.css" />
      <script src="<?php echo base_url() ?>scripts/libraries/croppie.js"></script>

        
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

        <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.1.45/css/materialdesignicons.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/display.css">
        <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/js/bootstrap-editable.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>scripts/libraries/msdropdown/dd.css" />
    <script src="<?php echo base_url() ?>scripts/libraries/msdropdown/jquery.dd.min.js"></script>

    
    
<?php $themecolor = $this->settings->info->color; ?>
<style type="text/css">
  .navbar-brand{ color: <?php echo $themecolor; ?> !important; }
  #homepage-links ul li.active a{ color: <?php echo $themecolor; ?> !important; }
  .sidebaricon{ color: <?php echo $themecolor; ?> !important; }
  .postboxbutton{ color: <?php echo $themecolor; ?> !important; }
  .feed-header-info p a{ color: <?php echo $themecolor; ?> !important; }
  .active-like{ color: <?php echo $themecolor; ?> !important; }
  .feed-content-stats a span{ color: <?php echo $themecolor; ?> !important; }
  .btn-post { background-color: <?php echo $themecolor; ?> !important; }
  .active_chat_window .chat-top-bar {
    background:  <?php echo $themecolor; ?> !important;}
    .chat-user-title a {color:<?php echo $themecolor; ?> !important;}
    .profile-header-bar .active a { color:<?php echo $themecolor; ?> !important;}
   }
.profile-header-bar ul li a {color:<?php echo $themecolor; ?> !important;}
.profile-friend-area p a {color: <?php echo $themecolor; ?> !important;}
.chat-user-title { color: <?php echo $themecolor; ?> !important;}
.paginate_button.active a {
    background-color: <?php echo $themecolor; ?> !important;}
    .profile-header-bar ul li a {
    color: <?php echo $themecolor; ?> !important;}

    /*admin side*/
    .inner-sidebar-links .active a {
    background: <?php echo $themecolor; ?> !important;}
    .breadcrumb li a {
    color: <?php echo $themecolor; ?> !important;}
    .btn-post {
    background-color: <?php echo $themecolor; ?> !important;}
   /*settings*/
   ul.settings-sidebar li a {
    color: <?php echo $themecolor; ?> !important;

}
.panel-body .form-group a {
    color: <?php echo $themecolor; ?> !important;
}
/*login button*/
.btn.btn-primary {
    background: <?php echo $themecolor; ?> !important;}
    .btn-flat-login {
    background:<?php echo $themecolor; ?> !important; }
    .btn-post {
    background-color: <?php echo $themecolor; ?> !important;
    
}
.tt-suggestion:hover, .tt-suggestion:hover .smtext { background-color: <?php echo $themecolor; ?> !important; }
.tt-suggestion.tt-cursor, .tt-suggestion.tt-cursor .smtext { background-color: <?php echo $themecolor; ?> !important; }
#aboutpopup .modal-dialog:after{ border-right-color: <?php echo $themecolor; ?> !important; }
#aboutpopup .modal-dialog:before{ border-left-color: <?php echo $themecolor; ?> !important; }
.custom-modal-header{color:<?php echo $themecolor; ?> !important;}
.ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus
{
  background:<?php echo $themecolor; ?> !important;
  border-color:<?php echo $themecolor; ?> !important;
}
.searchTerm:focus{
  color: <?php echo $themecolor; ?> !important;
}
</style>
    </head>
    <body>

    <nav class="navbar navbar-fixed-top test" style="background: #FFF; z-index: 3;">
      <div class="container">
        <div class="row">
          <div class="col-md-10 mainbar">
            <div class="row">
              <div class="col-md-2" style=" height: 50px; padding: 0;">
                <?php if($this->settings->info->logo_option) : ?>
              <a class="navbar-brand-two" href="<?php echo site_url() ?>" title="<?php echo $this->settings->info->site_name ?>">
                <img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->settings->info->site_logo ?>" height="26">
              </a>
            <?php else : ?>
              <a class="navbar-brand" href="<?php echo site_url() ?>" title="<?php echo $this->settings->info->site_name ?>"><?php echo $this->settings->info->site_name ?></a>
            <?php endif; ?>
            <div class="clearfix"></div>
              </div>
              <div class="col-md-6 " style="padding-top: 8px; height: 50px;">
                <?php include(APPPATH . "views/search/searchform.php"); ?>
              </div>
              <div class="col-md-4" style="padding-top: 8px; height: 50px;">


                    <div id="navbar" class="navbar-collapse collapse" style="margin-top: 0; height: 38px; line-height: 38px; padding-left: 0px; background: #FFF; border-radius: 4px; padding-right: 0px; border: 1px solid rgba(0,0,0,0.1);">
                      <ul class="nav navbar-nav navbar-right" style="text-align: center; margin-right: 0; ">
                        <!-- <li> -->
                          <!-- <?php /*echo form_open(site_url(), array("class"=>"navbar-form")) ?>
                          <div class="form-group">
                            <input type="text" class="form-control" placeholder="<?php echo lang("ctn_76") ?> ..." id="search-complete" style="width:450px;">
                          </div>
                          <?php echo form_close()*/ ?> -->
                        <!-- </li> -->
                      <?php if($this->user->loggedin) : ?>
                        <!-- <li><a href="<?php //echo site_url() ?>"><span class="glyphicon glyphicon-home notification-icon"></span></a></li> -->
                        <li class="user_bi" style="padding-right: 0px; text-align: left; flex: auto;"><a class="toplinkbtn" href="<?php echo site_url("profile/" . $this->user->info->username) ?>" style="width: 100%;"><img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->user->info->avatar ?>" class="user_avatar"> &nbsp; <?php if($this->settings->info->user_display_type) : ?>
                          <?php echo $this->user->info->first_name ?> <?php echo $this->user->info->last_name ?>
                          <?php else : ?>
                          <?php echo $this->user->info->first_name ?>
                          <?php endif; ?></a></li>

                        <li class="topbar-right" style="  padding-right: 0px; text-align: left; flex: auto;"><a class="toplinkbtn" href="<?php echo site_url("home") ?>" style="width: 100%;"> <?php echo lang('ctn_2'); ?> </a></li>

                        <li class="topbar-right" style=" flex: auto;"><a href="#" class="toplinkbtn" data-target="#" onclick="load_notifications()" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="noti-menu-drop" style="width: 34px; background: #FFF !important;"><span class="fa fa-bell notification-icon"></span><?php if($this->user->info->noti_count > 0) : ?><span class="badge notification-badge small-text"><?php echo $this->user->info->noti_count ?></span><?php endif; ?></a>
                    
                        <ul class="dropdown-menu" aria-labelledby="noti-menu-drop">
                        <div class="notify-arrow notify-arrow-blue"></div>
                        <li>
                        <div class="notification-box-title">
                        <?php echo lang("ctn_412") ?> <?php if($this->user->info->noti_count > 0) : ?><span class="badge click" id="noti-click-unread" onclick="load_notifications_unread()"><?php echo $this->user->info->noti_count ?></span><?php endif; ?>
                        </div>
                        <div id="notifications-scroll">
                          <div id="loading_spinner_notification">
                            <span class="glyphicon glyphicon-refresh" id="ajspinner_notification"></span>
                          </div>
                        </div>
                        <div class="notification-box-footer">
                        <a href="<?php echo site_url("home/notifications") ?>"><?php echo lang("ctn_414") ?></a>
                        </div>
                      </li>
                      </ul>
                      </li>
                        <li class="topbar-right" style=" flex: auto;"><a href="#" class="toplinkbtn" data-target="#" onclick="load_chats()" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="email-menu-drop" style="width: 34px; background: #FFF !important; border-radius: 5px;"><span class="fa fa-comment-dots notification-icon"></span><span class="badge notification-badge small-text" id="chat-noti"></span></a>

                        <ul class="dropdown-menu" aria-labelledby="email-menu-drop">
                        <div class="notify-arrow notify-arrow-blue"></div>
                        <li>
                          <div class="notification-box-title">
                            <?php echo lang("ctn_489") ?> - <a href="<?php echo site_url("chat") ?>"><?php echo lang("ctn_482") ?></a>
                            </div>
                            <div id="chat-scroll">
                              <div id="loading_spinner_email">
                                <span class="glyphicon glyphicon-refresh" id="ajspinner_email"></span>
                              </div>
                            </div>
                            <div class="notification-box-footer">
                            <a href="#" id="chat-click-more" onclick="load_chat_page()"><?php echo lang("ctn_490") ?></a>
                          </div>
                        </li>
                        </ul>

                        </li>
                        <!-- <li class="user_bit"><a href="javascript:void(0)" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="glyphicon glyphicon-chevron-down notification-icon"></span></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                          <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
                          <li><a href="<?php echo site_url("profile/" . $this->user->info->username) ?>"><?php echo lang("ctn_491") ?></a></li>
                          <li><a href="<?php echo site_url("pages/your") ?>"><?php echo lang("
                          ctn_492"); ?><?php echo lang("ctn_492") ?></a></li>
                          <li><a href="<?php echo site_url("profile/friends/" . $this->user->info->ID) ?>"><?php echo lang("ctn_493") ?></a></li>
                          <li><a href="<?php echo site_url("user_settings") ?>"><?php echo lang("ctn_156") ?></a></li>
                          
                          <?php if($this->common->has_permissions(array("admin", "admin_members", "admin_payment", "admin_settings"), $this->user)) : ?>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_157") ?></a></li>
                          <?php endif; ?>
                        </ul></li> -->
                        <!-- <li style="display: inline-block; float: inherit;"><a class="toplinkbtn" href="<?php echo site_url("login/logout/" . $this->security->get_csrf_hash()) ?>" title="<?php echo lang("ctn_149") ?>" style="padding-top: 6px !important;"><?php echo lang("ctn_149") ?></a></li> -->
                      <?php else : ?>
                      <li style="display: inline-block; float: inherit;"><a class="toplinkbtn" href="<?php echo site_url("login") ?>"><?php echo lang("ctn_150") ?></a></li>
                        <li style="display: inline-block; float: inherit;"><a class="toplinkbtn" href="<?php echo site_url("register") ?>"><?php echo lang("ctn_151") ?></a></li>
                      <?php endif; ?>
                      </ul>
                    </div>





                </div>
                
              </div>
            </div>

            <div class="col-md-2 rightbar"></div>

          </div>

          


          
        </div>
        
      </div>
    </nav>




    <div id="main-content">
    
        <?php include(APPPATH . "views/client/client_links.php") ?>
        <?php if($this->uri->segment(2)=='stories'): $fluid = '-fluid'; $container_col = '12'; else: $fluid = ''; $container_col = '10'; endif; ?>
         <div class="container<?php echo $fluid; ?>">

          <div class="row">
          <!-- <div class="col-md-12 col-md-offset-sidebar"> -->
            <div class="col-md-<?php echo $container_col; ?> mainbar">

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
      <?php if($this->uri->segment(2)!='stories' && $this->uri->segment(1)!='privacy'): ?>
      <div class="col-md-2 rightbar">
            <div class="sidebar">
      <?php if(isset($sidebar)) : ?>
          <?php echo $sidebar ?>
        <?php endif; ?>
          <?php include(APPPATH . "views/client/friends_bar.php") ?>
    </div>
      </div>
    <?php endif; ?>
    <!-- </div> -->
  </div>


    </div>
    <?php include(APPPATH . "views/modal/post_modal.php"); ?>
    <?php include(APPPATH . "views/modal/about_modal.php"); ?>
    <?php include(APPPATH . "views/modal/call_modal.php"); ?>
    <?php if($this->uri->segment(2)=='stories'): ?>
      <?php include(APPPATH . "views/modal/editor_modal.php"); ?>
    <?php endif; ?>
    <?php include(APPPATH . "views/modal/upload_profile_modal.php"); ?>
    <?php include(APPPATH . "views/modal/report_abuse_modal.php"); ?>
    <?php include(APPPATH . "views/client/chat.php"); ?>

    <!--<div id="footer" class="clearfix">-->
    <!--  <span class="pull-left"> <a href="<?php //echo site_url("home/change_language") ?>"><?php //echo lang("ctn_171") ?></a></span>-->
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
    <script>
$(function() {
    
    $(document).on('keydown.autocomplete', function()
  {
    $('.autocomplete').autocomplete({
      source: function( request, response ) {
          var uri = this.element.attr('data-uri');
          //alert(uri);
          //console.log(request.term);
        $.ajax({
            dataType: "json",
            type : 'POST',
            url: '<?php echo site_url('search/'); ?>' + uri,
            data:
            {
                query: request.term,
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',
            },
            success: function(data) { 
                //console.log(data);
                response(data);
            },
            error: function(data) { 
            }
        });
    },
    minLength: 1,
    html: true,
            select: function (event, ui) {
              var t = $(this).attr('data-template');
              //console.log(ui.item);
              if(t=='city')
              {
                $('#city').val(remove_linebreaks(ui.item.label));
              }
              if(t=='group')
              {
                $('#group').val( remove_linebreaks(ui.item.ID) );
              }
              if(t=='school')
              {
                $('#edu').val( remove_linebreaks(ui.item.label) );
              }
              if(t=='work')
              {
                $('#work').val( remove_linebreaks(ui.item.label) );
              }
              if(t=='source'){
                // The property exists
                //remove_linebreaks(ui.item);
                console.log(ui.item);
                $('#from').val(ui.item.ID);
                $('#fromtype').val(ui.item.type);
              }

              if ( typeof searchinfo == 'function' ) {
                searchinfo();
              }
            },
            focus: function (event, ui) {
            },
            change: function (event, ui) {
            },
            close: function (event, ui) {},
            search: function (event, ui) {},
            response: function (event, ui) {},
            open: function(e,ui) {
                /*var acData = $(this).data('ui-autocomplete');
                    acData
                    .menu
                    .element
                    .find('li')
                    .each(function () {
                        var me = $(this);
                        var keywords = acData.term.split(' ').join('|');
                        me.html(me.text().replace(new RegExp("(" + keywords + ")", "gi"), '<b>$1</b>'));
                     });*/
            },
            create: function () {
                var t = $(this).attr('data-template');
                $(this).data('ui-autocomplete')._renderItem = function (ul, item) {
                    if(t == "school") {
                        return $(`<li class="ui-menu-item" role="presentation">

                            <a id="ui-id-3" class="ui-corner-all" tabindex="-1">
                            <div style="display: flex;">
                            <div style="border:1px solid #CCC; width: 35px; border-radius: 4px; overflow: hidden;">
                                <img src="<?php echo base_url('images/school.jpg'); ?>" width="100%" height="100%" />
                            </div> 
                            <div style="padding-left:5px;">`+item.label+`</div>
                            </div>
                            </a>
                            </li>`)
                            .appendTo(ul);
                    } else if(t == "work") {
                        return $(`<li class="ui-menu-item" role="presentation">
                            <a id="ui-id-3" class="ui-corner-all" tabindex="-1">
                            <div style="display: flex;">
                            <div style="border:1px solid #CCC; width: 35px; border-radius: 4px; overflow: hidden;">
                                <img src="<?php echo base_url('images/office.jpg'); ?>" width="100%" height="100%" />
                            </div>
                             <div style="padding-left:5px;">`+item.label+`</div>
                             </div>
                             </a>
                             </li>`)
                            .appendTo(ul);
                    } else if(t == "city") {
                        return $(`<li class="ui-menu-item" role="presentation">
                            <a id="ui-id-3" class="ui-corner-all" tabindex="-1">
                            <div style="display: flex;">
                            <div style="border:1px solid #CCC; width: 35px; border-radius: 4px; overflow: hidden;">
                                <img src="<?php echo base_url('images/location.png'); ?>" width="100%" height="100%" />
                            </div>
                             <div style="padding-left:5px;">`+item.city+`, `+item.state+`, `+item.country+`</div>
                             </div>
                             </a>
                             </li>`)
                            .appendTo(ul);
                    } else if(t == "state") {
                        return $(`<li class="ui-menu-item" role="presentation">
                            <a id="ui-id-3" class="ui-corner-all" tabindex="-1">
                            <div style="display: flex;">
                            <div style="border:1px solid #CCC; width: 35px; border-radius: 4px; overflow: hidden;">
                                <img src="<?php echo base_url('images/location.png'); ?>" width="100%" height="100%" />
                            </div>
                             <div style="padding-left:5px;">`+item.state+`, `+item.country+`</div>
                             </div>
                             </a>
                             </li>`)
                            .appendTo(ul);
                    } else if(t == "country") {
                        return $(`<li class="ui-menu-item" role="presentation">
                            <a id="ui-id-3" class="ui-corner-all" tabindex="-1">
                            <div style="display: flex;">
                            <div style="border:1px solid #CCC; width: 35px; border-radius: 4px; overflow: hidden;">
                                <img src="<?php echo base_url('images/location.png'); ?>" width="100%" height="100%" />
                            </div>
                             <div style="padding-left:5px;">`+item.label+`</div>
                             </div>
                             </a>
                             </li>`)
                            .appendTo(ul);
                    } else if(t == "source") {
                        return $(`<li class="ui-menu-item" role="presentation" style="min-width:300px;">
                            <a id="ui-id-3" class="ui-corner-all" tabindex="-1" style="display:flex; align-items:center; font-family: Arial;">
                              <div style="margin-right: 15px; width: 40px; height: 40px;">
                                <img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative; ?>/`+item.avatar+`" style="border-radius: 50%; width: 100%; height: 100%;">
                              </div>
                              <div style="font-size:12px;">
                                <b>`+item.label+`</b>
                                <div>`+item.detail+`</div>
                              </div>
                             </a>
                             </li>`)
                            .appendTo(ul);
                    }
                    else {
                        return $(`<li class="ui-menu-item" role="presentation"><a id="ui-id-3" class="ui-corner-all" tabindex="-1">`+item.label+`</a></li>`)
                            .appendTo(ul);
                    }
                };
            }
    
    });
    
    
    });
    
});

function remove_linebreaks( message ) {
      return message.replace( /[\r\n]+/gm, "" );
  }
</script>
    <div id="status-overlay" style="display: none"></div>
    <input type="hidden" id="calltimer" value="0">
    <input type="hidden" id="callerid" value="" />
    <input type="hidden" id="calltype" value="" />
    </body>
</html>
<script type="text/javascript">
 
var start_video_call_window = function(userid,chatid)
{
  var calltype = 'video';
  var callerid = userid;
  var url = '<?php echo site_url('chat/call/'); ?>'+calltype+'/'+callerid+'/1';
  var child_w = popupWindow(url, 'Call', 500, 400);
  child_w.onbeforeunload = function(){ 
    publish('cancel-call', null, userid); 
  };
  setTimeout(function(){ 
    publish('start-call', {type: calltype}, userid); 
    $('#callerid').val(userid);
    $('#calltype').val(calltype);
    send_chat_message(chatid, userid, 'New video call from <?php echo $this->user->info->first_name.' '.$this->user->info->last_name; ?>');
  }, 1000);

  setTimeout(function(){
    if($('#calltimer').val()==0)
    {
      publish('cancel-call', null, userid);
    }
  }, (1000*30));
}

var start_audio_call_window = function(userid,chatid)
{
  var calltype = 'audio';
  var callerid = userid;
  var url = '<?php echo site_url('chat/call/'); ?>'+calltype+'/'+callerid+'/1';
  var child_w = popupWindow(url, 'Call', 500, 400);
  child_w.onbeforeunload = function(){ publish('cancel-call', null, userid); };
  setTimeout(function(){ 
    publish('start-call', {type: calltype}, userid);
    $('#callerid').val(userid);
    $('#calltype').val(calltype);
    send_chat_message(chatid, userid, 'New Audio call from <?php echo $this->user->info->first_name.' '.$this->user->info->last_name; ?>');
  }, 1000);

  setTimeout(function(){
    publish('cancel-call', null, userid);
  }, (1000*30));
}

var ws = new WebSocket('ws://192.168.10.102:1900');

ws.onopen = function() {
console.info("Connected.");
//sendMessage('setName', userName);
};

ws.onmessage = function(e) {
  var data = JSON.parse(e.data);
  if(data.event == 'start-call' && data.to == '<?php echo $this->user->info->ID; ?>')
  {
    if($('#calltimer').val()==0)
    {
      $('#callerid').val(data.from);
      $('#calltype').val(data.data.type);
      call_modal(data.from, data.data.type);
    }
    else
    {
      publish('busy',null,data.from);
    }
    
  }
  if(data.event == 'cancel-call' && ((data.to == '<?php echo $this->user->info->ID; ?>' && data.from == $('#callerid').val()) || (data.from == '<?php echo $this->user->info->ID; ?>' && data.to == $('#callerid').val()) ) )
  {
    $('#callpopup').modal('hide');
    $('#calltype').val('');
    $('#callerid').val('');
    $('.ringtone')[0].pause();
    $('#calltimer').val(0);
  }
  if(data.event=='timer' && ((data.to == '<?php echo $this->user->info->ID; ?>' && data.from == $('#callerid').val()) || (data.from == '<?php echo $this->user->info->ID; ?>' && data.to == $('#callerid').val()) ) )
  {
    $('#calltimer').val(1);
  }
  //onsinglemessage( decodeURIComponent( escape ( e.data ) ) );
}

ws.onclose = function(event) {
/*if (event.wasClean) {
  //console.info('clouse conecting');
} else {
  //location = location;
  //console.warn('server disconected');
}*/
//console.info('Code: ' + event.code + ' Msg: ' + event.reason);
};

callresponse = function(r){
  if(r==1)
  {
    var calltype = $('#calltype').val();
    var callerid = $('#callerid').val();
    var url = '<?php echo site_url('chat/call/'); ?>'+calltype+'/'+callerid+'/2';
    //window.open(url, 'child', '"width=350, height=300"');
    if(calltype=='audio')
    {
      var h = 400;
    }
    else
    {
      var h = 400;
    }
    var child_w = popupWindow(url, 'Call', 500, h);
    child_w.onbeforeunload = function(){ publish('cancel-call', null, callerid); };
    //child_w.onunload = function(){ child_w.startcall(); };
    setTimeout(function(){ child_w.startcall(); }, 3000);
  }
  if(r==0)
  {
    publish('cancel-call', null, callerid);
  }
  $('#callpopup').modal('hide');
  $('#calltype').val('');
  $('#callerid').val('');
  $('.ringtone')[0].pause();
}
      
function publish(event, data, to) {
        //console.log("sending ws.send: " + event);
        var senddata = JSON.stringify({
            event:event,
            data:data,
            to: to,
            from: '<?php echo $this->user->info->ID; ?>'
        });
        var encdata = unescape( encodeURIComponent( senddata ));
        //console.log(encdata);
        ws.send( encdata );
    }

function popupWindow(url, title, w, h) {
    const y = window.top.outerHeight / 2 + window.top.screenY - ( h / 2);
    const x = window.top.outerWidth / 2 + window.top.screenX - ( w / 2);
    return window.open(url, title, `directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no, width=${w}, height=${h}, top=${y}, left=${x}`);
}
</script>
