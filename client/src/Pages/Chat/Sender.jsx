import React, {useState} from "react";
import {Button, Grid, TextField} from "@material-ui/core";
import SendIcon from "@mui/icons-material/Send";

const Sender = () => {
    const [message, setMessage] = useState('');

    const handleChangeMessage = (e) => {
        setMessage(e.target.value);
    };

    const sendMessage = () => {
        console.log('message send', message);
    }

    return (
        <>
            <Grid item xs={10} style={{marginBottom: 0, paddingTop: 5, paddingLeft: 20, paddingRight: 20}}>
                <TextField
                    fullWidth={true}
                    id="standard-basic"
                    variant="standard"
                    onChange={handleChangeMessage}
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