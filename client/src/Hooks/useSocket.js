import Echo from "laravel-echo";
import socketIo from "socket.io-client";

const echo = new Echo({
    host: window.location.hostname + ':8080',
    broadcaster: 'socket.io',
    client: socketIo,
    transports: ['websocket'],
    auth: {
        headers: {
            Accept: 'application/json'
        }
    }
});

export const socketNotification = (roomId) => {
    const listen = message => message;
    const handleSubscribe = subscribe => subscribe;
    const handleError = error => error;

    echo.channel(`laravel_database_notification.${roomId}`)
        .listen('.message.send', listen(message))
        .error(error => handleError(error))
        .subscribed(subscribe => handleSubscribe(subscribe));

    return {
        listen,
        subscribe: handleSubscribe,
        error: handleError
    }
}

