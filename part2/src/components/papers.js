import React from "react";
import Paper from './paper.js';

/**
 * A component for displaying multiple instances of the Paper component.
 * 
 * @author Alex Hakesley w16011419
 */

class Papers extends React.Component {

    constructor(props) {
        super(props);
        this.state = { 
            results : [],
            readingList: []
        }
        this.fetchReadingList = this.fetchReadingList.bind(this);
    }

    filterSearch = (s) => {
        return (
            s.title.toLowerCase().includes(this.props.search.toLowerCase()) || 
            s.abstract.toLowerCase().includes(this.props.search.toLowerCase())
        )
    }

    fetchReadingList = () => {
        let url = "http://unn-w16011419.newnumyspace.co.uk/kf6012/coursework/part1/api/readinglist";
        let formData = new FormData();
        formData.append('token', this.props.token);

        fetch(url, {
            method: 'POST',
            headers: new Headers(),
            body: formData
        })
        .then( (response) => {
            if (response.status === 200) {
                return response.json();
            } else if (response.status === 204) {
                return response.text();
            } else {
                throw Error(response.statusText);
            }
        })
        .then((data) => {
            if (data.count !== undefined) {
                this.setState({readingList:data.results})
            } else {
                this.setState({readingList:[]})
            }
        })
        .catch((err) => {
            console.log("Error: ", err);
        })
    }

    componentDidMount() {
        let url = "http://unn-w16011419.newnumyspace.co.uk/kf6012/coursework/part1/api/readinglist";
        let formData = new FormData();
        formData.append('token', this.props.token);

        fetch(url, {
            method: 'POST',
            headers: new Headers(),
            body: formData
        })
        .then( (response) => {
            if (response.status === 200) {
                return response.json();
            } else if (response.status === 204) {
                return response.text();
            } else {
                throw Error(response.statusText);
            }
        })
        .then((data) => {
            if (data.count !== undefined) {
                this.setState({readingList:data.results})
            } else {
                this.setState({readingList:[]})
            }
        })
        .catch((err) => {
            console.log("Error: ", err);
        })

        url = "http://unn-w16011419.newnumyspace.co.uk/kf6012/coursework/part1/api/papers";
        if (this.props.randomPaper === true) {
            url += "?random";
        } else if (this.props.author_id !== undefined) {
            url += "?author_id=" + this.props.author_id;
        }
        fetch(url)
        .then((response) => {
            if (response.status === 200) {
                return response.json();
            } else {
                throw Error(response.statusText);
            }
        })
        .then( (data) => {
            this.setState({results:data.results});
        })
        .catch((err) => {
            console.log("Error: ", err);
        });
    }

    handleRemoveAllClick = () => {
        let url = "http://unn-w16011419.newnumyspace.co.uk/kf6012/coursework/part1/api/readinglist";
        let formData = new FormData();

        formData.append('token', this.props.token);
        formData.append('removeAll', 'dummy');

        fetch(url, {
            method: 'POST',
            headers: new Headers(),
            body: formData
        })
        .then((response) => {
            if (response.status === 200 || response.status === 204) {
                this.setState({readingList:[]})
            } else {
                throw Error(response.statusText);
            }
        })
        .catch((err) => {
            console.log("Error: ", err);
        })
    }

    componentDidUpdate(prevProps) {
        let url = "http://unn-w16011419.newnumyspace.co.uk/kf6012/coursework/part1/api/papers"
        url = this.props.award_id !== "" ? url + "?award_id=" + this.props.award_id : url;

        if (prevProps.award_id !== this.props.award_id) {
            fetch(url)
            .then( (response) => {
                if (response.status === 200) {
                    return response.json()
                } else {
                    throw Error(response.statusText);
                }
            })
            .then( (data) => {
                this.setState({results:data.results})
            })
            .catch( (err) => {
                console.log("Error: ", err)
            });
        } 
    }

    render() {
        let noData = ""
        let filteredResults = this.state.results
        let buttons = ""
        let removeAllButton = ""

        // filter results for papers found in reading list
        if (this.props.isReadingList === true) {
            filteredResults = this.state.results.filter(paper => this.state.readingList.some(({paper_id}) => paper.id === paper_id));
        } 

        if ((filteredResults.length > 0) && (this.props.search !== undefined)) {
            filteredResults = filteredResults.filter(this.filterSearch);
        }

        // implement pagination
        if (this.props.page !== undefined) {
            const pageSize = 10
            let pageMax = this.props.page * pageSize
            let pageMin = pageMax - pageSize
            let pageNumber = Math.ceil(filteredResults.length / pageSize) > 0 ? Math.ceil(filteredResults.length / pageSize) : 1
            if (filteredResults.length > pageSize) {
                buttons = (
                    <div className="page-navigation">
                        <button onClick={this.props.handlePreviousClick} disabled={this.props.page <= 1}>Previous</button>
                        <button onClick={this.props.handleNextClick} disabled={this.props.page >= Math.ceil(filteredResults.length / pageSize)}>Next</button>
                        <p>Page {this.props.page} of {pageNumber}</p>
                    </div>
                )
            }
            filteredResults = filteredResults.slice(pageMin, pageMax)
        }

        // handle no data found for reading list and papers pages.
        if (filteredResults.length === 0) {
            if (this.props.isReadingList) {
                noData = <p className="no-data">There are no papers in your reading list.</p>
            } else {
                noData = <p className="no-data">No results found.</p>
            }
        } else {
            if (this.props.isReadingList) {
                removeAllButton = (
                    <button className="remove-all" onClick={this.handleRemoveAllClick}>Remove all from reading list</button>
                )
            }
            
        }

        return (
            <div className="papers-content">
                {removeAllButton}
                {noData}
                {filteredResults.map( (paper) => (
                    <Paper 
                        key={paper.id} 
                        paper={paper} 
                        token={this.props.token}
                        handleRemoveClick={this.handleRemoveClick}
                        handleAddClick={this.handleAddClick}
                        readingList={this.state.readingList}
                        isReadingList={this.props.isReadingList}
                        updateReadingList={this.fetchReadingList}
                    />
                ))}
                {buttons}
            </div>
        )
    }
}

export default Papers;