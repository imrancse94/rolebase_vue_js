import Vue from 'vue'
import IdleVue from "idle-vue";
import App from './App.vue'
import router from './router'
import store from './store'
import { getToken } from './Helper'
import VueSweetalert2 from 'vue-sweetalert2';

global.jQuery = require('jquery');
const $ = require('jquery');
window.$ = $;


// CSS
import './assets/fontawesome-free/css/all.min.css'
import './assets/css/adminlte.min.css';
import './assets/toastr/toastr.min.css';
import './assets/js/overlayScrollbars/css/OverlayScrollbars.css';
import './assets/css/custom.css';

// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';

// JS
import './assets/js/overlayScrollbars/js/jquery.overlayScrollbars';
import './assets/js/adminlte';
import './assets/js/demo';
import './assets/toastr/toastr.min';
import './assets/js/pages/dashboard';
import './assets/js/custom';

import './Events/eventbus';

import pagination from './components/pagination';
import ActionButton from './components/Include/Buttons/ActionButton';
import ErrorValidation from './components/Include/ErrorValidation';
import Button from './components/Include/Buttons/Button';
import SubmitButton from './components/Include/Buttons/SubmitButton';
import LinkButton from './components/Include/Buttons/LinkButton';
import IconButton from './components/Include/Buttons/IconButton';
import ContentPageHeader from './components/Include/ContentPageHeader';

Vue.component('pagination', pagination);
Vue.component('ErrorValidation', ErrorValidation);
Vue.component('ActionButton', ActionButton);
Vue.component('Button', Button);
Vue.component('SubmitButton', SubmitButton);
Vue.component('LinkButton', LinkButton);
Vue.component('IconButton', IconButton);
Vue.component('ContentPageHeader', ContentPageHeader);

import GLOBAL_CONSTANT from './constant';

// import plugin
import VueToastr from "vue-toastr";

// sweetallert2 plugin
Vue.use(VueSweetalert2);
// use plugin
Vue.use(VueToastr, {
    defaultTimeout: 2000,
    defaultProgressBar: false
});

Vue.component("vue-toastr", VueToastr);

Vue.config.productionTip = false

var token = getToken();
const eventsHub = new Vue();
const inactiveTime = 100 // min
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