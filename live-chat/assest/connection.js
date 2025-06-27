      
   (function ($) {
    'use strict';


    let pc;
    let localStream;
    const signalingURL = 'ajax.php';
   
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

        document.getElementById('open-room').onclick = async function () {

            disableInputButtons();
            const roomId = document.getElementById('room-id').value;

            localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
            document.getElementById('videos-container').innerHTML = '<video autoplay muted playsinline></video>';
            document.querySelector('#videos-container video').srcObject = localStream;

            pc = new RTCPeerConnection();
            localStream.getTracks().forEach(track => pc.addTrack(track, localStream));

            pc.onicecandidate = e => {
                if (e.candidate) sendSignal('offer-candidate', e.candidate);
            };

            const offer = await pc.createOffer();
            await pc.setLocalDescription(offer);
            sendSignal('offer', offer);

            setInterval(async () => {
                const res = await fetch(`${signalingURL}?action=get-answer&room=${roomId}`);
                const answer = await res.text();
                if (answer && !pc.currentRemoteDescription) {
                    await pc.setRemoteDescription(new RTCSessionDescription(JSON.parse(answer)));
                }
            }, 1500);

            setInterval(async () => {
                const res = await fetch(`${signalingURL}?action=get-answer-candidates&room=${roomId}`);
                const list = JSON.parse(await res.text());
                list.forEach(c => pc.addIceCandidate(new RTCIceCandidate(c)));
            }, 1500);
        };


        document.getElementById('join-room').onclick = async function () {
            disableInputButtons();
            const roomId = document.getElementById('room-id').value;

            pc = new RTCPeerConnection();
            pc.ontrack = (e) => {


                document.getElementById('videos-container').innerHTML = '<video autoplay playsinline></video>';
                document.querySelector('#videos-container video').srcObject = e.streams[0];


            };

            pc.onicecandidate = e => {
                if (e.candidate) sendSignal('answer-candidate', e.candidate);
            };

            const res = await fetch(`${signalingURL}?action=get-offer&room=${roomId}`);
            const offer = await res.text();
            if (!offer) return alert('No broadcast found');

            await pc.setRemoteDescription(new RTCSessionDescription(JSON.parse(offer)));

            const answer = await pc.createAnswer();
            await pc.setLocalDescription(answer);
            sendSignal('answer', answer);

            setInterval(async () => {
                const res = await fetch(`${signalingURL}?action=get-offer-candidates&room=${roomId}`);
                const list = JSON.parse(await res.text());
                list.forEach(c => pc.addIceCandidate(new RTCIceCandidate(c)));
            }, 1500);
        };


    function disableInputButtons() {
        
        document.getElementById('room-id').onkeyup();
        document.getElementById('room-id').disabled = true;
    }

    function sendSignal(type, data) {
        const roomId = document.getElementById('room-id').value;
     
          var tlm_data = {
            action: type,
            room: roomId,
            data: data,
        }

        $.ajax({
            url: signalingURL,
            type: 'POST',
            data: tlm_data,
            dataType: 'json',
            beforeSend: function () {
            },
            complete: function () {
            },
            success: function (response) {

                // // console.log(response.trim());
                // if (response.status == 'ok') {
                //     //$('#tlm_start_private_popup11').attr('style','display:block;opacity:1;');
                //     $('#tlm_start_private_popup11 .modal-body').html(response.html);
                //     $('.private-request').html(response.counts);
                //     if(userpage=='user'){
                //         gotoprivate(response.id);
                //     }
                // }
                // else {
                //     $('.private-request').html('');
                // }
                // setTimeout(function () {
                //     tlm_check_url();
                // }, 3000);

            }
        });
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
      
    
     



   

