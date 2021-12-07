import * as React from 'react';
import List from '@mui/material/List';
import Message from "./Message";
import {useEffect, useState} from "react";
import axios from "axios";
import {useCookies} from "react-cookie";

const MessageList = ({roomId}) => {

    const [cookies] = useCookies(['Authorization']);
    const [messages, setMessages] = useState([]);

    useEffect(() => {
        axios.get(`http://localhost:8080/api/chats/room/${roomId}`)
            .then(function (response) {
                console.log('messages', response.data.messages)
                setMessages(response.data.messages);
            })
            .catch(function (error) {
                console.log(error);
            });
    }, [roomId]);

    return (
        <List sx={{ width: '100%', maxWidth: '100%', bgcolor: '#f0f3f4' }}>
            {messages.length > 0 && messages.map((message, index) => <Message key={index} message={message}/>) }
        </List>
    );
}

export default MessageList;