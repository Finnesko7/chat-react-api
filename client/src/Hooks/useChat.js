import socketIo from "socket.io-client";
import Echo from "laravel-echo";
import {useState, useEffect} from "react";
import axios from "axios";

const channelName = "notification";
const authorization = getCookie('Authorization');

if (window.echo === undefined) {
    console.log('init echo');

    window.echo = new Echo({
        host: window.location.hostname + ':8080',
        broadcaster: 'socket.io',
        client: socketIo,
        transports: ['websocket'],
        auth: {
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${authorization}`
            }
        }
    });
}

export const useChat = (roomId) => {
    const [users, setUsers] = useState([]);
    const [messages, setMessages] = useState(null);


    useEffect(() => {
        window.echo.join(`${channelName}.${roomId}`)
            .joining(user => {
                console.log('user joining => ', user.name);

                setUsers([...users, user]);
            })
            .leaving(livedUser => {
                console.log('user is lived', livedUser.name);

                setUsers(users.filter(user => {
                    return user.id !== livedUser.id
                }));
            })
            .listen('.message.send', (message) => {
                console.log('message was received', message);

                setMessages([...messages, message]);
            });

        if (messages === null) {
            axios.get(`http://localhost:8080/api/chats/room/${roomId}`)
                .then(function (response) {
                    setMessages(response.data.messages);
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    }, [roomId]);


    return {users, messages}
}


function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([.$?*|{}()[\]\\/+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}
