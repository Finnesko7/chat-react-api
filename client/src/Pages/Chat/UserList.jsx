import React from "react";
import {Avatar, List, ListItem, ListItemAvatar, ListItemText, ListSubheader} from "@material-ui/core";
import ImageIcon from '@mui/icons-material/Image';
import UserItem from "./UserItem";

const UserList = ({users}) => {
    return (
        <List
            sx={{width: '100%', maxWidth: 360, bgcolor: 'background.paper'}}
            subheader={
                <ListSubheader component="div" id="nested-list-subheader">
                    Online users
                </ListSubheader>
            }
        >
            {users.map(user => <UserItem key={user.id} name={user.name}/>)}
        </List>
    );
}

export default UserList;