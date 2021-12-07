import React, {useState} from "react";
import {
    Avatar,
    Box,
    Button,
    TextField,
    Typography,
    Container, CssBaseline
} from "@mui/material";
import {createTheme, ThemeProvider} from '@mui/material/styles';

import axios from "axios";
import {useCookies} from "react-cookie";
import {Navigate} from "react-router-dom";


function LockOutlinedIcon() {
    return null;
}

const theme = createTheme();

const Login = () => {

    const [login, setLogin] = useState('');
    const [pass, setPass] = useState('');
    const [, setCookie] = useCookies(['Authorization']);
    const [rediret, setRedirect] = useState(false);

    const handleChangeLogin = (e) => {
        setLogin(e.target.value);
    };

    const handleChangePassword = (e) => {
        setPass(e.target.value);
    };

    const sendAuthData = () => {
        console.log(login, pass);

        axios.post('http://localhost:8080/api/login', {
            email: login,
            password: pass
        })
            .then(function (response) {
                console.log(response.data.token.plainTextToken);
                setCookie('Authorization', response.data.token.plainTextToken);
                setCookie('userId', response.data.user.id);

                setRedirect(true);
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    return (
        rediret === true ? <Navigate to="/rooms"/> :

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
                            <Avatar sx={{m: 1, bgcolor: 'secondary.main'}}>
                                <LockOutlinedIcon/>
                            </Avatar>
                            <Typography component="h1" variant="h5">
                                Login
                            </Typography>
                            <Box component="form" noValidate sx={{mt: 1}}>
                                <TextField
                                    margin="normal"
                                    required
                                    fullWidth
                                    id="email"
                                    label="Email"
                                    name="email"
                                    autoComplete="email"
                                    autoFocus
                                    onChange={handleChangeLogin}
                                    value={login}
                                />

                                <TextField
                                    margin="normal"
                                    required
                                    fullWidth
                                    name="password"
                                    label="Password"
                                    type="password"
                                    id="password"
                                    autoComplete="current-password"
                                    onChange={handleChangePassword}
                                    value={pass}
                                />

                                <Button
                                    onClick={sendAuthData}
                                    fullWidth
                                    variant="contained"
                                    sx={{mt: 3, mb: 2}}
                                >
                                    Sign In
                                </Button>
                            </Box>
                        </Box>
                    </Container>
                </ThemeProvider>
            </div>
    );
}

export default Login;