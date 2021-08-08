import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import auth from "./auth";
import module from "./module";
import submodule from "./submodule";
import loading from "./loading";
import test from './test';

export default new Vuex.Store({
    modules: {
        auth,
        test,
        loading,
        module,
        submodule
    }
});