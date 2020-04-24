import * as actionTypes from '../actions/actionTypes';
import { bundlesData } from './bundlesData';
import { newItemEmpty } from './newItemEmpty';

const initialState = {
    clicked: false,
    bundles: bundlesData,
    items: null,
    selectedBundle: bundlesData[bundlesData.length - 1].id,
    newItem: newItemEmpty,
    isFetchingBundles: false,
    isFerchingItems: false
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
                    isFetchingBundles: true
            };
        case actionTypes.BUNDLES_LIST_RECEIVED:
            return {
                ...state,
                    bundles: action.data,
                    isFetchingBundles: false
            };
        case actionTypes.BUNDLES_LIST_ERROR:
            return {
                ...state,
                    isFetchingBundles: false,
                    bundles: bundlesData
            }
        case actionTypes.ITEMS_LIST_REQUEST:
            return {
                ...state,
                    isFerchingItems:true
            };
        case actionTypes.ITEMS_LIST_RECEIVED:
            return {
                ...state,
                    items: action.data,
                    isFerchingItems: false,
            }
        case actionTypes.ITEMS_LIST_ERROR:
            return {
                ...state,
                    isFerchingItems: false,
                    items: null
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
                    items: action.items,
                    newItem: action.emptyItem
            };
        default:
            return state;
    };
}

export default reducer;