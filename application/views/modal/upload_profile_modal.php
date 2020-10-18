<div id="profilepicpopup" class="modal fade in" role="dialog">
    <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content row">
            <div class="custom-modal-header" style="background: #333;">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <!-- <h4 class="modal-title">Enquire Now</h4> -->
            </div>
            <div class="modal-body" id="sanutanu_profile_popup" style="padding-top: 0;">
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="row demo-wrap upload-demo profile_pic_crop" style="display: none;">
                            
                            
                            <div class="col-md-12" style="padding-bottom: 50px; background: #333;">
                                <div class="upload-msg">
                                    Upload a file to start cropping
                                </div>
                                <div class="upload-demo-wrap">
                                    <div id="upload-demo"></div>
                                </div>
                            </div>

                            <div class="col-md-12" style="padding: 10px;" align="center">
                                <div class="actions">
                                    <div style="display: none;">
                                        <a class="btn file-btn">
                                            <strong>Upload: </strong>
                                            <input type="file" id="profileupload" name="profileupload" value="" accept="image/*" />
                                        </a>
                                    </div>
                                    
                                    <!-- <br /><br /> -->
                                    <!-- <div class="myprofilecroped"></div> -->
                                    <input type="hidden" id="profilecaptured" name="profilecaptured" />
                                    <input type="hidden" name="fullprofilepic" id="fullprofilepic" />
                                    <input type="hidden" name="profile_imageid" id="profile_imageid" />
                                    <button class="btn btn-success upload-result">Save</button>
                                    <button class="btn btn-danger " data-dismiss="modal">Cancel</button>
                                    <!-- <img src="" id="myprofilecroped" width="150" height="150"> -->
                                </div>
                            </div>
                            

                        </div>
                        <div class="profile_oldpics" style="padding: 10px;">
                            <div class="row">
                                <div class="col-md-12" style="padding: 10px;" align="center">
                                    <button type="button" onclick="profilepicupload_click();" class="btn btn-info"><i class="glyphicon glyphicon-plus"></i> Upload Photo</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 profile_oldpicsload" style="max-height: 400px; overflow-y: auto;">
                                    <?php
                                    /*$userid = $this->user->info->ID;
$pics = $this->db->order_by("ID", "desc")->get_where('user_images',array('userid'=>$userid))->result_array();
foreach ($pics as $pic) {
    ?>
<div class="col-lg-3 col-sm-4 col-xs-6" style="height: 100px;  overflow: hidden; margin-bottom: 6px;"><img class="thumbnail img-responsive profilethumbnail" onclick="set_imageid(<?php echo $pic['ID']; ?>);" src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $pic['file_name']; ?>" style="width: 100%; height: 100px; object-fit: cover; cursor: pointer;" ></div>
    <?php
}*/
                                    ?>
                                    
                                </div>
                            </div>
                              
                        </div>

                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
</div>

<style type="text/css">
#profilepicpopup .modal-dialog {
    width: 50%;
    max-height: 100%;
    padding: 0px ;
    position: relative;
}
#profilepicpopup .modal-dialog:before {
    content: '';
    height: 0px;
    width: 0px;
    border-left: 50px solid #a41be3;
    border-right: 50px solid transparent;
    border-bottom: 50px solid transparent;
    position: absolute;
    top: 1px;
    left: -14px;
    z-index: 99;
}

.custom-modal-header {
    text-align: center;
    color: #a41be3;
    text-transform: uppercase;
    letter-spacing: 2px;
    border-top: 4px solid;
}

#profilepicpopup .modal-dialog .close {
    z-index: 99999999;
    color: white;
    text-shadow: 0px 0px 0px;
    font-weight: normal;
    top: 4px;
    right: 6px;
    position: absolute;
    opacity: 1;
}

.custom-modal-header .modal-title {
    /* font-weight: bold; */
    font-size: 18px;
}

.custom-modal-body {
    padding-bottom: 40px;
}

#profilepicpopup .modal-dialog:after {
    content: '';
    height: 0px;
    width: 0px;
    /* border-right: 50px solid rgba(255, 0, 0, 0.98); */
    border-right: 50px solid #a41be3;
    border-bottom: 50px solid transparent;
    position: absolute;
    top: 1px;
    right: -14px;
    z-index: 999999;
}

#profilepicpopup .form-group {
    margin-bottom: 15px !important;
}

#profilepicpopup .form-inline .form-control {
    display: inline-block;
    width: 100%;
    vertical-align: middle;
}
#profilepicpopup .feed-comments-spot {
    max-height: 190px;
    overflow-y: auto;
}

.upload-demo .upload-demo-wrap,
.upload-demo .upload-result,
.upload-demo.ready .upload-msg {
    display: none;
}
.upload-demo.ready .upload-demo-wrap {
    display: block;
}
.upload-demo.ready .upload-result {
    display: inline-block;    
}
.upload-demo-wrap {
    width: 100%;
    height: 400px;
    margin: 0 auto;
}

.upload-msg {
    text-align: center;
    padding: 50px;
    font-size: 22px;
    color: #aaa;
    width: 260px;
    margin: 50px auto;
    border: 1px solid #aaa;
}

</style>
<script type="text/javascript">
    

    var Demo = (function() {

    function output(node) {
        var existing = $('#result .croppie-result');
        if (existing.length > 0) {
            existing[0].parentNode.replaceChild(node, existing[0]);
        }
        else {
            $('#result')[0].appendChild(node);
        }
    }

    function popupResult(result) {
        var html;
        if (result.html) {
            html = result.html;
        }
        if (result.src) {
            html = '<img src="' + result.src + '" />';
        }
        swal({
            title: '',
            html: true,
            text: html,
            allowOutsideClick: true
        });
        setTimeout(function(){
            $('.sweet-alert').css('margin', function() {
                var top = -1 * ($(this).height() / 2),
                    left = -1 * ($(this).width() / 2);

                return top + 'px 0 0 ' + left + 'px';
            });
        }, 1);
    }

    function demoUpload() {
        var $uploadCrop;

        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('.upload-demo').addClass('ready');
                    $uploadCrop.croppie('bind', {
                        url: e.target.result
                    }).then(function(){
                        console.log('jQuery bind complete');
                    });
                    //console.log();
                    $('#fullprofilepic').val(e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
            else {
                alert("Sorry - you're browser doesn't support the FileReader API");
            }
        }

        function readFilePost(filepath)
        {
            $('.upload-demo').addClass('ready');
            $uploadCrop.croppie('bind', {
                url: filepath
            }).then(function(){
                console.log('jQuery bind complete');
            });

            $('.profile_oldpics').hide();
            $('.profile_pic_crop').show();
        }


        function readFile2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                //alert('ok');
                reader.onload = function (e) {
                    //alert('ok');
                 var coverphoto = e.target.result
                    //console.log();
                    //alert(coverphoto);

                <?php
                if($this->uri->rsegment(1)=='pages')
                {
                ?>
                  var uri = "<?php echo base_url('index.php/pages/cover_pic_upload/'.$page->ID); ?>";
                <?php
                }
                else if($this->uri->rsegment(1)=='groups')
                {
                ?>
                  var uri = "<?php echo base_url('index.php/groups/cover_pic_upload/'.$group->ID); ?>";
                <?php
                }
                else
                {
                ?>
                  var uri = "<?php echo base_url('index.php/user_settings/cover_pic_upload'); ?>";
                <?php
                }
                ?>

                    $.ajax({
                        url: uri,
                        type: "POST",
                        data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>','coverphoto': coverphoto},
                        success: function (response) {
                            window.location.reload();
                            //alert(response);
                        }
                    });

                }
                
                reader.readAsDataURL(input.files[0]);
            }
            else {
                alert("Sorry - you're browser doesn't support the FileReader API");
            }
        }


        $uploadCrop = $('#upload-demo').croppie({
            viewport: {
                width: 300,
                height: 300,
                type: 'circle'
            },
            enableExif: true
        });

        $(document).on('click','.profilethumbnail', function(){ readFilePost(this.src); });
        $('#coverupload').on('change', function () { readFile2(this);  });
        $('#profileupload').on('change', function () { 
            $('.profile_oldpics').hide();
            $('.profile_pic_crop').show();
            $('#profile_imageid').val("");
            readFile(this);
        });
        $('.upload-result').on('click', function (ev) {
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (resp) {
                /*popupResult({
                    src: resp
                });*/
                /*var img = '<img src="' + resp + '" />';
                $('.myprofilecroped').html(img);*/
                $('#profilecaptured').val(resp);
                //alert($('#fullprofilepic').val());
                //alert($('#profilecaptured').val());
                var fullpic = $('#fullprofilepic').val();
                var capturedpic = $('#profilecaptured').val();
                var profile_imageid = $('#profile_imageid').val();
                <?php
                if($this->uri->rsegment(1)=='pages')
                {
                ?>
                  var uri = "<?php echo base_url('index.php/pages/profile_pic_upload/'.$page->ID); ?>";
                <?php
                }
                else
                {
                ?>
                  var uri = "<?php echo base_url('index.php/user_settings/profile_pic_upload'); ?>";
                <?php
                }
                ?>
                
                //alert(resp);
                //alert(global_base_url);
                $.ajax({
                    url: uri,//global_base_url + 'user_settings/profile_pic_upload',
                    type: "POST",
                    data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',fullpic: fullpic, capturedpic: capturedpic, profile_imageid: profile_imageid},
                    success: function (response) {
                        window.location.reload();// = '<?php echo current_url()?>';
                        //alert(response);
                        //$('.subjects_select').html(response);
                        //$('.subjects_select').multiSelect('refresh');
                    }
                });


            });
        });
    }

    function bindNavigation () {
        var $body = $('body');
        $('nav a').on('click', function (ev) {
            var lnk = $(ev.currentTarget),
                href = lnk.attr('href'),
                targetTop = $('a[name=' + href.substring(1) + ']').offset().top;

            $body.animate({ scrollTop: targetTop });
            ev.preventDefault();
        });
    }


    function reset_modal_form()
    {
        $('#profilepicpopup').on('hide.bs.modal', function () { 
            $('#profileupload').val('');
            $('#profile_imageid').val("");
            $('.profile_pic_crop').hide();
            $('.profile_oldpics').show();
        });
    }

    

    function init() {
        bindNavigation();
        demoUpload();
        reset_modal_form();
    }

    return {
        init: init
    };
})();


// Full version of `log` that:
//  * Prevents errors on console methods when no console present.
//  * Exposes a global 'log' function that preserves line numbering and formatting.
(function () {
  var method;
  var noop = function () { };
  var methods = [
      'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
      'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
      'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
      'timeStamp', 'trace', 'warn'
  ];
  var length = methods.length;
  var console = (window.console = window.console || {});
 
  while (length--) {
    method = methods[length];
 
    // Only stub undefined methods.
    if (!console[method]) {
        console[method] = noop;
    }
  }
 
 
  if (Function.prototype.bind) {
    window.log = Function.prototype.bind.call(console.log, console);
  }
  else {
    window.log = function() { 
      Function.prototype.apply.call(console.log, console, arguments);
    };
  }
})();
Demo.init();
</script>
<script type="text/javascript">
function set_imageid(id)
{
    $('#profile_imageid').val(id);
}
function profilepicpopup_modal()
{
    $('#profilepicpopup').modal('show');
    <?php
    if($this->uri->rsegment(1)=='pages')
    {
    ?>
      var uri = "<?php echo base_url('index.php/pages/loadpicturesforprofile/'.$page->ID); ?>";
    <?php
    }
    else
    {
    ?>
      var uri = "<?php echo base_url('index.php/user_settings/loadpicturesforprofile'); ?>";
    <?php
    }
    ?>
    $.ajax({
        url: uri,//global_base_url + 'user_settings/profile_pic_upload',
        type: "GET",
        success: function (response) {
            //window.location.reload();// = '<?php echo current_url()?>';
            //alert(response);
            $('.profile_oldpicsload').html(response);
            //$('.subjects_select').multiSelect('refresh');
        }
    });
}

function profilepicupload_click()
{
    $('#profileupload').click();
}

function change_cover()
{
    $('#coverupload').click();
}

</script>