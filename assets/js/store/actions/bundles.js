import { CLICK, SELECT_BUNDLE, CREATE_NEW_ITEM, ADD_NEW_ITEM } from "./actionTypes"
import { requests } from '../../agent';

export const click = (buttonClicked) => {
    return {
        type: CLICK,
        buttonClicked
    }
}

export const selectBundle = (id) => {
    return {
        type: SELECT_BUNDLE,
        id
    }
}

export const createNewItem = (item) => {
    return {
        type: CREATE_NEW_ITEM,
        item
    }
}

export const addNewItem = (bundles, emptyItem) => {
    return {
        type: ADD_NEW_ITEM,
        bundles,
        emptyItem
    }
}

