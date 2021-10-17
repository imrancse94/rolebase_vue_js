import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import auth from "./auth";
import module from "./module";
import submodule from "./submodule";
import RolePage from "./RolePage";
import Page from "./page";
import loading from "./loading";
import test from './test';
import Role from "./Role";
import User from "./user";

export default new Vuex.Store({
    modules: {
        auth,
        test,
        loading,
        module,
        submodule,
        Page,
        RolePage,
        Role,
        User
    }
});