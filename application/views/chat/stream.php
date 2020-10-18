<!DOCTYPE html>
<html>
<head>
  <title>react-native-webrtc server</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <style type="text/css">
    body{ margin: 0; }
      *, button, input, *:after, *:before {
        box-sizing: border-box;
      }

      html {
        font-size: 100%;
        font-family: Arial, sans-serif;
      }
  </style>
  <link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css" />
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
</head>
<body>
<video class="player" 
      mute='true'
      playsinline
      autoplay
      id='v'
      name='v'
      width='100%'
      height="100%" style="height: 100vh;" 
      controls muted></video>
<script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
<script src="https://cdn.plyr.io/3.6.2/plyr.polyfilled.js"></script>
</body>
<script>
  const player = new Plyr('.player');
</script>
<script type="text/javascript">
(async function() {
  const config = {
    iceServers: [{
      urls: ['stun:stun.l.google.com:19302']
    }],
    enableScalableBroadcast: true,
    maxRelayLimitPerUser: 1,
    autoCloseEntireSession: true,
    socketURL: '/',
    socketMessageEvent: 'scalable-media-broadcast-demo'
  };

  const getRandomId = () => {
    return '<?php echo $this->user->info->ID; ?>';//Math.floor(Math.random() * 10000);
  };

  const peerId = getRandomId();
  const peerType = 'camera';
  const connections = new Map();

  let ws;
  const getSocket = async (peerId, peerType) => {
    if (ws) return ws;

    return new Promise((resolve, reject) => {
      try {
        const protocol = (
          window.location.protocol === 'https:' ?
            'wss:' :
            'ws:'
        );
        ws = new WebSocket(`${protocol}//192.168.10.102:1900`);

        const onOpen = () => {
          ws.send(JSON.stringify({
            type: 'register',
            peerType,
            peerId,
          }));

          ws.removeEventListener('open', onOpen);
          resolve(ws);
        };

        ws.addEventListener('open', onOpen);
      } catch (e) {
        reject(e);
      }
    });
  };


  try {
    console.log('in camera');

    const mediaStream = await navigator.mediaDevices.getUserMedia({
      video: true,
      audio: true
    });

    window.v.srcObject = mediaStream;
    // window.v.play();

    const socket = await getSocket(peerId, peerType);
    socket.addEventListener('message', async (e) => {
      const msg = JSON.parse(e.data);
      console.log('msg', msg);

      if (msg.peerType === 'screen') {
        //for (let screen of msg.screens) {
            screen = 0;
          const peerConnection = new RTCPeerConnection(config);
          connections.set(screen, peerConnection);

          // peerConnection.addStream(window.v.srcObject);
          for (let track of mediaStream.getTracks()) {
            peerConnection.addTrack(track, mediaStream);
          }

          const sdp = await peerConnection.createOffer();
          await peerConnection.setLocalDescription(sdp);

          peerConnection.onicecandidate = (e) => {
            if (e.candidate) {
              socket.send(JSON.stringify({
                type: 'candidate',
                from: peerId,
                to: screen,
                data: e.candidate,
              }));
            }
          };

          socket.send(JSON.stringify({
            type: 'offer',
            to: screen,
            from: peerId,
            data: peerConnection.localDescription,
          }));
       // }
      }

      if (msg.type === 'answer') {
        const peerConnection = connections.get(0);
        peerConnection.setRemoteDescription(msg.data);
      }

      if (msg.type === 'disconnect') {
        const connection = connections.get(msg.from);
        if (connection) {
          console.log('Disconnecting from', msg.from);
          connection.close();
          connections.delete(msg.from);
        }
      }

      if (msg.type === 'candidate') {
        const connection = connections.get(msg.from);
        if (connection) {
          console.log('Adding candidate to', msg.from);
          connection.addIceCandidate(new RTCIceCandidate(
            msg.data
          ));
        }
      }
    });

  } catch (e) {
    console.error(e);
  }
})();
</script>