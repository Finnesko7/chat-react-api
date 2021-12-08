import React, {useEffect} from "react";
import Echo from 'laravel-echo';
import socketIo from 'socket.io-client';

window.echo = new Echo({
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

const Socket = () => {

    useEffect(() => {
        window.echo.channel('laravel_database_notification.1')
            .listen('.message.send', (message) => {
                console.log('log socket message =>', message);
            }).error(error => console.log('error to join channel', error))
            .subscribed(subscribe => console.log('subscribe', subscribe));
    });

    return (
        <>
            Test page
        </>
    )
}

export default Socket;