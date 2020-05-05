import React, { Component } from 'react';
import { connect } from 'react-redux';
import Bundles from './Bundles';
import Item from './Item';
import Form from './Form';
import {click, createNewItem, saveNewItem, listBundle } from '../store/actions/bundles';
import Spinner from './Spinner';

const mapStateToProps = state => ({
    ...state.bundles
});

const mapDispatchToProps = {
    click,
    createNewItem,
    saveNewItem,
    listBundle
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
        let { newItem, createNewItem, selectedBundle } = this.props;
        let item = {
                id: 0,
                title: newItem.title,
                format: newItem.format,
                genre: newItem.genre,
                year: newItem.year,
                conditionRating: newItem.conditionRating,
                publisher: newItem.publisher,
                price: newItem.price,
                comment: newItem.comment,
                selectedBundle: selectedBundle
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
        const { newItem, items, selectedBundle, saveNewItem } = this.props;
        let item = newItem;
        let addItems;
        if (items) {
            addItems = items;
            item.id = items.length + 1;
        }
        if (!items) {
            addItems = [];
            item.id = 1;
        }
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
        addItems = addItems.concat(item);
        saveNewItem(item, addItems, emptyItem, selectedBundle);
    }

    handleListBundle() {
        const { selectedBundle, listBundle } = this.props;
        listBundle(selectedBundle);
    }
    
    render() {
 
        const { isFetchingItems, items } = this.props;
        let activeBundleItemList;
    
        if (isFetchingItems) {
            activeBundleItemList = (
                <div className="spinnerContainer">
                    <Spinner/>
                </div>   
            )
        }

        if (items && !isFetchingItems) {
            activeBundleItemList = items.map(item => {
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
                            <div onClick={this.handleListBundle.bind(this)}>
                                Paskelbti komplektą
                            </div>
                            {activeBundleItemList}
                        </div>     
                    </div>
                </div>
            </div>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(BundleCreator);