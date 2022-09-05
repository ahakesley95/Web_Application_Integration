import React from "react";

/**
 * Buttons used to add or remove the parent Paper component
 * from the user's reading list.
 * 
 * @author Alex Hakesley w16011419
 */

class PaperControls extends React.Component {
    render() {
        let addRemove = <button onClick={this.props.handleRemoveClick}>Remove</button>;

        if (!this.props.isReadingList) {
            if (this.props.added !== true) {
                addRemove = (
                    <button onClick={this.props.handleAddClick}>Add</button>
                )
            }
        }

        return addRemove;
    }
}

export default PaperControls;