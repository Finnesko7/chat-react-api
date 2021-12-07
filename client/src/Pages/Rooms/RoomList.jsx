import React, {useEffect, useState} from "react";
import {
    Box,
    Button,
    List,
    TextField,
    Typography
} from "@mui/material";
import axios from "axios";
import RoomItem from "./RoomItem";

const RoomList = () => {

    const [rooms, setRooms] = useState([]);

    useEffect(() => {
        axios.get('http://localhost:8080/api/chats')
            .then(function (response) {
                setRooms(response.data.chats);
            })
            .catch(function (error) {
                console.log(error);
            });
    }, []);


    return (
        <>
            <Box sx={{padding: 2 , width: 600}}>
                <TextField placeholder="Name of room" />
                <Button size="medium" variant="contained" sx={{padding: 2, ml: 5}}>Create room</Button>
            </Box>
            <Box sx={{width: 600, maxHeight: 500}}>
                <Typography variant="h6"> Select room</Typography>
                <List sx={{ width: '100%', maxWidth: 500 }}>
                    {rooms.map((room) => <RoomItem key={room.id} id={room.id} name={room.name} />)}
                </List>
            </Box>
        </>

    )
}

export default RoomList;