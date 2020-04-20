import * as actionTypes from '../actions/actionTypes';
import { bundlesData } from './bundlesData';

const initialState = {
    clicked: false,
    bundles: bundlesData,
    selectedBundle: null
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
            }
        default:
            return state;
    };
}

export default reducer;