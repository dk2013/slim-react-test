'use strict';
import React from 'react';
import logo from './logo.svg';

import Home from './Components/Home/Home';
import Notes from './Components/Notes/Notes';

import {
    Route,
    Switch,
    NavLink
  } from "react-router-dom";

class App extends React.Component {
    constructor() {
        super();
        this.state = {
            main: {
                marginLeft: '100px'
            },
            mySidebar: {
                width: '100px',
                display: 'block'
            },
            openNav: {
                display: 'none'
            }
        }
    }
    render () {
        return (
            <div className="App">   
                <div id="mySidebar" className="w3-sidebar w3-light-grey w3-card-4 w3-animate-left" 
                    style={{width: this.state.mySidebar.width, display:this.state.mySidebar.display}}>
                    <div className="w3-bar w3-dark-grey">
                        <span className="w3-bar-item w3-padding-16">Nav</span>
                        <button onClick={this.w3_close} className="w3-bar-item w3-button w3-right w3-padding-16"
                            title="close Sidebar">×</button>
                    </div>
                    <div className="w3-bar-block">
                        <NavLink exact={true} className="w3-bar-item w3-button" activeClassName="w3-green" to='/'>Home</NavLink>
                        <NavLink exact={true} className="w3-bar-item w3-button" activeClassName="w3-green" to='/notes'>Notes</NavLink>
                    </div>
                </div>
                <div id="main" style={{marginLeft: this.state.main.marginLeft}}>
                    <div className="w3-container w3-display-container">
                        <span title="open Sidebar" id="openNav"
                            className="w3-button w3-transparent w3-display-topleft w3-xlarge" 
                            style={{display: this.state.openNav.display}}
                            onClick={this.w3_open}>☰</span>
                        <h3 className="h3">Slim and React test task</h3>
                        <div className="container">
                        <Switch>
                            <Route path='/notes' component={Notes} />
                            <Route path='/' component={Home} />
                        </Switch>
                        </div>
                    </div>
                </div>
            </div>
        );
    }

    w3_open = () => {
        this.setState({
            main: {
                marginLeft: '100px'
            },
            mySidebar: {
                width: '100px',
                display: 'block'
            },
            openNav: {
                display: 'none'
            }
        });
    }

    w3_close = () => {
        this.setState({
            main: {
                marginLeft: '0'
            },
            mySidebar: {
                // width: '100px',
                display: 'none'
            },
            openNav: {
                display: 'inline-block'
            }
        });
    }    
}

export default App;