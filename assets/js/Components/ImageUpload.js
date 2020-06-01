import React, { Component } from 'react';
import { connect } from "react-redux";
import { imageUpload } from "../store/actions/bundles";

const mapDispatchToProps = {
    imageUpload
};

class ImageUpload extends Component {
    onChange(e) {
        console.log(e.target);
        console.log(e.target.files[0]);
        const file = e.target.files[0];
        this.props.imageUpload(file);
    }

    render() {
        return (
            <div className="file-field input-field imageUpload">
                <div className="btn">
                    <span>Browse</span>
                    <input
                        onChange={(e) => this.onChange(e)}
                        type="file" 
                        multiple
                        />
                </div> 
                <div className="file-path-wrapper">
                    <input className="file-path validate" type="text"
                        placeholder="Upload multiple files" />
                </div>
            </div>
        );
    }
}

export default connect(null, mapDispatchToProps)(ImageUpload);