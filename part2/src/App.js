
import './App.css';
import {BrowserRouter, Routes, Route} from 'react-router-dom';
import Nav from './components/nav.js';
import Footer from './components/footer.js';
import NotFound from './components/notfound.js';
import Homepage from './components/homepage.js';
import PapersPage from './components/paperspage.js';
import AuthorsPage from './components/authorspage.js';
import ReadingListPage from './components/readinglistpage.js';
import LoginPage from './components/loginpage.js';
import React from 'react';
import {decodeToken} from 'react-jwt';

class App extends React.Component {
  
  constructor(props) {
    super(props)
    this.state = {
        email: "",
        password: "",
        authenticated: false,
        token: null
    }
    this.handleLoginClick = this.handleLoginClick.bind(this)
    this.handleLogoutClick = this.handleLogoutClick.bind(this)
    this.handleEmail = this.handleEmail.bind(this)
    this.handlePassword = this.handlePassword.bind(this)
  }

  handleLogoutClick = () => {
    this.setState({authenticated: false, token:null})
    localStorage.removeItem('myReadingListToken');
}

  handleLoginClick = () => {
      let url = "http://unn-w16011419.newnumyspace.co.uk/kf6012/coursework/part1/api/authenticate"
      let formData = new FormData();
      formData.append('email', this.state.email);
      formData.append('password', this.state.password);

      fetch(url, {
          method: 'POST',
          headers: new Headers(),
          body:formData
      })
      .then( (response) => {
          if (response.status === 200) {
              return response.json()
          } else {
              throw Error(response.statusText)
          }
      })
      .then( (data) => {
          if ("token" in data.results) {
              this.setState({ 
                  authenticated : true,
                  token: data.results.token
              })
              localStorage.setItem('myReadingListToken', data.results.token);
          }
      })
      .catch( (err) => {
          console.log("Error: ", err)
      })
  }

  handleEmail = (e) => {
      this.setState({ email: e.target.value})
  }

  handlePassword = (e) => {
      this.setState({ password: e.target.value})
  }

  componentDidMount() {
    if (localStorage.getItem('myReadingListToken')) {
      let token = decodeToken(localStorage.getItem('myReadingListToken'));
      if (token.exp < Date.now() / 1000) {
        localStorage.removeItem('myReadingListToken');
        this.setState({authenticated: false, token: null});
      } else {
        this.setState({
          authenticated: true,
          token: localStorage.getItem('myReadingListToken')
        })
      }
    }
  }

  render() {
//todo look at bringing nav back into this part
    return (
      <div className='flex-container'>
        <BrowserRouter basename={"/kf6012/coursework/part2"}>
            <Nav 
              authenticated={this.state.authenticated} 
              handleLogoutClick={this.handleLogoutClick}
            />
              <div className="App">
                <Routes>
                  <Route path="/" element={<Homepage token={this.state.token}/>} />
                  <Route path="/papers" element={<PapersPage token={this.state.token}/>} />
                  <Route path="/authors" element={<AuthorsPage token={this.state.token}/>} />
                  <Route path="/readinglist" element={<ReadingListPage 
                                                        token={this.state.token} />}/>
                  <Route path="/login" element={<LoginPage 
                                                  handleEmail={this.handleEmail}
                                                  handlePassword={this.handlePassword}
                                                  handleLoginClick={this.handleLoginClick}
                                                  authenticated={this.state.authenticated}
                                                />} />
                  <Route path="*" element={<NotFound />} />
                </Routes>
              </div>
              <Footer />
        </BrowserRouter>
      </div>
        
    );
  }
}

export default App;
