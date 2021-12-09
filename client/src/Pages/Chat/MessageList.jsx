import * as React from 'react';
import List from '@mui/material/List';
import Message from "./Message";
import {useEffect, useState, useContext} from "react";
import axios from "axios";
import {useCookies} from "react-cookie";
import {subscribeToChat} from "../../Services/SocketService/SocketChatService";
import {ChatContext} from "../../reducers/ChatReducer";

const MessageList = ({roomId}) => {

    const [cookies] = useCookies();
    const [messages, setMessages] = useState(null);
    const {chatState, chatDispatch} = useContext(ChatContext);

    console.log('render ...');

    useEffect(() => {
        if (messages === null) {
            axios.get(`http://localhost:8080/api/chats/room/${roomId}`)
                .then(function (response) {
                    setMessages(response.data.messages);
                })
                .catch(function (error) {
                    console.log(error);
                });
        }

        // If we received message , then push it to state (chatState)
        subscribeToChat(roomId, (message) => {
            chatDispatch({type: 'push_message', payload: {message}});
        });
        // eslint-disable-next-line
    }, [roomId, chatDispatch]);


    useEffect(() => {
        if (chatState.init === false) {
            setMessages([...messages, chatState.message]);
        }
        // eslint-disable-next-line
    }, [chatState.message, chatState.init]);

    return (
        <List sx={{width: '100%', maxWidth: '100%', bgcolor: '#f0f3f4'}}>
            {messages && messages.map((message, index) =>
                <Message key={index} message={message} currentUserId={cookies.userId}/>)}
        </List>
    );
}

export default MessageList;