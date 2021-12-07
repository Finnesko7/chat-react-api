import React from "react";
import {CssBaseline} from "@mui/material";
import RoomList from "./RoomList";
import {createTheme, ThemeProvider} from '@mui/material/styles';
import {Box, Container} from "@material-ui/core";

const theme = createTheme();

const Rooms = () => (
    <div>
        <ThemeProvider theme={theme}>
            <Container component="main" maxWidth="xs">
                <CssBaseline/>
                <Box
                    sx={{
                        marginTop: 8,
                        display: 'flex',
                        flexDirection: 'column',
                        alignItems: 'center',
                    }}
                >
                    <RoomList/>
                </Box>
            </Container>
        </ThemeProvider>
    </div>
)

export default Rooms;