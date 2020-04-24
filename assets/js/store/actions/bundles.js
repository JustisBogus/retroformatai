import { CLICK, SELECT_BUNDLE, CREATE_NEW_ITEM, ADD_NEW_ITEM, 
    BUNDLES_LIST_RECEIVED, BUNDLES_LIST_ERROR, 
    BUNDLES_LIST_REQUEST, ITEMS_LIST_RECEIVED, 
    ITEMS_LIST_ERROR, ITEMS_LIST_REQUEST } from "./actionTypes"
import { requests } from '../../agent';

export const click = (buttonClicked) => {
    return {
        type: CLICK,
        buttonClicked
    }
}

export const bundlesListRequest = () => ({
        type: BUNDLES_LIST_REQUEST
});

export const bundlesListError = (error) => ({
        type: BUNDLES_LIST_ERROR,
        error
});

export const bundlesListReceived = (data) => ({
        type: BUNDLES_LIST_RECEIVED,
        data
});

export const bundlesListFetch = () => {
    return (dispatch) => {
        dispatch(bundlesListRequest());
        return requests.get(`/api/bundles`)
            .then(response => dispatch(bundlesListReceived(response)))
            .catch(error => dispatch(bundlesListError(error)));
    };
};

export const itemsListRequest = () => ({
    type: ITEMS_LIST_REQUEST
});

export const itemsListError = (error) => ({
    type: ITEMS_LIST_ERROR,
    error
});

export const itemsListReceived = (data) => ({
    type: ITEMS_LIST_RECEIVED,
    data
});

export const itemsListFetch = (id) => {
    return (dispatch) => {
        dispatch(itemsListRequest());
        return requests.get(`/api/items/${id}`)
            .then(response => dispatch(itemsListReceived(response)))
            .catch(error => dispatch(itemsListError(error)));
    };
};

export const selectBundle = (id) => {
    return {
        type: SELECT_BUNDLE,
        id
    };
};

export const createNewItem = (item) => {
    return {
        type: CREATE_NEW_ITEM,
        item
    };
};

export const addNewItem = (items, emptyItem) => {
    return {
        type: ADD_NEW_ITEM,
        items,
        emptyItem
    };
};

