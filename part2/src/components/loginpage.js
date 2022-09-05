import React from "react";
import {Navigate} from "react-router-dom";

/**
 * Displays email address and password input fields and 
 * submit button for logging in.
 * 
 * @author Alex Hakesley w16011419
 */


class LoginPage extends React.Component {
    
    render() {
        if (this.props.authenticated) {
            return <Navigate to="/readinglist"/>;
        } else {
            return (
            <div className="login-page-form">
                <h2 className="login-page-heading">Log In</h2>
                <div className="login-page-body">
                    <input  
                        autoFocus
                        name="email-address"
                        type="text"
                        placeholder='Email address'
                        value={this.props.email}
                        onChange={this.props.handleEmail}
                    />
                
                    <input 
                        name='password'
                        type='password'
                        placeholder='Password'
                        value={this.props.password}
                        onChange={this.props.handlePassword}
                    />
                    <button onClick={this.props.handleLoginClick}>Login</button>
                </div>
            </div>
            )
        }
    }
}

export default LoginPage;