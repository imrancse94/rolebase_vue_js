import Vue from 'vue'
import IdleVue from "idle-vue";
import App from './App.vue'
import router from './router'
import store from './store'
import { getToken } from './Helper'

global.jQuery = require('jquery');
const $ = require('jquery');
window.$ = $;


// CSS
import './assets/fontawesome-free/css/all.min.css'
import './assets/css/adminlte.min.css';
import './assets/toastr/toastr.min.css';
import './assets/js/overlayScrollbars/css/OverlayScrollbars.css';
import './assets/css/custom.css';

// JS
import './assets/js/overlayScrollbars/js/jquery.overlayScrollbars';
import './assets/js/adminlte';
import './assets/js/demo';
import './assets/toastr/toastr.min';
import './assets/js/pages/dashboard';
import './assets/js/custom';

import './Events/eventbus';

import pagination from './components/pagination';
import ErrorValidation from './components/Include/ErrorValidation';

Vue.component('pagination', pagination);
Vue.component('ErrorValidation', ErrorValidation);

import GLOBAL_CONSTANT from './constant';

// import plugin
import VueToastr from "vue-toastr";
// use plugin
Vue.use(VueToastr, {
    defaultTimeout: 2000,
    defaultProgressBar: false
});

Vue.component("vue-toastr", VueToastr);

Vue.config.productionTip = false

var token = getToken();
const eventsHub = new Vue();
const inactiveTime = 10 // min
Vue.use(IdleVue, {
    eventEmitter: eventsHub,
    store,
    idleTime: 60000 * inactiveTime,
    startAtIdle: false
});
const main = () => {
    var mixin = {
            data: function() {
                return { GLOBAL_CONSTANT }
            }
        }
        // vue app initialization
    new Vue({
        mixins: [mixin],
        store,
        router,
        render: h => h(App)
    }).$mount('#app')
}


if (token) {
    store.dispatch("auth/authUser")
        .then((response) => {
            main();
        })
} else {
    main();
}