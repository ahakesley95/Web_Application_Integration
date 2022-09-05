import React from "react";

/**
 * Component for searching for the terms in the input field.
 * 
 * @author Alex Hakesley w16011419
 * 
 */

class SearchBox extends React.Component {

    render() {
        return (
            <label>
                Search:
                <input type='text' placeholder='Search...' value={this.props.search} onChange={this.props.handleSearch} />
            </label>
        )
    }
}

export default SearchBox;