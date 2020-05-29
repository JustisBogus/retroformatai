import { CLICK, SELECT_BUNDLE, CREATE_NEW_ITEM, ADD_NEW_ITEM,
    BUNDLES_LIST_RECEIVED, BUNDLES_LIST_ERROR, 
    BUNDLES_LIST_REQUEST, ITEMS_LIST_RECEIVED, 
    ITEMS_LIST_ERROR, ITEMS_LIST_REQUEST, SET_ACTIVE_BUNDLE, 
    ADD_NEW_BUNDLE, UPDATE_BUNDLE } from "./actionTypes"
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

export const setActiveBundle = (bundles) => {
    return {
        type: SET_ACTIVE_BUNDLE,
        activeBundle: bundles.find(bundle => {
            return (Math.max(new Date(bundle.dateModified)));
        })
    };
};

export const bundlesListFetch = () => {
    return (dispatch) => {
        dispatch(bundlesListRequest());
        return requests.get(`/api/bundles`)
            .then(response => dispatch(bundlesListReceived(response)))
            .catch(error => dispatch(bundlesListError(error)))
            .then(response => dispatch(setActiveBundle(response.data)));
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
        item,
    };
};

export const addNewItem = (items, emptyItem) => {
    return {
        type: ADD_NEW_ITEM,
        items,
        emptyItem
    }
}

export const saveNewItem = (item, items, emptyItem, selectedBundle) => {
    return (dispatch) => {
       return requests.post(`/api/additem`, {
                id: item.id,
                title: item.title,
                format: item.format,
                genre1: item.genre,
                releaseDate: parseInt(item.year),
                conditionRating: parseInt(item.conditionRating),
                publisher: item.publisher,
                price: parseInt(item.price),
                comment: item.comment,
                dateCreated: new Date(),
                dateModified: new Date(),  
                selectedBundle: selectedBundle
       })
       .then(dispatch(addNewItem(items, emptyItem)))
       .catch(error => {
           console.log(error)
       });
    };
};

export const deleteItem = (id) => {
    return () => {
        return requests.del(`/api/deleteitem/${id}`);
    }
}

export const listBundle = (selectedBundle) => {
    return (dispatch) => {
        return requests.put(`/api/listbundle/${selectedBundle}`, {
            listed: true,
            dateModified: new Date()
        })
    };
};

export const addNewBundle = (newBundle) => {
    return {
        type: ADD_NEW_BUNDLE,
        newBundle
    };
};

export const updateBundle = (updatedBundle) => {
    return {
        type: UPDATE_BUNDLE,
        updatedBundle
    };
};

export const saveNewBundle = (newBundle) => {
    return (dispatch) => {
        return requests.post(`/api/addbundle`, {
            id: newBundle.id,
            name: "Tuščias komplektas",
            format: "Formatas",
            conditionRating: 5,
            dateCreated: new Date(),
            dateModified: new Date(),
            listed: false
        })
        .then(dispatch(addNewBundle(newBundle)))
        .catch(error => {
            console.log(error)
        })
    };
};

export const deleteBundle = (id) => {
    return () => {
        return requests.del(`/api/deletebundle/${id}`);
    }
}

