import { createStore, combineReducers, applyMiddleware } from 'redux';
import thunk from 'redux-thunk';
import bundlesReducer from './reducers/bundles';

const rootReducer = combineReducers({
    bundles: bundlesReducer,
});

const configureStore = () => {
    return createStore(rootReducer, applyMiddleware(thunk));
};

export default configureStore;