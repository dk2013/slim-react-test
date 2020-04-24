import React from 'react';
import logo from './logo.svg';

class App extends React.Component {
    render () {
        return (
            <div className="App">   
                <div className="w3-sidebar w3-light-grey w3-card-4 w3-animate-left" id="mySidebar">
                    <div className="w3-bar w3-dark-grey">
                        <span className="w3-bar-item w3-padding-16">Nav</span>
                        <button onClick={this.w3_close} className="w3-bar-item w3-button w3-right w3-padding-16"
                            title="close Sidebar">×</button>
                    </div>
                    <div className="w3-bar-block">
                        <a className="w3-bar-item w3-button w3-green" href="javascript:void(0)">Home</a>
                        <a className="w3-bar-item w3-button" href="javascript:void(0)">Notes</a>
                    </div>
                </div>
                <div id="main">
                    <div className="w3-container w3-display-container">
                        <span title="open Sidebar" id="openNav"
                            className="w3-button w3-transparent w3-display-topleft w3-xlarge" onClick={this.w3_open}>☰</span>
                        <h3 className="h3">Slim and React test task</h3>
                        <div className="content">
                            Content
                        </div>
                    </div>
                </div>
            </div>
        );
    }

    componentDidMount() {
        
    }
    w3_open = () => {
        document.getElementById("main").style.marginLeft = "180px";
        document.getElementById("mySidebar").style.width = "180px";
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("openNav").style.display = 'none';
    }

    w3_close = () => {
        document.getElementById("main").style.marginLeft = "0";
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("openNav").style.display = "inline-block";
    }
    
}


export default App;