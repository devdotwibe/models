(function ($) {
    'use strict';
    tlm_check_url();
    $(document).on('click', '#tlm_status_notify', function () {
        var obj = $(this);
        let model_id = $('.str_privatechat_send_btn2').data('model_id');
        let user_id = $('.str_privatechat_send_btn2').data('userid');
        var tlm_data = {
            action: 'tlm_send_notification_action',
            key: model_id,
            user: user_id,
        }
        if (model_id && model_id != '') {
            $.ajax({
                url: 'ajax.php',
                type: 'POST',
                data: tlm_data,
                beforeSend: function () {
                },
                complete: function () {
                },
                success: function (response) {
                    obj.parent().append('<span>Your Request Sent Successfully</span>');
                    obj.remove();
                }
            });
        }
    });

        console.log(document.getElementById('room-id').value,'vcxvxcxcxxcxxccxcxc');


    var connection = new RTCMultiConnection();

    document.getElementById('open-room').onclick = function () {

        console.log('tesr run');
        disableInputButtons();
         console.log(connection.open,'tesr run1');
        var res =         connection.open(document.getElementById('room-id').value, function () {
             console.log('tesr run2');
            showRoomURL(connection.sessionid);
             console.log('tesr run3');
        });

         showRoomURL(res.sessionid);

         console.log(connection,'tesr run4');
    };

    document.getElementById('join-room').onclick = function () {
        disableInputButtons();

        connection.sdpConstraints.mandatory = {
            OfferToReceiveAudio: true,
            OfferToReceiveVideo: true
        };
        connection.join(document.getElementById('room-id').value);

         console.log(document.getElementById('room-id').value,'joined to room');
    };


    // connection.socketURL = '/';

    //  connection.socketURL = 'https://rtcmulticonnection.herokuapp.com:443/';
    // connection.socketURL = 'http://muazkhan.com:9001/';

    connection.socketMessageEvent = 'video-broadcast-demo';
    var user_id = document.getElementById('join-room').value
    connection.extra = {
        user_id: user_id
    };

    console.log(user_id,'user connection established');


    connection.session = {
        audio: true,
        video: true,
        oneway: true
    };
    connection.bandwidth = {
        audio: 510,  // 50 kbps
        video: 2000, // 256 kbps
        screen: 4000
    };
    var camera_id = $('#tlm_camera_id').val();
    connection.mediaConstraints = {
        audio: true,
        video: {
            optional: [{
                sourceId: camera_id
            }]
        }
    }
    var check_participant = $('#tlm_limit_user').val();
    if (check_participant == 'true') {
        connection.maxParticipantsAllowed = 2;
    }
    // console.log(cameras[0].deviceId));


    // connection.mediaConstraints = {
    //     audio: true,
    //     video: {
    //         mandatory: {},
    //         optional: [{
    //             facingMode: 'application' // or "application" for back camera
    //         }]
    //     }
    // };    
    // console.log(DetectRTC.videoInputDevices);
    // var secondaryCamera = DetectRTC.videoInputDevices[0];
    // alert(secondaryCamera);    
    // if (!secondaryCamera) {
    //     alert('Please attach another camera device.');
    //     return;
    // }

    // connection.mediaConstraints = {
    //     audio: true,
    //     video: {
    //         mandatory: {},
    //         optional: [{
    //             sourceId: secondaryCamera.id
    //         }]
    //     }
    // };

    //   var secondaryCamera = DetectRTC.videoInputDevices;
    //   console.log(secondaryCamera);

    connection.sdpConstraints.mandatory = {
        OfferToReceiveAudio: false,
        OfferToReceiveVideo: false
    };

    connection.iceServers = [{
        'urls': [
            'stun:stun.l.google.com:19302',
            'stun:stun1.l.google.com:19302',
            'stun:stun2.l.google.com:19302',
            'stun:stun.l.google.com:19302?transport=udp',
        ]
    }];

    connection.videosContainer = document.getElementById('videos-container');
    connection.onstream = function (event) {
        var existing = document.getElementById(event.streamid);
        if (existing && existing.parentNode) {
            existing.parentNode.removeChild(existing);
        }

        event.mediaElement.removeAttribute('src');
        event.mediaElement.removeAttribute('srcObject');
        event.mediaElement.muted = true;
        event.mediaElement.volume = 0;

        var video = document.createElement('video');

        try {
            video.setAttributeNode(document.createAttribute('autoplay'));
            video.setAttributeNode(document.createAttribute('playsinline'));
            video.setAttributeNode(document.createAttribute('controls'));
            video.setAttributeNode(document.createAttribute('controlslist'));
            // video.setAttributeNode(document.createAttribute('audio'));
        } catch (e) {
            video.setAttribute('autoplay', true);
            video.setAttribute('playsinline', true);
            video.setAttribute('controls', true);
            video.setAttribute('audio', true);
        }

        if (event.type === 'local') {
            video.volume = 0;
            try {
                video.setAttributeNode(document.createAttribute('muted'));
            } catch (e) {
                video.setAttribute('muted', true);
            }
        }
        video.srcObject = event.stream;


        var width = parseInt(connection.videosContainer.clientWidth / 3) - 20;
        var mediaElement = getHTMLMediaElement(video, {
            title: event.userid,
            buttons: ['full-screen'],
            width: width,
            showOnMouseEnter: false
        });

        connection.videosContainer.appendChild(mediaElement);
        $('.wth_live_btn').attr('style', 'display:inline !important;');
        $('.tlm_img_chat').attr('style', 'display:inline !important;');

        // setTimeout(function() {
        //     mediaElement.media.play();
        // }, 5000);

        mediaElement.id = event.streamid;
    };

    connection.onstreamended = function (event) {
        var mediaElement = document.getElementById(event.streamid);
        if (mediaElement) {
            mediaElement.parentNode.removeChild(mediaElement);

            if (event.userid === connection.sessionid && !connection.isInitiator) {
                alert('Broadcast is ended. We will relo1ad this page to clear the cache.');
                location.reload();
            }
        }
    };

    connection.onMediaError = function (e) {
        if (e.message === 'Concurrent mic process limit.') {
            if (DetectRTC.audioInputDevices.length <= 1) {
                alert('Please select external microphone.');
                return;
            }

            var secondaryMic = DetectRTC.audioInputDevices[1].deviceId;
            connection.mediaConstraints.audio = {
                deviceId: secondaryMic
            };

            connection.join(connection.sessionid);
        }
    };

    function disableInputButtons() {
        document.getElementById('room-id').onkeyup();
        document.getElementById('room-id').disabled = true;
    }

    function showRoomURL(roomid) {
        var roomHashURL = '#' + roomid;
        var roomQueryStringURL = '?roomid=' + roomid;

        var html = '<h2>Unique URL for your room:</h2><br>';

        html += 'Hash URL: <a href="' + roomHashURL + '" target="_blank">' + roomHashURL + '</a>';
        html += '<br>';
        html += 'QueryString URL: <a href="' + roomQueryStringURL + '" target="_blank">' + roomQueryStringURL + '</a>';

        var roomURLsDiv = document.getElementById('room-urls');
        roomURLsDiv.innerHTML = html;

    }

    (function () {
        var params = {},
            r = /([^&=]+)=?([^&]*)/g;

        function d(s) {
            return decodeURIComponent(s.replace(/\+/g, ' '));
        }
        var match, search = window.location.search;
        while (match = r.exec(search.substring(1)))
            params[d(match[1])] = d(match[2]);
        window.params = params;
    })();

    var roomid = '';
    if (localStorage.getItem(connection.socketMessageEvent)) {
        roomid = localStorage.getItem(connection.socketMessageEvent);
    } else {
        roomid = connection.token();
    }
    // document.getElementById('room-id').value = roomid;
    document.getElementById('room-id').onkeyup = function () {
        localStorage.setItem(connection.socketMessageEvent, document.getElementById('room-id').value);
    };

    var hashString = location.hash.replace('#', '');
    if (hashString.length && hashString.indexOf('comment-') == 0) {
        hashString = '';
    }

    var roomid = params.roomid;
    if (!roomid && hashString.length) {
        roomid = hashString;
    }

    if (roomid && roomid.length) {
        // document.getElementById('room-id').value = roomid;
        localStorage.setItem(connection.socketMessageEvent, roomid);

        // auto-join-room
        (function reCheckRoomPresence() {
            connection.checkPresence(roomid, function (isRoomExist) {
                if (isRoomExist) {
                    connection.join(roomid);
                    return;
                }

                setTimeout(reCheckRoomPresence, 5000);
            });
        })();

        disableInputButtons();
    }

    // detect 2G
    if (navigator.connection &&
        navigator.connection.type === 'cellular' &&
        navigator.connection.downlinkMax <= 0.115) {
        alert('2G is not supported. Please use a better internet service.');
    }
    // $('video').attr('controls',true);
    // function video_controls(){
    //   $("video").prop("controls",true);
    //   $('video').attr('controls',true);
    // }
    // setTimeout(video_controls, 5000);
    // var numberOfUsers = connection.getAllParticipants().length;
    // $('#click').on('click', function(){
    //   var arrayOfUserIds = connection.getAllParticipants();
    //   console.clear();
    //   console.log(arrayOfUserIds);
    // })
    var tlm_streamer_length = '';
    setInterval(function () {
        // var arrayOfUserIds = connection.getAllParticipants();
        var user = [];
        // connection.getAllParticipants().forEach(function (participantId) {
        //     user.push(connection.peers[participantId].extra.user_id);
        // });

         var participants = Object.keys(connection.peers);

         console.log(participants,'connected users');


        participants.forEach(function (participantId) {
            var peer = connection.peers[participantId];
            if (peer && peer.extra && peer.extra.user_id) {
                user.push(peer.extra.user_id);
            }
        });

        console.log(user,'users commnects list ');


        if (user.length > 0) {
            var tlm_user_name = $('#tlm_usere').val();
            var tlm_data = {
                action: 'tlm_get_total_user',
                user: user,
                model_id:$('#i-model_ids').val(),
                tlm_user_name: tlm_user_name
            }
            $.ajax({
                url: 'ajax.php',
                type: 'POST',
                data: tlm_data,
                beforeSend: function () {
                },
                complete: function () {
                },
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data.text) {
                        $('#tlm_user').empty();
                        $('#tlm_total_user_display').empty();
                        $('#tlm_user').html(data.text.length);
                        for (var i = 0; i < data.text.length; i++) {
                            let current_user = $('input[name="login_user_name"]').val();
                            if (current_user.trim() == data.text[i].trim()) {
                                $('#tlm_total_user_display').append('<li><div class="tlm_user_viewer"><div class="str_chat_avtar"><img src="../uploads/profile_pic/icons-user.jpg" class="img-fluid" /></div> <span class="tlm_str_user_active">' + data.text[i] + '</span></div><li>');
                            } else {
                                $('#tlm_total_user_display').append('<li><div class="tlm_user_viewer"><div class="str_chat_avtar"><img src="../uploads/profile_pic/icons-user.jpg" class="img-fluid" /></div> <span>' + data.text[i] + '</span></div><li>');
                            }
                        }
                    }
                }
            });
        } else {
            $('#tlm_user').html('0');
        }
        // if( tlm_user_name == 'viewer' ) {
        //     if( arrayOfUserIds && arrayOfUserIds.length == 1 ) {
        //         $('#videos-container').attr('style','display:inline-block !important');
        //     }else{
        //         $('#videos-container').attr('style','display:none !important');

        //     }
        // }
        //   $('.str_member').html(arrayOfUserIds.length);
    }, 3000);

    $(document).on('click', 'video', function () {
    });
    $(".col-lg-8").click(function () {
        alert('test');
        var video = $('video').get(0);
        if (video.paused) {
        } else {
            $('.wth_live_btn').attr('style', 'display:none !important;');
        }
        // return false;
    });

    $(document).ready(function () {
        var scrolled = false;
        $(document).on('click', '.str_chat_send_btn', function () {
            let msg = $('#tlm_send_msg').val();
            let model_id = $(this).data('model_id');
            var tlm_data = {
                action: 'tlm_msg_send_action',
                msg: msg,
                model_id: model_id,
            }
            if (msg && msg != '') {
                $.ajax({
                    url: 'ajax.php',
                    type: 'POST',
                    data: tlm_data,
                    beforeSend: function () {
                    },
                    complete: function () {
                    },
                    success: function (response) {
                        console.log(response);
                        $('#tlm_send_msg').val('');
                        tlm_get_msg();
                        scrolled = false;
                    }
                });
            }
        });
        $(document).on('click', '.str_privatechat_send_btn2', function () {
            let msg = $('#tlm_send_privatemsg').val();
            let model_id = $(this).data('model_id');
            let user_id = $(this).data('userid');
            var tlm_data = {
                action: 'tlm_privatemsg_send_action',
                msg: msg,
                model_id: model_id,
                user_id: user_id
            }
            if (msg && msg != '') {
                $.ajax({
                    url: 'ajax.php',
                    type: 'POST',
                    data: tlm_data,
                    beforeSend: function () {
                    },
                    complete: function () {
                    },
                    success: function (response) {
                        console.log(response);
                        $('#tlm_send_privatemsg').val('');
                        tlm_get_privatemsg();
                        scrolled = false;
                    }
                });
            }
        });
        // $("#tlm_send_msg").keypress(function(event) { 
        //     if (event.keyCode === 13) { 
        //         $(".str_chat_send_btn").click(); 
        //     } 
        // });

        setInterval(function () {
            tlm_get_msg();
        }, 3 * 1000);
        function tlm_get_msg() {
            let model_id = $('.str_chat_send_btn').data('model_id');
            var tlm_data = {
                action: 'tlm_msg_get_action',
                key: model_id,
            }
            if (model_id && model_id != '') {
                $.ajax({
                    url: 'ajax.php',
                    type: 'POST',
                    data: tlm_data,
                    beforeSend: function () {
                    },
                    complete: function () {
                    },
                    success: function (response) {
                        var data = JSON.parse(response);
                        if (data.text) {
                            $('#tlm_all_msg').empty();
                            for (var i = 0; i < data.text.length; i++) {
                                $('#tlm_all_msg').append($(data.text[i]));
                            }
                        }
                        if (!scrolled) {
                            var messageBody = document.querySelector('.str_chat_list');
                            messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
                        }
                        //tlm_get_msg();
                    }
                });
            }
        }
        function tlm_get_privatemsg() {
            let model_id = $('.str_privatechat_send_btn2').data('model_id');
            let user_id = $('.str_privatechat_send_btn2').data('userid');
            var tlm_data = {
                action: 'tlm_privatemsg_get_action',
                key: model_id,
                user_id: user_id,
            }
            if (model_id && model_id != '') {
                $.ajax({
                    url: 'ajax.php',
                    type: 'POST',
                    data: tlm_data,
                    beforeSend: function () {
                    },
                    complete: function () {
                    },
                    success: function (response) {
                        var data = JSON.parse(response);
                        if (data.text) {
                            $('#tlm_all_privatemsg').empty();
                            for (var i = 0; i < data.text.length; i++) {
                                $('#tlm_all_privatemsg').append($(data.text[i]));
                            }
                        }
                        if (!scrolled) {
                            var messageBody = document.querySelector('.str_chat_list');
                            messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
                        }
                        tlm_get_privatemsg();
                    }
                });
            }
        }
        $("#tlm_send_msg").keypress(function (event) {
            if (event.keyCode === 13) {
                $(".str_chat_send_btn").click();
            }
        });
        $("#getCodeModal").modal('show');
        // $(".str_chat_list").on('scroll', function(){
        //     scrolled=true;
        // });

        $(document).on('click', '.tlm_chat_top_tab', function () {
            $('.tlm_chat_top_tab').removeClass('active');
            $('.tlm_display_chat').attr('style', 'display:none;');
            // $('.tlm_chat_top_tab').attr('style','border-bottom: none;');
            // $(this).attr('style','border-bottom: 1px solid red;');
            $('.' + $(this).data('chat')).attr('style', 'display:block;');
            $(this).addClass('active');
        });
        $(document).on('click', '#cclick', function () {
            connection.replaceTrack({
                video: false,
                oneway: true
            });
        });
        $('[data-toggle="tooltip"]').tooltip();
    });
    // $(document).on('click', '.btn_send_tip', function(){
    //     $('.razorpay-payment-button').trigger('click');
    // });
    $(document).on('click', '#tlm_send_tip_main_btn', function () {
        var obj = $(this);
        let model_id = $('.str_privatechat_send_btn2').data('model_id');
        let user_id = $('.str_privatechat_send_btn2').data('userid');
        var coin = $('input[name="tlm_sendTip"]:checked').val();
        var tlm_data = {
            action: 'tlm_send_tip_action',
            key: model_id,
            user: user_id,
            coin: coin,
        }
        if (model_id && model_id != '' && coin != '' && coin > 0) {
            $.ajax({
                url: 'ajax.php',
                type: 'POST',
                data: tlm_data,
                beforeSend: function () {
                    obj.attr('style', 'display:none;');
                    obj.parent().find('#tlm_loader').attr('style', 'display:blobk;');
                },
                complete: function () {
                    obj.attr('style', 'display:block;');
                    obj.parent().find('#tlm_loader').attr('style', 'display:none;');
                },
                success: function (response) {
                    if (response.trim() == '"success"') {
                        var total_coin = $('.tlm_show_coins').html();
                        $('.tlm_show_coins').html(parseInt(total_coin) - parseInt(coin));
                        $('#tlm_send_tip_popup').find('.modal-footer p').remove();
                        $('#tlm_send_tip_popup').find('.modal-footer').prepend('<p style="font-size:16px;color: #79943d;" class="tlm_success_tip">Tip successfully sent</p>');
                        setTimeout(function () {
                            $('#tlm_send_tip_popup').find('.modal-footer p').remove();
                        }, 4000);
                    }
                }
            });
        }
    });
    $(document).on('click', '#tlm_private_chat_main_btn', function () {
        let model_id = $('.str_privatechat_send_btn2').data('model_id');
        let user_id = $('.str_privatechat_send_btn2').data('userid');
        // var coin        = $('input[name="tlm_private_chat_tip"]:checked').val();
        var tlm_data = {
            action: 'tlm_private_chat_action',
            key: model_id,
            user: user_id,
            // coin      : coin,
        }
        $(this).attr('style', 'display:none');
        $('#tlm_wait_for_connection').html('Wait For connection');
        $('#tlm_loader').attr('style', 'display:block');
        if (model_id && model_id != '') {
            $.ajax({
                url: 'ajax.php',
                type: 'POST',
                data: tlm_data,
                beforeSend: function () {
                },
                complete: function () {
                },
                success: function (response) {
                    if(response=='success'){
                        tlm_private_chat_check();
                    }
                    else{
                        alert(response);
                    }

                }
            });
        }
    });
    function tlm_private_chat_check() {
        let model_id = $('.str_privatechat_send_btn2').data('model_id');
        let user_id = $('.str_privatechat_send_btn2').data('userid');
        // var coin     = $('input[name="tlm_private_chat_tip"]:checked').val();
        var tlm_data = {
            action: 'tlm_private_chat_url_action',
            key: model_id,
            user: user_id,
            // coin      : coin,
        }
        if (model_id && model_id != '') {
            $.ajax({
                url: 'ajax.php',
                type: 'POST',
                data: tlm_data,
                beforeSend: function () {
                },
                complete: function () {
                },
                success: function (response) {
                    if (response.trim() == '"success"') {
                        setTimeout(function () {
                            // window.location.href = "https://thelivemodels.com/live-chat/index.php?user=viewer&unique_model_id="+model_id+"&pra=private"; 
                          //  $('#tlm_user_private_vidchat').trigger('click');
                        }, 15000);
                    }
                    setTimeout(function () {
                        tlm_private_chat_check();
                    }, 3000);
                    // var total_coin = $('.tlm_show_coins_private_chat').html();
                    // $('.tlm_show_coins_private_chat').html(parseInt(total_coin)-parseInt(coin));
                    // // $('#tlm_close_private_chat_box').trigger('click');
                    // tlm_private_chat_check();
                }
            });
        }
    }
    function tlm_check_url() {
        let model_id = $('.str_privatechat_send_btn2').data('model_id');
        let user_id = $('.str_privatechat_send_btn2').data('userid');
        // var coin     = $('input[name="tlm_private_chat_tip"]:checked').val();
        var tlm_data = {
            action: 'tlm_check_url_action',
            key: model_id,
            user: user_id,
            // coin      : coin,
        }
        if (model_id && model_id != '') {
            $.ajax({
                url: 'ajax.php',
                type: 'POST',
                data: tlm_data,
                dataType: 'json',
                beforeSend: function () {
                },
                complete: function () {
                },
                success: function (response) {
                    // console.log(response.trim());
                    if (response.status == 'ok') {
                        //$('#tlm_start_private_popup11').attr('style','display:block;opacity:1;');
                        $('#tlm_start_private_popup11 .modal-body').html(response.html);
                        $('.private-request').html(response.counts);
                        if(userpage=='user'){
                            gotoprivate(response.id);
                        }
                    }
                    else {
                        $('.private-request').html('');
                    }
                    setTimeout(function () {
                        tlm_check_url();
                    }, 3000);

                }
            });
        }
    }
})(jQuery);