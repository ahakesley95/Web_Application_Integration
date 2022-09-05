import React from "react";
import PaperControls from './papercontrols.js';

/**
 * A component for displaying details about a paper.
 * 
 * @author Alex Hakesley w16011419
 */

class Paper extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            display: false,
            added: false,
        }
        this.handleRemoveClick = this.handleRemoveClick.bind(this)
        this.handleAddClick = this.handleAddClick.bind(this)
    }

    handleRemoveClick = () => {
        // sends POST request to API to remove this paper.id from reading list
        let url = "http://unn-w16011419.newnumyspace.co.uk/kf6012/coursework/part1/api/readinglist";
        let formData = new FormData();

        formData.append('token', this.props.token);
        formData.append('remove', this.props.paper.id);

        fetch(url, {
            method: 'POST', 
            headers: new Headers(),
            body: formData
        })
        .then((response) => {
            if (response.status === 200 || response.status === 204) {
                this.setState({added:false})
                if (this.props.isReadingList) {
                    this.props.updateReadingList();
                }
            } else {
                throw Error(response.statusText);
            }
        })
        .catch((err) => {
            console.log("Error: ", err);
        })

    }

    handleAddClick = () => {
        // sends POST to request to API to add this paper.id to reading list
        let url = "http://unn-w16011419.newnumyspace.co.uk/kf6012/coursework/part1/api/readinglist";
        let formData = new FormData();

        formData.append('token', this.props.token);
        formData.append('add', this.props.paper.id);

        fetch(url, {
            method: 'POST', 
            headers: new Headers(),
            body: formData
        })
        .then((response) => {
            if (response.status === 200 || response.status === 204) {
                this.setState({added:true})
            } else {
                throw Error(response.statusText);
            }
        })
        .catch((err) => {
            console.log("Error: ", err);
        })
    }

    handleClick = () => {
        this.setState({display: !this.state.display})
    }

    componentDidMount() {
        let filteredList = this.props.readingList.filter(paper => paper.paper_id === this.props.paper.id);
        if (filteredList.length > 0) {
            this.setState({added:true});
        }
    }

    render() {
        let details = "";
        let paperControls = "";
        let myClassName = this.state.added ? "paper-container-added" : "paper-container"

        // don't highlight if looking at papers from the reading list page
        if (this.props.isReadingList) {
            myClassName = "paper-container"
        }

        if (this.state.display === true) {
            details = <div className="paper-details">
                <h4>Abstract</h4>
                <p>{this.props.paper.abstract}</p>
                <h4>Author(s)</h4>
                <p>{this.props.paper.authors}</p>
                <a href={this.props.paper.doi}>See full article...</a>
            </div>
        }

        // if logged in, show add/remove buttons
        if (this.props.token) {
            paperControls = <PaperControls
                isReadingList={this.props.isReadingList}
                added={this.state.added}
                handleRemoveClick={this.handleRemoveClick}
                handleAddClick={this.handleAddClick}
            />
        }

        return (
            <div className={myClassName}>
                <div className="paper-data">
                    <div className="paper-heading">
                        <div className="paper-title">
                            <h3>{this.props.paper.title}</h3>
                        </div>
                        <div className="paper-controls">
                            <button onClick={this.handleClick}>Show/Hide</button>
                            {paperControls}
                        </div>
                    </div>
                    {details}
                </div>
            </div>
        )
    }
}

export default Paper;