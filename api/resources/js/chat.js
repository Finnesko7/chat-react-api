$(document).ready(function () {
    const roomId = $('#room-id').data('id');

    window.Echo
        .channel('notification.'+roomId)
        .listen('.message.send', (message) => {
            appendMessage(message.author, message.message, message.sendTime);
        });

    function appendMessage(author, text, sendTime) {
        let message = '<div class="p-6 bg-white border-b border-gray-200"><p>'+author+'</p><p>'+text+'</p><p>'+sendTime+'</p></div>';
        $('#chat-messages').append($(message));
        scrollToLastMessage();
    }

    function sendMessage() {
        let message = $('#chat-message').val();
        if (typeof message === 'string' && message !== '') {
            window.axios.post('/chat/message/send', {
                roomId: roomId,
                text: message,
            }).then(function (response) {
                appendMessage(response.data.authorName, response.data.text, response.data.sendTime);
                $('#chat-message').val('');
            }).catch(function (error) {
                //TODO show errors
                console.log(error);
            });
        }
    }

    function scrollToLastMessage() {
        let div = document.getElementById('chat-messages');
        $('#chat-messages').animate({
            scrollTop: div.scrollHeight - div.clientHeight
        }, 500);
    }

    $('#chat-message').on('keyup', function (event) {
        if (event.key === 'Enter' || event.keyCode === 13) {
            sendMessage();
        }
    });

    $('#send-msg-btn').on('click', function() {
        sendMessage();
    });

    setTimeout(scrollToLastMessage, 1000);
});
