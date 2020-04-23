import * as actionTypes from '../actions/actionTypes';
import { bundlesData } from './bundlesData';
import { newItemEmpty } from './newItemEmpty';

const initialState = {
    clicked: false,
    bundles: bundlesData,
    selectedBundle: null,
    newItem: newItemEmpty,
    updated: false,
}

const reducer = (state = initialState, action) => {
    switch (action.type) {
        case actionTypes.CLICK:
            return {
                ...state,
                    clicked: action.buttonClicked
            };
        case actionTypes.SELECT_BUNDLE:
            return {
                ...state,
                    selectedBundle: action.id
            };
        case actionTypes.CREATE_NEW_ITEM:
            return {
                ...state,
                    newItem: action.item
            };
        case actionTypes.ADD_NEW_ITEM:
            return {
                ...state,
                    bundles: action.bundles,
                    newItem: action.emptyItem
            };
        default:
            return state;
    };
}

export default reducer;