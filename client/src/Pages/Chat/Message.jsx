import React from "react";
import ListItem from "@mui/material/ListItem";
import ListItemAvatar from "@mui/material/ListItemAvatar";
import Avatar from "@mui/material/Avatar";
import ListItemText from "@mui/material/ListItemText";
import Typography from "@mui/material/Typography";
import Divider from "@mui/material/Divider";

const Message = ({message}) => {

    const senderMessageColor = '#70c9e7'

    return (
        <>
            <ListItem alignItems="flex-start" sx={{bgcolor: 'inherit'}}>
                <ListItemAvatar>
                    <Avatar alt={message.author} src="none.jpg"/>
                </ListItemAvatar>
                <ListItemText
                    primary={message.author}
                    secondary={
                        <React.Fragment>
                            <Typography
                                sx={{display: 'inline'}}
                                component="span"
                                variant="body2"
                                color="text.primary"
                            >
                                {message.sendTime}
                            </Typography>
                            <br/>
                            {message.text}
                        </React.Fragment>
                    }
                />
            </ListItem>
            <Divider variant="inset" component="li"/>
        </>
    );
}

export default Message;