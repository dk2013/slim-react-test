import React from 'react';
import axios from 'axios';

class Notes extends React.Component {
    constructor() {
        super();
        this.state = {
            notes: []
        }
    }
    
    render () {
        return (
            <div>
                <table className="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Text</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                        </tr>
                    </thead>
                    <tbody>
                        {this.renderTableData()}
                    </tbody>
                </table>
            </div>
        );
    }

    renderTableData() {
        return this.state.notes.map((notes, index) => {
           const { id, title, text, created, updated } = notes //destructuring
           return (
                <tr key={id}>
                    <td>{title}</td>
                    <td>{text}</td>
                    <td>{created}</td>
                    <td>{updated}</td>
                </tr>
           )
        })
    }

    componentDidMount() {
        axios.get('http://localhost:8080/notes')
            .then(response => {
                this.setState({ notes: response.data })
            })
    }
    
}

export default Notes;