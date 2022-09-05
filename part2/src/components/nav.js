import React from 'react';
import {NavLink} from 'react-router-dom';

/**
 * Nav bar with links to Home, Papers, Authors and Reading List pages,
 * with conditional login/logout button dependent on authentication.
 * 
 * @author Alex Hakesley w16011419
 */

class Nav extends React.Component {

    render() {
        let loginLogoutLink = (
            <li><NavLink className={({isActive}) => "nav-link" + (isActive ? "-active" : "")} to="/login">Log In</NavLink></li>
        )

        if (this.props.authenticated) {
            loginLogoutLink = (
                <li><NavLink className={({isActive}) => "nav-link" + (isActive ? "-active" : "")} to="/login" onClick={this.props.handleLogoutClick}>Log out</NavLink></li>
            )
        }

        return (
            <nav>
                <ul>
                    <li><NavLink className={({isActive}) => "nav-link" + (isActive ? "-active" : "")} to="/">Home</NavLink></li>
                    <li><NavLink className={({isActive}) => "nav-link" + (isActive ? "-active" : "")} to="/papers">Papers</NavLink></li>
                    <li><NavLink className={({isActive}) => "nav-link" + (isActive ? "-active" : "")} to="/authors">Authors</NavLink></li>
                    <li><NavLink className={({isActive}) => "nav-link" + (isActive ? "-active" : "")} to="/readinglist">Reading List</NavLink></li>
                    {loginLogoutLink}
                </ul>
            </nav>
        )
    }
}

export default Nav;