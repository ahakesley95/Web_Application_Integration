import React from "react";
import Authors from "./authors.js";
import SearchBox from "./searchbox.js";

/**
 * Displays a page including the Authors component,
 * search and pagination functionality.
 * 
 * @author Alex Hakesley w16011419
 * 
 */

class AuthorsPage extends React.Component {

    constructor(props) {
        super(props)
        this.state = {
            search : "",
            page : 1
        }
        this.handleSearch = this.handleSearch.bind(this)
        this.handlePreviousClick = this.handlePreviousClick.bind(this)
        this.handleNextClick = this.handleNextClick.bind(this)
    }

    handleSearch = (e) => {
        this.setState({search:e.target.value})
    }

    handlePreviousClick = () => {
        this.setState({page:this.state.page-1})
    }

    handleNextClick = () => {
        this.setState({page:this.state.page+1})
    }

    render() {
        return (
            <div>
                <div className="search-controls">
                <SearchBox search={this.state.search} handleSearch={this.handleSearch}/>
                </div>
                <Authors 
                    search={this.state.search}
                    page={this.state.page}
                    handlePreviousClick={this.handlePreviousClick}
                    handleNextClick={this.handleNextClick}
                    token={this.props.token}
                />
            </div>
        )
    }
}

export default AuthorsPage;