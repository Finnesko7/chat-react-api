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

export default echo;