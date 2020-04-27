import React, { Component } from 'react';
import Bundle from './Bundle';
import { connect } from 'react-redux';
import { selectBundle, bundlesListFetch, itemsListFetch } from '../store/actions/bundles';
import Spinner from './Spinner';

const mapStateToProps = state => ({
    ...state.bundles
});

const mapDispatchToProps = {
        selectBundle,
        bundlesListFetch,
        itemsListFetch
}

class Bundles extends Component {

    componentDidMount() {
        this.props.bundlesListFetch();
    }

    handleSelectBundle(id) {
        const { itemsListFetch, selectBundle } = this.props;
        itemsListFetch(id);
        selectBundle(id);
        console.log(this.props.items);
    }
    
    render() {

        const { bundles, selectedBundle, isFetchingBundles } = this.props;
        let bundleList;

        if (isFetchingBundles) {
            bundleList = (
                <div className="spinnerContainer">
                    <Spinner/>
                </div>
            )
        }

        if (bundles && !isFetchingBundles) {
            bundleList = bundles.map(bundle => {
                return <Bundle
                    key={bundle.id}
                    bundle={bundle}
                    selectedBundle={selectedBundle}
                    selectBundle={this.handleSelectBundle.bind(this)}
                />
            })
        }

        return (
            <div className="bundleList-Container"> 
                <div className="row">
                    {bundleList} 
                </div>
                    <div className="bundleList-newBundleButton">
                        <div className="waves-effect waves-light btn blue">
                            Naujas
                        </div>  
                    </div>     
            </div>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(Bundles);