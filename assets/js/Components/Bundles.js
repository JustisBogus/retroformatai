import React, { Component } from 'react';
import Bundle from './Bundle';
import { connect } from 'react-redux';
import { selectBundle, bundlesListFetch, itemsListFetch,
     saveNewBundle, updateBundle, deleteBundle } from '../store/actions/bundles';
import Spinner from './Spinner';

const mapStateToProps = state => ({
    ...state.bundles
});

const mapDispatchToProps = {
        selectBundle,
        bundlesListFetch,
        itemsListFetch,
        saveNewBundle,
        updateBundle,
        deleteBundle
}

class Bundles extends Component {

    componentDidMount() {
        this.props.bundlesListFetch();
    }

    handleSelectBundle(id) {
        const { itemsListFetch, selectBundle } = this.props;
        itemsListFetch(id);
        selectBundle(id);
        console.log(this.props.bundles);
    }
    
    handleNewBundle() {
        const { bundles, saveNewBundle } = this.props;
        let newBundle = {
            id: bundles.length + 1,
            name: 'Naujas komplektas',
            format: '',
            condition_rating: 5,
            cover: null,
            dateCreated: new Date(),
            dateModified: new Date(),
            items: [ ]
        }
        saveNewBundle(newBundle);
    }

    handleDeleteBundle(id) {
        this.props.deleteBundle(id);
    }

    /*
    handleBundleInput(id, field, value) {
        const { bundles, updateBundle } = this.props;
        let allBundles = bundles;
        let activeBundle = allBundles.find(bundle => bundle.id === id);
        if (field === "name") {
            activeBundle.name = value;
        }
        if (field === "format") {
            activeBundle.format = value;
        }
        updateBundle(allBundles);
    }
    */

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
                    deleteBundle={this.handleDeleteBundle.bind(this)}
                />
            })
        }

        if (!bundles && !isFetchingBundles) {
            bundleList = <div>Dar neturite sukurę komplektų spauskite "Naujas" sukurti</div>
        }

        return (
            <div className="bundleList-Container"> 
                <div className="row">
                    {bundleList} 
                </div>
                    <div className="bundleList-newBundleButton">
                        <div onClick={() => this.handleNewBundle()} className="btn-secondary btn waves-light btn blue">
                            Naujas
                        </div>
                    </div>     
            </div>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(Bundles);