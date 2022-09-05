import React from "react";
import Papers from "./papers.js";
import SelectAward from "./selectaward.js";
import SearchBox from "./searchbox.js";

/**
 * Displays a page including the Papers component,
 * search, award filtering and pagination functionality.
 * 
 * @author Alex Hakesley w16011419
 * 
 */

class PapersPage extends React.Component {

    constructor(props) {
        super(props)
        this.state = {
            award : "",
            search: "",
            page: 1
        }
        this.handleAwardSelect = this.handleAwardSelect.bind(this);
        this.handleSearch = this.handleSearch.bind(this);
        this.handleNextClick = this.handleNextClick.bind(this);
        this.handlePreviousClick = this.handlePreviousClick.bind(this);
    }

    handleAwardSelect = (e) => {
        this.setState({award:e.target.value, page:1})
    }

    handleSearch = (e) => {
        this.setState({search:e.target.value, page:1})
    }

    handleNextClick = () => {
        this.setState({page:this.state.page+1})
    }

    handlePreviousClick = () => {
        this.setState({page:this.state.page-1})
    }

    render() {
        return (
            <div>
                <div className="search-controls">
                    <SearchBox search={this.state.search} handleSearch={this.handleSearch} />
                    <SelectAward award={this.state.award} handleAwardSelect={this.handleAwardSelect}/>
                    </div>
                <Papers 
                    award_id={this.state.award} 
                    search={this.state.search} 
                    page={this.state.page}
                    handleNextClick={this.handleNextClick}
                    handlePreviousClick={this.handlePreviousClick}
                    token={this.props.token}
                    isReadingList={false}
                />

            </div>
        )
    }
}

export default PapersPage;