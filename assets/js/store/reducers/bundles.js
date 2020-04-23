import * as actionTypes from '../actions/actionTypes';
import { bundlesData } from './bundlesData';
import { newItemEmpty } from './newItemEmpty';

const initialState = {
    clicked: false,
    bundles: bundlesData,
    selectedBundle: bundlesData[bundlesData.length - 1].id,
    newItem: newItemEmpty,
    isFetching: false
}

const reducer = (state = initialState, action) => {
    switch (action.type) {
        case actionTypes.CLICK:
            return {
                ...state,
                    clicked: action.buttonClicked
            };
        case actionTypes.BUNDLES_LIST_REQUEST:
            return {
                ...state,
                    isFetching: true
            };
        case actionTypes.BUNDLES_LIST_RECEIVED:
            return {
                ...state,
                    bundles: action.data,
                    isFetching: false
            };
        case actionTypes.BUNDLES_LIST_ERROR:
            return {
                ...state,
                    isFetching: false,
                    bundles: bundlesData
            }
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