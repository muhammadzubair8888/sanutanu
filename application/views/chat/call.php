<?php
$to = $to;
$type = $type;
$id = $this->user->info->ID;
$user = @$this->user_model->get_user_by_id($to)->row();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/all.min.js"></script>
<script type="text/javascript">
    function closewindow()
    {
        window.close();
    }
</script>
<style type="text/css">
  div#informCustomer {
  height: 100%;
  width: 100%;
  text-align: center;
  background-color: white;
  padding-top: 15rem;
  z-index: 90;
  position: fixed;
  top: 0;
  left: 0;
}

.animcircle {
  color: #E42828;
  font-size: 4em;
}

span.connecttext {
  color: #9a9a9a;
  font-family: "Open Sans" !important;
  font-size: 2em;
}
.faa-burst.animated, .faa-burst.animated-hover:hover, .faa-parent.animated-hover:hover>.faa-burst {
    -webkit-animation: burst 2s infinite linear;
    animation: burst 2s infinite linear;
}
@keyframes burst{
0% {
    opacity: 1;
}
50% {
    -webkit-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5);
    opacity: .1;
}
100% {
    opacity: 1;
}
}
.call-btn{
  background: rgba(255,255,255,0.1);
  padding: 5px;
  font-size: 35px;
  border-radius: 5px;
}
.call-btn:hover{
  background: rgba(255,255,255,0.5);
}
</style>
</head>
<body style="margin: 0;" onload="$('.ringing')[0].play();">
<?php 
$hide = '';
if($ring==1): ?>
  <div id="informCustomer" data-placement="top" style=""><div class="animcircle"><i class="fas fa-dot-circle faa-burst animated"></i></div><span class="connecttext">Ringing…</span><div style=" text-align: center; position: absolute; font-size: 40px; right: 0px; left: 0; margin: auto; bottom: 10px;">
      <span class="fas fa-phone" style="color: red; cursor: pointer; margin: 3px; " onclick="publish('cancel-call', null);"></span>
    </div></div>
<audio class="ringing" id="ringing" src="<?php echo base_url('ringtones/ringing_tone.mp3'); ?>" loop></audio>
  <?php
$hide = 'display:none;';
  ?>
<?php endif; ?>
<?php 
$hidevideo = '';
$hideaudio = 'display:none;';
if($type=='audio'): 
  $hidevideo = 'display:none;';
  $hideaudio = '';
endif;
  ?>
<?php $avatar = base_url($this->settings->info->upload_path_relative.'/'.@$user->avatar); ?>
<div id="videocall" style="display: flex; position: relative; max-width: 100%; max-height: 100vh; margin: auto; margin-top: 0px; border-radius: 0; border: 5px solid #000;<?php echo $hide; ?>">
    <div id="localvidwrapper" style="width: 150px; height: auto; background: #000; position: absolute; top: 10px; right: 10px; border: 3px solid #000; border-radius: 3px;">
        <video id="localVideo" autoplay="true" muted="muted" style="width: 100%; height: auto;"></video>
    </div>


    <div class="audiodiv" style="text-align: center;width: 100%; height: auto; background: #000;<?php echo $hideaudio; ?> position: absolute;left: 0; right: 0; margin: auto; top: 50px;">
        <div><img src="<?php echo $avatar; ?>" width="100" /></div>
        <div style="font-weight: bold; color: #FFF;"><?php echo @$user->first_name.' '.@$user->last_name; ?></div>
    </div>


    <video id="remoteVideo" autoplay="true" style="width: 100%; height: calc(100vh - 10px); background: #000;"></video>
    <div style=" text-align: center; position: absolute; font-size: 20px; right: 0px; left: 0; margin: auto; bottom: 10px;">
      <span class="callbtn fas fa-phone-square hide" style="color: green; cursor: pointer; margin: 3px; " onclick="startcall();"></span>
      <span class="fas fa-phone call-btn" style="color: red; cursor: pointer; margin: 3px; " onclick="endcall();"></span>
      <span class="pull-right count-up" style="color: #FFF;">0:00</span>
    </div>
</div>
<script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
<script type="text/javascript">
    var ring = '<?php echo $ring; ?>';
    var msgfrom = '<?php echo $id; ?>';
    var msgto = '<?php echo $to; ?>';
    var answer = 0;
    var pc=null;
    var localStream=null;
    var ws=null;
    var min    = 0;
    var second = 00;
    var zeroPlaceholder = 0;

    var PeerConnection = window.mozRTCPeerConnection || window.webkitRTCPeerConnection || window.RTCPeerConnection;
    var IceCandidate = window.mozRTCIceCandidate || window.webkitRTCIceCandidate || window.RTCIceCandidate;
    var SessionDescription = window.mozRTCSessionDescription || window.webkitRTCSessionDescription || window.RTCSessionDescription;
    navigator.mediaDevices.getUserMedia = navigator.mediaDevices.getUserMedia || navigator.mozMediaDevices.mozGetUserMedia || navigator.webkitMediaDevices.webkitGetUserMedia;

    var localVideo = document.getElementById('localVideo');
    var remoteVideo = document.getElementById('remoteVideo');
    var configuration  = {
        'iceServers': [
      { 'urls': 'stun:stun.stunprotocol.org:3478' },
      { 'urls': 'stun:stun.l.google.com:19302' },
      { 'urls': 'stun:stun.xten.com' },
      //{'urls': 'stun:stun1.l.google.com:19302' },
      //{'urls': 'stun:stun2.l.google.com:19302' }
        ]
    };

  // Start
    navigator.mediaDevices.getUserMedia({
           //  audio: true, // audio is off here, enable this line to get audio too
            audio: true,
            <?php if($type=='video'): ?>
            video: true
          <?php endif; ?>
        }).then(function (stream) {
            localVideo.srcObject = stream;
            localStream = stream;
            try {
                ws = new WebSocket('ws://192.168.10.102:1900');//new EventSource('<?php echo site_url('chat/server_get'); ?>');
            } catch(e) {
                console.error("Could not create eventSource ",e);
            }

      ws.onopen = function() {
        console.info("Connected.");
        //sendMessage('setName', userName);
      };
            // Websocket-hack: EventSource does not have a 'send()'
            // so I use an ajax-xmlHttpRequest for posting data.
            // Now the eventsource-functions are equal to websocket.
      /*ws.send = function send(message) {
        message = JSON.parse(message);
        //console.log(message);
        $.ajax({
          url: '<?php //echo site_url('chat/server_post'); ?>?',
          type: 'POST',
          //dataType: 'json',
          data: message,
        });
      }*/

      ws.onmessage = function(e) {
        var data = JSON.parse(e.data);
        //console.log(data.type);
        if(data.type!='system')
        {
          onsinglemessage( decodeURIComponent( escape ( e.data ) ) );
        }
      }


      ws.onclose = function(event) {
        //if (event.wasClean) {
        //  console.info('clouse conecting');
        //} else {
          //location = location;
         // console.warn('server disconected');
        //}
        console.info('Code: ' + event.code + ' Msg: ' + event.reason);
      };

            // Go show myself
            localVideo.addEventListener('loadedmetadata', 
                function () {
                    //publish('client-call', null);
                }
            );
      
        }).catch(function (e) {
            console.log("Problem while getting audio/video stuff ",e);
        });

    function startcall()
    {
        publish('client-call', null);
    }

    function endcall()
    {
      publish('endcall', null);
      window.close();
    }

    function countUp () {
          second++;
          if(second == 60){
            second = 00;
            min = min + 1;
          }
          if(second == 10){
              zeroPlaceholder = '';
          }else
          if(second == 00){
              zeroPlaceholder = 0;
          }
          var tm = min+':'+zeroPlaceholder+second;
          $(".count-up").text(tm);
      }

    function onsinglemessage(data) {
        var package = JSON.parse(data);
        var data = package.data;
        console.log(package);
        //deletecallid(package.callid);
        if(package.event=='cancel-call' && ( (package.to == msgfrom && package.from == msgto ) || (package.from == msgfrom && package.to == msgto) ))
        {
          window.close();
        }
        if(package.event=='client-call' && package.to == msgfrom )
        {
          $('.ringing')[0].pause();
          $('#informCustomer').hide();
          $('#videocall').show();
        }
        if(package.event=='timer' && ( (package.to == msgfrom && package.from == msgto ) || (package.from == msgfrom && package.to == msgto) ) )
        {
          countUp();
        }
        
        console.log("received single message: " + package.event);
        switch (package.event) {
            case 'client-call':
                if(package.from === msgfrom)
                {
                  console.log(package);
                    icecandidate(localStream);
                    pc.createOffer({
                        offerToReceiveAudio: 1,
                        offerToReceiveVideo: 1
                    }).then(function (desc) {
                        pc.setLocalDescription(desc).then(
                            function () {
                                publish('client-offer', pc.localDescription);
                            }
                        ).catch(function (e) {
                            console.log("Problem with publishing client offer"+e);
                        });
                    }).catch(function (e) {
                        console.log("Problem while doing client-call: "+e);
                    });
                }
                break;
            case 'client-answer':
              if(package.to === msgfrom)
              {
                console.log(package);
                if (pc==null) {
                    console.error('Before processing the client-answer, I need a client-offer');
                    break;
                }
                pc.setRemoteDescription(new SessionDescription(data),function(){
                  setInterval(function() { publish('timer',null); }, 1000);
                }, 
                    function(e) { console.log("Problem while doing client-answer: ",e);
                });
              }
                break;
            case 'client-offer':
              if(package.to === msgfrom)
              {
                console.log(package);
                /*var conf = confirm('New Call From: '+ package.from);
                if(conf==false)
                {
                  return false;
                }*/
                icecandidate(localStream);
                pc.setRemoteDescription(new SessionDescription(data), function(){
                    if (!answer) {
                      //var conf = confirm('Call From '+package.from);
                      //if(conf==true)
                      //{
                        pc.createAnswer(function (desc) {
                                pc.setLocalDescription(desc, function () {
                                    publish('client-answer', pc.localDescription);
                                }, function(e){
                                    console.log("Problem getting client answer: ",e);
                                });
                            }
                        ,function(e){
                            console.log("Problem while doing client-offer: ",e);
                        });
                        answer = 1;
                      //}
                    }
                }, function(e){
                    console.log("Problem while doing client-offer2: ",e);
                });
              }
                break;
            case 'client-candidate':
               if (pc==null) {
                    console.error('Before processing the client-answer, I need a client-offer');
                    break;
                }
                pc.addIceCandidate(new IceCandidate(data), function(){}, 
                    function(e) { console.log("Problem adding ice candidate: "+e);});
                break;
            case 'endcall':
            if(package.from === msgfrom)
              {
               if (pc==null) {
                    console.error('Call  already ended');
                    break;
                }
                //pc.close();
                //pc.streams[0].Stop();
              }
                break;
        }
    };

    function icecandidate(localStream) {
        pc = new PeerConnection(configuration);
        pc.onicecandidate = function (event) {
            if (event.candidate) {
                publish('client-candidate', event.candidate);
            }
        };
        try {
            pc.addStream(localStream);
        }catch(e){
            var tracks = localStream.getTracks();
            for(var i=0;i<tracks.length;i++){
                pc.addTrack(tracks[i], localStream);
            }
        }
        pc.ontrack = function (e) {
            document.getElementById('remoteVideo').style.display="block";
            //document.getElementById('localVideo').style.display="none";
            remoteVideo.srcObject = e.streams[0];
        };
    }

    function publish(event, data) {
        console.log("sending ws.send: " + event);
        var senddata = JSON.stringify({
            event:event,
            data:data,
            to: '<?php echo $to; ?>',
            from: '<?php echo $id; ?>'
        });
        var encdata = unescape( encodeURIComponent( senddata ));
        console.log(encdata);
        ws.send( encdata );
    }

</script>
</body>
</html>