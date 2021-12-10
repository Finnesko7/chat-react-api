import React from "react";

export const ChatContext = React.createContext();

export const initChatState = {
    init: true,
    message: {
        authorId: null,
        author: null,
        text: null,
        sendTime: null
    }
}

export const ChatReducer = (state, action) => {
    if (action.type === 'push_message') {
        console.log('state changed ...');
        // action when current user send message to chat
        return {init: false, ...action.payload};
    }

    return initChatState;
}