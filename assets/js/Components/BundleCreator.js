import React, { Component } from 'react';
import { connect } from 'react-redux';
import { click } from '../store/actions/bundles';
import Bundles from './Bundles';
import Item from './Item';
import Form from './Form';
import { createNewItem, addNewItem } from '../store/actions/bundles';

const mapStateToProps = state => ({
    ...state.bundles
});

const mapDispatchToProps = {
    click,
    createNewItem,
    addNewItem
}

class BundleCreator extends Component {

    handleOnClick() {
        let { clicked } = this.props;
        if (clicked) {
            clicked = false
        } else {
            clicked = true
        }
    }

    handleFormInput(field, value) {
        let { newItem, createNewItem } = this.props;
        let item = {
                id: 0,
                title: newItem.title,
                format: newItem.format,
                genre: newItem.genre,
                year: newItem.year,
                conditionRating: newItem.conditionRating,
                publisher: newItem.publisher,
                price: newItem.price,
                comment: newItem.comment
            }
        if (field === "title") {
            item.title = value
        }
        if (field === "format") {
            item.format = value
        }
        if (field === "genre") {
            item.genre = value
        }
        if (field === "year") {
            item.year = value
        }
        if (field === "conditionRating")
        {
            item.conditionRating = value
        }
        if (field === "publisher") {
            item.publisher = value
        }
        if (field === "price") {
            item.price = value
        }
        if (field === "comment") {
            item.comment = value
        }
        createNewItem(item);
    }
    
    handleItemAdd() {
        const { bundles, selectedBundle, newItem, addNewItem} = this.props;
        let activeBundle = bundles.find(bundle => bundle.id === selectedBundle);
        let item = newItem;
        item.id = activeBundle.items.length + 1;
        let emptyItem = {
            id: item.id,
            title: "",
            format: item.format,
            genre: "",
            year: "",
            conditionRating: "",
            publisher: "",
            price: item.price,
            comment: ""
        }
        activeBundle.items = activeBundle.items.concat(item);
        addNewItem(bundles, emptyItem);
        console.log(bundles);
    }
    
    render() {
 
        const { bundles, selectedBundle} = this.props;
        let activeBundle = bundles.find(bundle => bundle.id === selectedBundle);
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
                            <Form
                                handleFormInput={this.handleFormInput.bind(this)}
                                newItem={this.props.newItem}
                            />
                            <div className="bundleList-newBundleButton" onClick={this.handleItemAdd.bind(this)}>
                                <div className="btn-floating btn-large waves-effect waves-light blue">
                                    Pridėti žaidimą
                                </div>  
                            </div>     
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