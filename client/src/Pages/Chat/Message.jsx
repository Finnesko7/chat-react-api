import React, {useRef} from "react";
import ListItem from "@mui/material/ListItem";
import ListItemAvatar from "@mui/material/ListItemAvatar";
import Avatar from "@mui/material/Avatar";
import ListItemText from "@mui/material/ListItemText";
import Typography from "@mui/material/Typography";
import Divider from "@mui/material/Divider";

const Message = ({message, currentUserId}) => {

    const messageColor = useRef('inherit');

    if (message.authorId === currentUserId) {
        messageColor.current = '#70c9e7';
    }

    return (
        <>
            <ListItem alignItems="flex-start" sx={{bgcolor: messageColor.current}}>
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