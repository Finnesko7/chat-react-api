// import echo from "./index";
//
// const channelName = "notification";
//
// export const subscribeToChat = (roomId, cb) => {
//     echo.join(`${channelName}.${roomId}`)
//         .joining(user => console.log('join user', user))
//         .listen('.message.send', (message) => cb(message));
// }
//
// export const leaveChat = () => {
//     echo.leaveChannel(channelName);
// }
