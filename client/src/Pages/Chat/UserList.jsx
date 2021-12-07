import React from "react";
import {Avatar, List, ListItem, ListItemAvatar, ListItemText, ListSubheader} from "@material-ui/core";
import ImageIcon from '@mui/icons-material/Image';

const UserList = () => {
    return (
        <List
            sx={{width: '100%', maxWidth: 360, bgcolor: 'background.paper'}}
            subheader={
                <ListSubheader component="div" id="nested-list-subheader">
                    Online users
                </ListSubheader>
            }
        >
            <ListItem>
                <ListItemAvatar>
                    <Avatar>
                        <ImageIcon/>
                    </Avatar>
                </ListItemAvatar>
                <ListItemText primary="User Name (1)"/>
            </ListItem>
            <ListItem>
                <ListItemAvatar>
                    <Avatar>
                        <ImageIcon/>
                    </Avatar>
                </ListItemAvatar>
                <ListItemText primary="User Name (2)"/>
            </ListItem>
            <ListItem>
                <ListItemAvatar>
                    <Avatar>
                        <ImageIcon/>
                    </Avatar>
                </ListItemAvatar>
                <ListItemText primary="User Name (3)"/>
            </ListItem>
        </List>
    );
}

export default UserList;