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
    var pusher = new Pusher('194a34f389c1f1a76d94', {
        encrypted: true,
        cluster: "ap1"
    });
    var channel = pusher.subscribe('send-messager');
    channel.bind('App\\Events\\SendMessager', getMessagerRealtime);

    function getMessagerRealtime() {
        $.ajax({url: "/get-messager-realtime/"+id_sender+'/'+id_receiver,
            success: function(result){
                audio.play();
                $('.chat-messages').append(result);
                $(".chat-messages").scrollTop($(".chat-messages")[0].scrollHeight);
            }});
    }
});
