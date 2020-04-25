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
                            <th>Actions</th>
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
                    <td><button className="btnDelete" onClick={() => this.onDelete(id, index)}>Delete</button></td>
                </tr>
           )
        })
    }

    componentDidMount() {
        // Get all my notes
        axios.get('http://localhost:8080/notes')
            .then(response => {
                this.setState({ notes: response.data })
            })
    }

    onDelete (id, index) {
        const thisObj = this;
        axios.delete('http://localhost:8080/notes/' + id)
        .then(function (response) {
            let notes = thisObj.state.notes;
            notes.splice(index, 1);
            console.log(notes);
            thisObj.setState({notes});
            thisObj.renderTableData();
            alert('Note: ' + id + ' deleted');
        })
    }
    
}

export default Notes;