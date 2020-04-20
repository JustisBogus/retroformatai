import { CLICK, SELECT_BUNDLE } from "./actionTypes"
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

