import React from 'react';

/**
 * Static page footer including disclaimer and author details.
 * 
 * @author Alex Hakesley w16011419
 */

class Footer extends React.Component {
    render() {
        return (
            <footer>
                <div>
                    <h3>Disclaimer</h3>
                    <p>This work has been developed as part of coursework for KF6012 Web Application Integration
                        at Northumbria University, and is not associated with or endorsed by the Designing Interactive
                        Systems (DIS) conference.
                    </p>
                </div>
                <div>
                    <h3>Author</h3>
                    <p>Alex Hakesley</p>
                    <p>w16011419</p>
                    <p>alex.s.hakesley@northumbria.ac.uk</p>
                </div>
            </footer>
        )
    }
}

export default Footer;