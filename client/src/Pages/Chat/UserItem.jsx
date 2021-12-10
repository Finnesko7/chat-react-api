import React from "react";
import {Avatar, ListItem, ListItemAvatar, ListItemText} from "@material-ui/core";
import ImageIcon from "@mui/icons-material/Image";

const UserItem = ({name}) => {
    return (
        <ListItem>
            <ListItemAvatar>
                <Avatar>
                    <ImageIcon/>
                </Avatar>
            </ListItemAvatar>
            <ListItemText primary={name} />
        </ListItem>
    );
}

export default UserItem;