
import Vue from 'vue'
import App from './components/App.vue'
import router from './router';
import store from './store';
import { getToken } from './helper/token';

import './assets/css';
import './assets/js';

import './events/eventbus';


Vue.config.productionTip = false

Vue.component('pagination', require('laravel-vue-pagination'));

const main = () => {

  new Vue({
    router,
    store,
    render: h => h(App),
  }).$mount('#app')
}

const token = getToken();
if (token) {
  store.dispatch("auth/setAuth")
    .then(() => {
      main();
    })
} else {
  main();
}






