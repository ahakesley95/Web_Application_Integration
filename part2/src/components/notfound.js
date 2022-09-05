import React from 'react';

/**
 * Displays a page if the requested URL does not exist.
 * 
 * @author Alex Hakesley w16011419
 */

class NotFound extends React.Component {
    render() {
        return (
            <div>
                <h2>PAGE NOT FOUND</h2>
                <h3>The page you were looking for could not be found.</h3>
            </div>
        )
    }
}

export default NotFound;