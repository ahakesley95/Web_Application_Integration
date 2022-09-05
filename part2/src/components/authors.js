import React from "react";
import Author from './author.js';

/**
 * A component for listing multiple instances of Author.
 * 
 * @author Alex Hakesley w16011419
 */

class Authors extends React.Component {

    constructor(props) {
        super(props)
        this.state = {
            results : []
        }
    }

    filterSearch = (s) => {        
        return (
            s.first_name.concat(" ", s.last_name).toLowerCase().includes(this.props.search.toLowerCase().trim())
        )
    }

    componentDidMount() {
        const url = "http://unn-w16011419.newnumyspace.co.uk/kf6012/coursework/part1/api/authors";
        fetch(url)
        .then( (response) => {
            if (response.status === 200) {
                return response.json();
            } else {
                throw Error(response.statusText);
            }
        })
        .then( (data) => {
            this.setState({results:data.results})
        })
        .catch( (error) => {
            console.log("Error: ", error)
        })
    }

    render() {
        let noData = ""
        let filteredResults = this.state.results
        let buttons = ""


        if ((filteredResults.length > 0) && (this.props.search !== undefined) && (this.props.search !== "")) {
            filteredResults = this.state.results.filter(this.filterSearch);
        }

        if (filteredResults.length === 0) {
            noData = <p>No results found</p>
        }

        if (this.props.page !== undefined) {
            const pageSize = 15
            let pageMax = this.props.page * pageSize
            let pageMin = pageMax - pageSize
            let pageNumber = Math.ceil(filteredResults.length / pageSize) > 0 ? Math.ceil(filteredResults.length / pageSize) : 1
            buttons = (
                <div className="page-navigation">
                    <button onClick={this.props.handlePreviousClick} disabled={this.props.page <= 1}>Previous</button>
                    <button onClick={this.props.handleNextClick} disabled={this.props.page >= Math.ceil(filteredResults.length / pageSize)}>Next</button>
                    <p>Page {this.props.page} of {pageNumber}</p>
                </div>
            )
            filteredResults = filteredResults.slice(pageMin, pageMax)
        }

        return (
            <div>
                {noData}
                {filteredResults.map( (author, i) => (<Author 
                                                        key={author.first_name + author.last_name} 
                                                        author={author}
                                                        token={this.props.token}
                                                    />))}
                {buttons}
            </div>
        )
    }
}

export default Authors;