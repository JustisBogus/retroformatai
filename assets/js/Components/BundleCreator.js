import React, { Component } from 'react';
import { connect } from 'react-redux';
import { click, selectBundle } from '../store/actions/bundles';
import Bundles from './Bundles';
import Item from './Item';
import Form from './Form';

const mapStateToProps = state => ({
    ...state.bundles
});

const mapDispatchToProps = {
    click
}

class BundleCreator extends Component {

    handleOnClick() {
        let { clicked } = this.props;
        if (clicked) {
            clicked = false
        } else {
            clicked = true
        }
        this.props.click(clicked);
        console.log(clicked);
}
    
    render() {

        const { bundles, selectedBundle } = this.props;
        let activeBundle = bundles.find(bundle => bundle.id === selectedBundle );
        let activeBundleItemList;

        if (activeBundle && activeBundle.items) {
            activeBundleItemList = activeBundle.items.map(item => {
                return <Item
                    key={item.id}
                    item={item}
                />
            });
        }


        return (
            <div>
                <Bundles/>
                <div className="row">
                    <div className="col s6 ">
                        <div className="bundleCreator-form">
                            <Form/>
                        </div>   
                    </div>
                    <div className="col s6">
                        <div className="bundleCreator-itemList">
                            {activeBundleItemList}
                        </div>     
                    </div>
                </div>
            </div>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(BundleCreator);