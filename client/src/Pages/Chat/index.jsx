import React, {useReducer} from "react";
import {Box, Grid} from "@material-ui/core";
import UserList from "./UserList";
import MessageList from "./MessageList";
import {useParams} from "react-router-dom";
import Sender from "./Sender";
import {initChatState, ChatReducer, ChatContext} from "../../reducers/ChatReducer";


const Chat = () => {
    const [chatState, chatDispatch] = useReducer(ChatReducer, initChatState,);

    const {roomId} = useParams();

    return (
        <ChatContext.Provider value={{chatDispatch, chatState}}>
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
                    <Sender roomId={roomId}/>
                </Grid>
            </Box>
        </ChatContext.Provider>
    );
}

export default Chat;