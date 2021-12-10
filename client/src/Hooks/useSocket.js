import socketIo from "socket.io-client";
import Echo from "laravel-echo";
import {useState, useRef, useEffect} from "react";
import axios from "axios";

const channelName = "notification";
const authorization = getCookie('Authorization');

export const useChat = (roomId) => {
    const [users, setUsers] = useState([]);
    const [messages, setMessages] = useState(null);
    const echoRef = useRef(null);


    useEffect(() => {
        echoRef.current = new Echo({
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

        echoRef.current.join(`${channelName}.${roomId}`)
            .joining(user => {
                console.log('user joining => ', user.name);

                setUsers([...users, user]);
            }).
        listen( '.message.send', (message) => {
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

        return () => {
            echoRef.current.disconnect();
        }

    }, [roomId, messages]);


    return {users, messages}
}


function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([.$?*|{}()[\]\\/+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}
