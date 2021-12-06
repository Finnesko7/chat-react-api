import React, {useEffect} from "react";
import {Avatar, Button, List, ListItem, ListItemAvatar, ListItemText, TextField, Typography} from "@mui/material";

import Echo from 'laravel-echo';
import socketio from 'socket.io-client';

window.echo = new Echo({
    host: window.location.hostname + ':8080',
    broadcaster: 'socket.io',
    client: socketio,
    transports: ['websocket'],
    auth: {
        headers: {
            Accept: 'application/json'
        }
    }
});

function ImageIcon() {
    return null;
}

const Chat = () => {
    useEffect(() => {
        window.echo.channel('laravel_database_notification.1')
            .listen('.message.send', (message) => {
                console.log('join to channel ');

                console.log('log socket message =>', message);
            }).error(error => console.log('error to join channel', error))
            .subscribed(subscribe => console.log('subscribe', subscribe));
    });

    return (
        <>
            <List sx={{ width: '100%', minHeight:500, minWidth: 700, bgcolor: 'background.paper', border: 2 }}>
                <ListItem
                    secondaryAction={
                        <Typography> Lorem ipsum dolor sit amet, consecte</Typography>
                    }
                >
                    <ListItemAvatar>
                        <Avatar>
                            <ImageIcon />
                        </Avatar>
                    </ListItemAvatar>
                    <ListItemText primary="Author" secondary="yesterday 12:25" />
                </ListItem>
            </List>
            <TextField />
            <Button variant="contained">Send</Button>
        </>
    )
}

export default Chat;