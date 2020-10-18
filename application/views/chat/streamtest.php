<!--
> Muaz Khan     - https://github.com/muaz-khan
> MIT License   - https://www.webrtc-experiment.com/licence/
> Documentation - https://github.com/muaz-khan/WebRTC-Experiment/tree/master/websocket
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>WebSockets | WebRTC One-to-One Video Chat</title>

        <script>
            /*if(!location.hash.replace('#', '').length) {
                location.href = location.href.split('#')[0] + '#' + (Math.random() * 100).toString().replace('.', '');
                location.reload();
            }*/
        </script>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <link rel="author" type="text/html" href="https://plus.google.com/+MuazKhan">
        <meta name="author" content="Muaz Khan">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="stylesheet" href="https://www.webrtc-experiment.com/style.css">
        <link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css" />
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        <style>
            audio, video {
                -moz-transition: all 1s ease;
                -ms-transition: all 1s ease;

                -o-transition: all 1s ease;
                -webkit-transition: all 1s ease;
                transition: all 1s ease;
                vertical-align: top;
            }

            input {
                border: 1px solid #d9d9d9;
                border-radius: 1px;
                font-size: 2em;
                margin: .2em;
                width: 30%;
            }

            .setup {
                border-bottom-left-radius: 0;
                border-top-left-radius: 0;
                font-size: 102%;
                height: 47px;
                margin-left: -9px;
                margin-top: 8px;
                position: absolute;
            }

            p { padding: 1em; }

            li {
                border-bottom: 1px solid rgb(189, 189, 189);
                border-left: 1px solid rgb(189, 189, 189);
                padding: .5em;
            }

            .highlight { color: rgb(0, 8, 189); }
        </style>
        <script>
            document.createElement('article');
            document.createElement('footer');
        </script>

        <!-- scripts used for peers connection -->
        <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
<script> 
// Muaz Khan     - https://github.com/muaz-khan
// MIT License   - https://www.webrtc-experiment.com/licence/
// Documentation - https://github.com/muaz-khan/WebRTC-Experiment/tree/master/websocket
(function () {

    window.PeerConnection = function (socketURL, userid) {
        this.userid = userid || getToken();
        this.peers = {};

        if (!socketURL) throw 'Socket-URL is mandatory.';

        new Signaler(this, socketURL);
        
        this.addStream = function(stream) { 
            this.MediaStream = stream;
        };
    };

    function Signaler(root, socketURL) {
        var self = this;

        root.startBroadcasting = function () {
            if(!root.MediaStream) throw 'Offerer must have media stream.';
            
            (function transmit() {
                socket.send({
                    userid: root.userid,
                    broadcasting: true
                });
                !self.participantFound &&
                    !self.stopBroadcasting &&
                        setTimeout(transmit, 3000);
            })();
        };

        root.sendParticipationRequest = function (userid) {
            socket.send({
                participationRequest: true,
                userid: root.userid,
                to: userid
            });
        };

        // if someone shared SDP
        this.onsdp = function (message) {
            var sdp = message.sdp;

            if (sdp.type == 'offer') {
                root.peers[message.userid] = Answer.createAnswer(merge(options, {
                    MediaStream: root.MediaStream,
                    sdp: sdp
                }));
            }

            if (sdp.type == 'answer') {
                root.peers[message.userid].setRemoteDescription(sdp);
            }
        };

        root.acceptRequest = function (userid) {
            root.peers[userid] = Offer.createOffer(merge(options, {
                MediaStream: root.MediaStream
            }));
        };

        var candidates = [];
        // if someone shared ICE
        this.onice = function (message) {
            var peer = root.peers[message.userid];
            if (peer) {
                peer.addIceCandidate(message.candidate);
                for (var i = 0; i < candidates.length; i++) {
                    peer.addIceCandidate(candidates[i]);
                }
                candidates = [];
            } else candidates.push(candidates);
        };

        // it is passed over Offer/Answer objects for reusability
        var options = {
            onsdp: function (sdp) {
                socket.send({
                    userid: root.userid,
                    sdp: sdp,
                    to: root.participant
                });
            },
            onicecandidate: function (candidate) {
                socket.send({
                    userid: root.userid,
                    candidate: candidate,
                    to: root.participant
                });
            },
            onStreamAdded: function (stream) {
                console.debug('onStreamAdded', '>>>>>>', stream);

                stream.onended = function () {
                    if (root.onStreamEnded) root.onStreamEnded(streamObject);
                };

                var mediaElement = document.createElement('video');
                mediaElement.id = root.participant;
                mediaElement.srcObject = stream;
                mediaElement.autoplay = true;
                mediaElement.controls = true;
                mediaElement.play();

                var streamObject = {
                    mediaElement: mediaElement,
                    stream: stream,
                    userid: root.participant,
                    type: 'remote'
                };

                function afterRemoteStreamStartedFlowing() {
                    if (!root.onStreamAdded) return;
                    root.onStreamAdded(streamObject);
                }

                afterRemoteStreamStartedFlowing();
            }
        };

        function closePeerConnections() {
            self.stopBroadcasting = true;
            if (root.MediaStream) root.MediaStream.stop();

            for (var userid in root.peers) {
                root.peers[userid].peer.close();
            }
            root.peers = {};
        }

        root.close = function () {
            socket.send({
                userLeft: true,
                userid: root.userid,
                to: root.participant
            });
            closePeerConnections();
        };

        window.onbeforeunload = function () {
            root.close();
        };

        window.onkeyup = function (e) {
            if (e.keyCode == 116)
                root.close();
        };
        
        function onmessage(e) {
            var message = JSON.parse(e.data);

            if (message.userid == root.userid) return;
            root.participant = message.userid;

            // for pretty logging
            console.debug(JSON.stringify(message, function (key, value) {
                if (value && value.sdp) {
                    //console.log(value.sdp.type, '---', value.sdp.sdp);
                    return '';
                } else return value;
            }, '---'));

            // if someone shared SDP
            if (message.sdp && message.to == root.userid) {
                self.onsdp(message);
            }

            // if someone shared ICE
            if (message.candidate && message.to == root.userid) {
                self.onice(message);
            }

            // if someone sent participation request
            if (message.participationRequest && message.to == root.userid) {
                self.participantFound = true;

                if (root.onParticipationRequest) {
                    root.onParticipationRequest(message.userid);
                } else root.acceptRequest(message.userid);
            }

            // if someone is broadcasting himself!
            if (message.broadcasting && root.onUserFound) {
                root.onUserFound(message.userid);
            }

            if (message.userLeft && message.to == root.userid) {
                closePeerConnections();
            }
        }

        var socket = socketURL;
        if(typeof socketURL == 'string') {
            socket = new WebSocket(socketURL);
            socket.push = socket.send;
            socket.send = function (data) {
                socket.push(JSON.stringify(data));
            };

            socket.onopen = function () {
                console.log('websocket connection opened.');
            };
        }
        socket.onmessage = onmessage;
    }

    var RTCPeerConnection = window.mozRTCPeerConnection || window.webkitRTCPeerConnection;
    var RTCSessionDescription = window.mozRTCSessionDescription || window.RTCSessionDescription;
    var RTCIceCandidate = window.mozRTCIceCandidate || window.RTCIceCandidate;

    var isFirefox = !!navigator.mozGetUserMedia;
    var isChrome = !!navigator.webkitGetUserMedia;

    var STUN = {
        url: isChrome ? 'stun:stun.l.google.com:19302' : 'stun:23.21.150.121'
    };

    var iceServers = {
        iceServers: [STUN]
    };

    if(typeof IceServersHandler !== 'undefined') {
        iceServers.iceServers = IceServersHandler.getIceServers();
    }

    var offerAnswerConstraints = {
        optional: [],
        mandatory: {
            OfferToReceiveAudio: true,
            OfferToReceiveVideo: true
        }
    };

    function getToken() {
        return <?php echo $this->user->info->ID; ?>;//Math.round(Math.random() * 9999999999) + 9999999999;
    }
    
    function onSdpError() {}

    // var offer = Offer.createOffer(config);
    // offer.setRemoteDescription(sdp);
    // offer.addIceCandidate(candidate);
    var Offer = {
        createOffer: function(config) {
            var peer = new RTCPeerConnection(iceServers);

            if(typeof peer.addTrack === 'function') {
                if (config.MediaStream) {
                    config.MediaStream.getTracks().forEach(function(track) {
                        peer.addTrack(track, config.MediaStream);
                    });
                }
                var dontDuplicate = {};
                peer.ontrack = function(event) {
                    var stream = event.streams[0];
                    if(dontDuplicate[stream.id]) return;
                    dontDuplicate[stream.id] = true;
                    config.onStreamAdded(stream);
                };
            }
            else {
                if (config.MediaStream) peer.addStream(config.MediaStream);
                peer.onaddstream = function(event) {
                    config.onStreamAdded(event.stream);
                };
            }

            peer.onicecandidate = function(event) {
                if (event.candidate)
                    config.onicecandidate(event.candidate);
            };

            peer.createOffer(offerAnswerConstraints).then(function(sdp) {
                peer.setLocalDescription(sdp).then(function() {
                    config.onsdp(sdp);
                });
            }).catch(onSdpError);

            this.peer = peer;

            return this;
        },
        setRemoteDescription: function(sdp) {
            this.peer.setRemoteDescription(new RTCSessionDescription(sdp));
        },
        addIceCandidate: function(candidate) {
            this.peer.addIceCandidate(new RTCIceCandidate({
                sdpMLineIndex: candidate.sdpMLineIndex,
                candidate: candidate.candidate
            }));
        }
    };

    // var answer = Answer.createAnswer(config);
    // answer.setRemoteDescription(sdp);
    // answer.addIceCandidate(candidate);
    var Answer = {
        createAnswer: function(config) {
            var peer = new RTCPeerConnection(iceServers);

            if(typeof peer.addTrack === 'function') {
                if (config.MediaStream) {
                    config.MediaStream.getTracks().forEach(function(track) {
                        peer.addTrack(track, config.MediaStream);
                    });
                }
                var dontDuplicate = {};
                peer.ontrack = function(event) {
                    var stream = event.streams[0];
                    if(dontDuplicate[stream.id]) return;
                    dontDuplicate[stream.id] = true;
                    config.onStreamAdded(stream);
                };
            }
            else {
                if (config.MediaStream) peer.addStream(config.MediaStream);
                peer.onaddstream = function(event) {
                    config.onStreamAdded(event.stream);
                };
            }

            peer.onicecandidate = function(event) {
                if (event.candidate)
                    config.onicecandidate(event.candidate);
            };

            peer.setRemoteDescription(new RTCSessionDescription(config.sdp)).then(function() {
                peer.createAnswer(offerAnswerConstraints).then(function(sdp) {
                    peer.setLocalDescription(sdp);
                    config.onsdp(sdp);
                }).catch(onSdpError);
            });

            this.peer = peer;

            return this;
        },
        addIceCandidate: function(candidate) {
            this.peer.addIceCandidate(new RTCIceCandidate({
                sdpMLineIndex: candidate.sdpMLineIndex,
                candidate: candidate.candidate
            }));
        }
    };

    function merge(mergein, mergeto) {
        for (var t in mergeto) {
            mergein[t] = mergeto[t];
        }
        return mergein;
    }

    navigator.getUserMedia = function(hints, onsuccess, onfailure) {
        if(!hints) hints = {audio:true,video:true};
        if(!onsuccess) throw 'Second argument is mandatory. navigator.getUserMedia(hints,onsuccess,onfailure)';
        
        navigator.mediaDevices.getUserMedia(hints).then(_onsuccess).catch(_onfailure);
        
        function _onsuccess(stream) {
            onsuccess(stream);
        }
        
        function _onfailure(e) {
            if(onfailure) onfailure(e);
            else throw Error('getUserMedia failed: ' + JSON.stringify(e, null, '\t'));
        }
    };
})();
</script>
        <!-- <script src="https://www.webrtc-experiment.com/view/websocket.js"> </script> -->
    </head>

    <body>
        <article>

            <div class="github-stargazers"></div>

            <!-- just copy this <section> and next script -->
            <section class="experiment">
                <section>
                    <input type="text" id="your-name" placeholder="your-name">
                    <button id="start-broadcasting" class="setup">Go Live</button>
                </section>

                <!-- list of all available conferencing rooms -->
                <table id="rooms-list" style="width: 100%;"></table>

                <!-- local/remote videos container -->
                <div id="videos-container"></div>
            </section>
<script src="https://cdn.plyr.io/3.6.2/plyr.polyfilled.js"></script>
<script>
  const player = new Plyr('video');
</script>
            <script>
                // Muaz Khan     - https://github.com/muaz-khan
                // MIT License   - https://www.webrtc-experiment.com/licence/
                // Documentation - https://github.com/muaz-khan/WebRTC-Experiment/tree/master/websocket

                //var channel = location.href.replace(/\/|:|#|%|\.|\[|\]/g, '');

                //var pub = 'pub-f986077a-73bd-4c28-8e50-2e44076a84e0';
                //var sub = 'sub-b8f4c07a-352e-11e2-bb9d-c7df1d04ae4a';

                //WebSocket  = PUBNUB.ws;

                var websocket = new WebSocket('ws://192.168.10.102:1900/');

                websocket.onerror = function() {
                    //location.reload();
                };

                websocket.onclose = function() {
                    //location.reload();
                };

                websocket.push = websocket.send;
                websocket.send = function(data) {
                    websocket.push(JSON.stringify(data));
                };

                var peer = new PeerConnection(websocket);
                peer.onUserFound = function(userid) {
                    //console.log('user: ',userid);
                    if(document.getElementById(userid)){
                        return false;
                    }
                    //if (document.getElementById(userid)) return;
                    //var tr = document.createElement('tr');

                    //var td1 = document.createElement('td');
                    //var td2 = document.createElement('td');

                    //td1.innerHTML = userid + ' is live you want to see his live streaming?';

                    //var button = document.createElement('button');
                    //button.innerHTML = 'Join';
                    //button.id = userid;
                    //button.style.float = 'right';
                    //button.onclick = function() {
                        //button = this;
                        //getUserMedia(function(stream) {
                            //peer.addStream(stream);
                            peer.sendParticipationRequest(userid);
                        //});
                        //button.disabled = true;
                    //};
                    //td2.appendChild(button);

                    //tr.appendChild(td1);
                    //tr.appendChild(td2);
                    //roomsList.appendChild(tr);
                };

                peer.onStreamAdded = function(e) {
                    if (e.type == 'local') document.querySelector('#start-broadcasting').disabled = false;
                    var video = e.mediaElement;

                    video.setAttribute('width', 600);
                    video.setAttribute('controls', true);
                    //alert(video);
                    videosContainer.insertBefore(video, videosContainer.firstChild);

                    video.play();
                    rotateVideo(video);
                    scaleVideos();
                };

                peer.onStreamEnded = function(e) {
                    var video = e.mediaElement;
                    if (video) {
                        video.style.opacity = 0;
                        rotateVideo(video);
                        setTimeout(function() {
                            video.parentNode.removeChild(video);
                            scaleVideos();
                        }, 1000);
                    }
                };

                document.querySelector('#start-broadcasting').onclick = function() {
                    this.disabled = true;
                    getUserMedia(function(stream) {
                        peer.addStream(stream);
                        peer.startBroadcasting();
                    });
                };

                document.querySelector('#your-name').onchange = function() {
                    peer.userid = this.value;
                };

                var videosContainer = document.getElementById('videos-container') || document.body;
                var btnSetupNewRoom = document.getElementById('setup-new-room');
                var roomsList = document.getElementById('rooms-list');

                if (btnSetupNewRoom) btnSetupNewRoom.onclick = setupNewRoomButtonClickHandler;

                function rotateVideo(video) {
                    video.style[navigator.mozGetUserMedia ? 'transform' : '-webkit-transform'] = 'rotate(0deg)';
                    setTimeout(function() {
                        video.style[navigator.mozGetUserMedia ? 'transform' : '-webkit-transform'] = 'rotate(360deg)';
                    }, 1000);
                }

                function scaleVideos() {
                    var videos = document.querySelectorAll('video'),
                        length = videos.length,
                        video;
                    const player = new Plyr('video');

                    var minus = 130;
                    var windowHeight = 700;
                    var windowWidth = 600;
                    var windowAspectRatio = windowWidth / windowHeight;
                    var videoAspectRatio = 4 / 3;
                    var blockAspectRatio;
                    var tempVideoWidth = 0;
                    var maxVideoWidth = 0;

                    for (var i = length; i > 0; i--) {
                        blockAspectRatio = i * videoAspectRatio / Math.ceil(length / i);
                        if (blockAspectRatio <= windowAspectRatio) {
                            tempVideoWidth = videoAspectRatio * windowHeight / Math.ceil(length / i);
                        } else {
                            tempVideoWidth = windowWidth / i;
                        }
                        if (tempVideoWidth > maxVideoWidth)
                            maxVideoWidth = tempVideoWidth;
                    }
                    for (var i = 0; i < length; i++) {
                        video = videos[i];
                        if (video)
                            video.width = maxVideoWidth - minus;
                    }
                }

                window.onresize = scaleVideos;

                // you need to capture getUserMedia yourself!
                function getUserMedia(callback) {
                    var hints = {
                        audio: true,
                        video: {
                            optional: [],
                            mandatory: {}
                        }
                    };
                    navigator.getUserMedia(hints, function(stream) {
                        var video = document.createElement('video');
                        video.srcObject = stream;
                        video.controls = true;
                        video.muted = true;

                        peer.onStreamAdded({
                            mediaElement: video,
                            userid: 'self',
                            stream: stream
                        });

                        callback(stream);
                    });
                }

                /*(function() {
                    var uniqueToken = document.getElementById('unique-token');
                    if (uniqueToken)
                        if (location.hash.length > 2) uniqueToken.parentNode.parentNode.parentNode.innerHTML = '<h2 style="text-align:center;"><a href="' + location.href + '" target="_blank">Share this link</a></h2>';
                        else uniqueToken.innerHTML = uniqueToken.parentNode.parentNode.href = '#' + (Math.random() * new Date().getTime()).toString(36).toUpperCase().replace(/\./g, '-');
                })();*/
            </script>


    </body>
</html>
