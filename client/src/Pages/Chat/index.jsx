import React, {useReducer} from "react";
import {Box, Grid} from "@material-ui/core";
import UserList from "./UserList";
import MessageList from "./MessageList";
import {useParams} from "react-router-dom";
import Sender from "./Sender";
import {initChatState, ChatReducer, ChatContext} from "../../reducers/ChatReducer";
import {useChat} from "../../Hooks/useChat";



const Chat = () => {
    const {roomId} = useParams();
    const [chatState, chatDispatch] = useReducer(ChatReducer, initChatState);
    const {users, messages} = useChat(roomId);

    return (
        <ChatContext.Provider value={{chatDispatch, chatState}}>
            <Box sx={{ flexGrow: 1}} mb={0} height='95vh'>
                <Grid container style={{height:'100%'}} >
                    <Grid item xs={10} style={{height:'100%'}} >
                        <div
                            style={{backgroundColor: '#f0f3f4', height: '100%', overflow:'auto' }}>
                            <MessageList messages={messages} />
                        </div>
                    </Grid>
                    <Grid item xs={2} style={{height:'100%'}} >
                        <UserList users={users}/>
                    </Grid>
                    <Sender roomId={roomId}/>
                </Grid>
            </Box>
        </ChatContext.Provider>
    );
}

export default Chat;