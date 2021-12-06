import './App.css';
import Login from "./Pages/Login";
import {BrowserRouter as Router, useRoutes} from "react-router-dom";
import Registration from "./Pages/Registration";
import ListRooms from "./Pages/ListRooms";
import {Box, Container, CssBaseline} from "@mui/material";
import React from "react";
import { createTheme, ThemeProvider } from '@mui/material/styles';
import Chat from "./Pages/Chat";


const theme = createTheme();

function App() {

    const Routers = () => {
        return useRoutes([
            {path: "/", element: <Login/>},
            {path: "/register", element: <Registration/>},
            {path: "/rooms", element: <ListRooms/>},
            {path: "/chat/:id", element: <Chat/>},
        ]);
    };


    return (
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
                        <div className="App">
                            <Router>
                                <Routers/>
                            </Router>
                        </div>
                    </Box>
                </Container>
            </ThemeProvider>
        </div>
    );
}

export default App;
