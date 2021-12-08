import echo from "./index";

const channelName = "laravel_database_notification";


export const subscribeToChat = (roomId, cb) => {
    echo.listen(`${channelName}.${roomId}`,
        '.message.send', (message) => {
        console.log('we are received message');
        cb(message);
    });
}

export const leaveChat = () => {
    echo.leaveChannel(channelName);
}
