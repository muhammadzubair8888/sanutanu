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
                        
                        <div class="row demo-wrap upload-demo">
                            
                            
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
                                    <button class="btn btn-success upload-result">Save</button>
                                    <button class="btn btn-danger " data-dismiss="modal">Cancel</button>
                                    <!-- <img src="" id="myprofilecroped" width="150" height="150"> -->
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


        function readFile2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            alert('ok');
            reader.onload = function (e) {
                //alert('ok');
             var coverphoto = e.target.result
                //console.log();
                alert(coverphoto);

                $.ajax({
                    url: "<?php echo base_url('index.php/user_settings/cover_pic_upload'); ?>",
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

        $('#coverupload').on('change', function () { readFile2(this);  });
        $('#profileupload').on('change', function () { readFile(this);  });
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
                //alert(resp);
                //alert(global_base_url);
                $.ajax({
                    url: "<?php echo base_url('index.php/user_settings/profile_pic_upload'); ?>",//global_base_url + 'user_settings/profile_pic_upload',
                    type: "POST",
                    data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',fullpic: fullpic, capturedpic: capturedpic},
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




    

    function init() {
        bindNavigation();
        demoUpload();
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
function profilepicpopup_modal()
{
    $('#profileupload').click();
    $('#profilepicpopup').modal('show');
}

function change_cover()
{
    $('#coverupload').click();
}

</script>