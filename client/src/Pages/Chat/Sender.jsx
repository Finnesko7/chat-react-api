import React, {useState, useContext} from "react";
import {Button, Grid, TextField} from "@material-ui/core";
import SendIcon from "@mui/icons-material/Send";
import {ChatContext} from "../../reducers/ChatReducer";
import {useCookies} from "react-cookie";
import axios from "axios";

const Sender = ({roomId}) => {
    const [text, setText] = useState('');
    const {chatDispatch} = useContext(ChatContext);
    const [cookies] = useCookies();

    const handleChangeMessage = (e) => {
        setText(e.target.value);
    };

    const sendMessage = () => {
        axios.post('/api/message/send', {
            roomId,
            text
        }, {
            headers: {
                'Authorization': `Bearer ${cookies.Authorization}`,
                // 'X-Socket-Id':  echo.socketId()
            }
        }).then(function (response) {
            pushMessageToStore(response.data.authorName, response.data.text, response.data.sendTime);

            setText('');
        }).catch(function (error) {
            console.log(error);
        });
    }

    const pushMessageToStore = (author, text, sendTime) => {
        chatDispatch({
            type: 'push_message',
            payload: {
                message: {
                    authorId: cookies.userId,
                    author,
                    text,
                    sendTime
                }
            }
        });
    }

    return (
        <>
            <Grid item xs={10} style={{marginBottom: 0, paddingTop: 5, paddingLeft: 20, paddingRight: 20}}>
                <TextField
                    fullWidth={true}
                    id="standard-basic"
                    variant="standard"
                    onChange={handleChangeMessage}
                    value={text}
                />
            </Grid>
            <Grid item xs={2}>
                <div>
                    <Button
                        fullWidth={true}
                        variant="contained"
                        endIcon={<SendIcon/>}
                        color={"primary"}
                        onClick={sendMessage}
                    >
                        Send
                    </Button>
                </div>
            </Grid>
        </>
    );
}

export default Sender;