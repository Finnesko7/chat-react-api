import React from "react";
import {Avatar, ListItem, ListItemAvatar, ListItemButton, ListItemText} from "@mui/material";
import {useNavigate} from "react-router-dom";

function ImageIcon() {
    return null;
}

const RoomItem = ({ name, id}) => {
    const navigate = useNavigate();

    const redirectToChat = () => {
        navigate(`/chat/${id}`);
    }

    return (
        <ListItem
            secondaryAction={
                <ListItemButton onClick={redirectToChat}> Join</ListItemButton>
            }
        >
            <ListItemAvatar>
                <Avatar>
                    <ImageIcon />
                </Avatar>
            </ListItemAvatar>
            <ListItemText primary={name} />
        </ListItem>
    );
}

export default RoomItem;