import React, { Component } from 'react';
import Bundle from './Bundle';
import { connect } from 'react-redux';
import { selectBundle } from '../store/actions/bundles';

const mapStateToProps = state => ({
    ...state.bundles
});

const mapDispatchToProps = {
    selectBundle
}

class Bundles extends Component {

    onSelectBundle(id) {
        this.props.selectBundle(id);
    }
    
    render() {

        const { bundles, selectedBundle } = this.props;
        let bundleList;

        if (bundles) {
            bundleList = bundles.map(bundle => {
                return <Bundle
                    key={bundle.id}
                    bundle={bundle}
                    selectedBundle={selectedBundle}
                    selectBundle={this.onSelectBundle.bind(this)}
                />
            })
        }

        return (
            <div className="bundleList-Container"> 
                <div className="row">
                    {bundleList} 
                </div>
                    <div className="bundleList-newBundleButton">
                        <div className="btn-floating btn-large waves-effect waves-light blue">
                            +
                        </div>  
                    </div>     
            </div>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(Bundles);