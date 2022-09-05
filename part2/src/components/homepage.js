import React from "react";
import Papers from './papers.js';
import picture from '.././img/picture.jpg';

/**
 * Displays a page that includes a randomly selected paper
 * and an image.
 * 
 * @author Alex Hakesley w16011419
 */

class Homepage extends React.Component {
    render() {
        return (
            <div>
                <h2>Random paper</h2>
                <Papers 
                    randomPaper={true} 
                    token={this.props.token} 
                    isReadingList={false}
                />
                <img className="my-picture" src={picture} alt="books"/>
                <p className="picture-credit">Photo by <a href="https://unsplash.com/@hudsoncrafted?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Debby Hudson</a> on <a href="https://unsplash.com/s/photos/books?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a></p>
            </div>
        )
    }
}

export default Homepage;