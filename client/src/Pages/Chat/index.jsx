import React from "react";
import {Box, Button, Grid, TextField} from "@material-ui/core";
import SendIcon from '@mui/icons-material/Send';
import UserList from "./UserList";
import MessageList from "./MessageList";
import {useParams} from "react-router-dom";

const Chat = () => {

    const {roomId} = useParams();

    return (
        <Box sx={{ flexGrow: 1}} mb={0} height='95vh'>
            <Grid container style={{height:'100%'}} >
                <Grid item xs={10} style={{height:'100%'}} >
                    <div
                        style={{backgroundColor: '#f0f3f4', height: '100%', overflow:'auto' }}>
                        <MessageList roomId={roomId} />
                    </div>
                </Grid>
                <Grid item xs={2} style={{height:'100%'}} >
                    <UserList/>
                </Grid>
                <Grid item xs={10} style={{marginBottom: 0, paddingTop: 5, paddingLeft: 20, paddingRight: 20}} >
                    <TextField
                        fullWidth={true}
                        id="standard-basic"
                        variant="standard"
                    />
                </Grid>
                <Grid item xs={2}>
                    <div>
                        <Button
                            fullWidth={true}
                            variant="contained"
                            endIcon={<SendIcon />}
                            color={"primary"}
                        >
                            Send
                        </Button>
                    </div>
                </Grid>
            </Grid>
        </Box>
    );
}

export default Chat;