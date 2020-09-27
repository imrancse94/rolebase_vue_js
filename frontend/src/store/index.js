import Vue from 'vue';
import Vuex from "vuex";

Vue.use(Vuex);

import auth from "./modules/auth";
import module from "./modules/module";
import submodule from "./modules/submodule";

export default new Vuex.Store({
    modules: {
        auth,
        module,
        submodule
    }
});