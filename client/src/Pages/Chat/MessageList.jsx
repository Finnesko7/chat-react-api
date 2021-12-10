import * as React from 'react';
import List from '@mui/material/List';
import Message from "./Message";
import {useCookies} from "react-cookie";

const MessageList = ({messages}) => {
    const [cookies] = useCookies();

    return (
        <List sx={{width: '100%', maxWidth: '100%', bgcolor: '#f0f3f4'}}>
            {messages && messages.map((message, index) =>
                <Message key={index} message={message} currentUserId={cookies.userId}/>)}
        </List>
    );
}

export default MessageList;