import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
    const audio =  new Audio('/audio/48831.mp3');
    $(".chat-messages").scrollTop($(".chat-messages")[0].scrollHeight);

    const id_sender = $('.id_sender').val();
    const id_receiver = $('.id_receiver').val();

    $(".send-messager" ).click(function() {
        $.ajax({
            url: "/ajax-send-messager/"+id_sender+'/'+id_receiver+'/'+$('input.content').val(),
            type: "POST",
            success: function(result){
                $(".chat-messages").scrollTop($(".chat-messages")[0].scrollHeight);
                $('input.content').val('');
            }});
    });
    Pusher.logToConsole = true;
    const pusher = new Pusher('194a34f389c1f1a76d94', {
        encrypted: true,
        cluster: "ap1"
    });
    const channel = pusher.subscribe('sentMessager');
    console.log(channel)
    channel.bind('send-message', function (data) {
        if (data.id_receiver == $('.auth_id').val()) {
            audio.play();
        }
        getMessagerRealtime()
    });

    function getMessagerRealtime() {
        $.ajax({url: "/get-messager-realtime/"+id_sender+'/'+id_receiver,
            success: function(result){
                $('.chat-messages').append(result);
                $('.chat-messages').scrollTop($('.chat-messages')[0].scrollHeight);
            }});
    }
});
