import * as React from 'react';
import List from '@mui/material/List';
import Message from "./Message";
// import {useEffect, useState, useContext} from "react";
// import axios from "axios";
import {useCookies} from "react-cookie";
// import {ChatContext} from "../../reducers/ChatReducer";

const MessageList = ({messages}) => {
    const [cookies] = useCookies();
    // const {chatState, chatDispatch} = useContext(ChatContext);

    console.log('render ...', messages);

    // useEffect(() => {
    //     if (chatState.init === false) {
    //         setMessages([...messages, chatState.message]);
    //     }
    //     // eslint-disable-next-line
    // }, [chatState.message, chatState.init]);

    return (
        <List sx={{width: '100%', maxWidth: '100%', bgcolor: '#f0f3f4'}}>
            {messages && messages.map((message, index) =>
                <Message key={index} message={message} currentUserId={cookies.userId}/>)}
        </List>
    );
}

export default MessageList;