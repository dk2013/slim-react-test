import React from 'react';
import axios from 'axios';

class NoteCreate extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
          title: '',
          text: ''
        };
    
        this.handleTitleChange = this.handleTitleChange.bind(this);
        this.handleTextChange = this.handleTextChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }
    render () {
        return (
            <div>
                <form onSubmit={this.handleSubmit}>
                    <table className="table">
                        <thead>
                            <tr>
                                <th colSpan="2" className="center">Add note</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <label>
                                        Title:
                                    </label>
                                </td>
                                <td>
                                    <input type="text" value={this.state.title} onChange={this.handleTitleChange} />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        Text:
                                    </label>
                                </td>
                                <td>
                                    <textarea value={this.state.text} onChange={this.handleTextChange}></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <input className="btnSubmit" type="submit" value="Send" />
                </form>
            </div>
        );
    }

    handleSubmit(event) {
        event.preventDefault();

        axios.post('http://localhost:8080/notes', { 
            title: this.state.title,
            text: this.state.text
        })
            .then((response) => {
                this.setState({
                    title: '',
                    text: ''
                });
                alert('The new note added');
            }, (error) => {
                console.log(error);
                alert('Please fill in the form fields');
            });
    }

    handleTitleChange(event) {
        this.setState({title: event.target.value});
    }

    handleTextChange(event) {
        this.setState({text: event.target.value});
    }
    
}

export default NoteCreate;