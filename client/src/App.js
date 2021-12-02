import './App.css';
import Login from "./Pages/Login";
import {BrowserRouter as Router, useRoutes} from "react-router-dom";
import Registration from "./Pages/Registration";

function App() {

    const Routers = () => {
        return useRoutes([
            { path: "/", element: <Login /> },
            { path: "/register", element: <Registration /> },
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
