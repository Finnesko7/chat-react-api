import './App.css';
import Login from "./Pages/Login";
import {BrowserRouter as Router, useRoutes} from "react-router-dom";
import Registration from "./Pages/Registration";
import Rooms from "./Pages/Rooms/index";
import React from "react";
import Chat from "./Pages/Chat/index";
// import Socket from "./Pages/Socket";


function App() {
    const Routers = () => {
        return useRoutes([
            {path: "/", element: <Login/>},
            {path: "/register", element: <Registration/>},
            {path: "/rooms", element: <Rooms/>},
            {path: "/chat/:roomId", element: <Chat/>},
            // {path: "/test", element: <Socket/>},
        ]);
    };


    return (

        <div className="App">
            <Router>
                <Routers/>
            </Router>
        </div>

    );
}

export default App;
