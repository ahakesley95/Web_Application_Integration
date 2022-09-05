import React from "react";
import Papers from './papers.js';

/**
 * A component for displaying an author's name and any other
 * papers written by them.
 * 
 * @author Alex Hakesley w16011419
 */

class Author extends React.Component {

    constructor(props) {
        super(props)
        this.state = {
            display: false
        }
    }

    handleClick = () => {
        this.setState({display: !this.state.display})
    }

    render() {
        let details = "";
        if (this.state.display === true) {
            details = <div>
                <Papers 
                    author_id={this.props.author.author_id}
                    token={this.props.token}
                    isReadingList={false}
                />
            </div>
        }

        return (
            <div className="author-container">
                <div className="author-data">
                    <div className="author-heading">
                       <h2>{this.props.author.first_name + " " + this.props.author.last_name}</h2>
                       <button onClick={this.handleClick}>Show/Hide</button>
                    </div>
                    {details}
                </div>
            </div>
        )
    }
}

export default Author;