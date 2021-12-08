// import {useState} from "react";
// import Echo from "laravel-echo";
// import socketIo from "socket.io-client";
//
//
// const echo = new Echo({
//     host: window.location.hostname + ':8080',
//     broadcaster: 'socket.io',
//     client: socketIo,
//     transports: ['websocket'],
//     auth: {
//         headers: {
//             Accept: 'application/json'
//         }
//     }
// });
//
// export const useSocketNotification = (roomId) => {
//     const [message, setMessage] = useState(null);
//     const [subscribe, setSubscribe] = useState(null);
//     const [error, setError] = useState(null);
//
//     echo.channel(`laravel_database_notification.${roomId}`)
//         .listen('.message.send', (message) => {
//             setMessage(message);
//         })
//         .error(error => setError(error))
//         .subscribed(subscribe => setSubscribe(subscribe));
//
//     return {
//         message,
//         subscribe,
//         error
//     }
// }
//
