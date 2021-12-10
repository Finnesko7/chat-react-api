// import socketIo from "socket.io-client";
// import Echo from "laravel-echo";
//
// const authorization = getCookie('Authorization');
//
// const echo = new Echo({
//     host: window.location.hostname + ':8080',
//     broadcaster: 'socket.io',
//     client: socketIo,
//     transports: ['websocket'],
//     auth: {
//         headers: {
//             Accept: 'application/json',
//             Authorization: `Bearer ${authorization}`
//         }
//     }
// });
//
// function getCookie(name) {
//     let matches = document.cookie.match(new RegExp(
//         "(?:^|; )" + name.replace(/([.$?*|{}()[\]\\/+^])/g, '\\$1') + "=([^;]*)"
//     ));
//     return matches ? decodeURIComponent(matches[1]) : undefined;
// }
//
// export default echo;