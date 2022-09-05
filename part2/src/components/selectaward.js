import React from "react";

/**
 * Component for filtering Paper results by the selected award.
 * 
 * @author Alex Hakesley w16011419
 * 
 */

class SelectAward extends React.Component {

    render() {
        return (
            <label>
                By award:
                <select value={this.props.award} onChange={this.props.handleAwardSelect}>
                    <option value="">Any</option>
                    <option value="1">Best paper</option>
                    <option value="2">Best paper honourable mention</option>
                    <option value="3">Best pictorial</option>
                    <option value="4">Best pictoral honorable mention</option>
                    <option value="5">Special recognition for diversity and inclusion</option>
                </select>
                </label>
        )
    }
}

export default SelectAward;