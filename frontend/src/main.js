
import Vue from 'vue' // vue import from library
import App from './components/App.vue' // master layout
import router from './router'; // all route of application
import store from './store'; // vuex store
import { getToken } from './helper/token'; // set token, get token here

// all css & js here
import './assets/css';
import './assets/js';

// events of application
import './events/eventbus';

//pagination component
import pagination from './components/pagination';
Vue.component('pagination',pagination);

// application enviroment
Vue.config.productionTip = false


// vue app initialization
const main = () => {

  new Vue({
    router,
    store,
    render: h => h(App),
  }).$mount('#app')
}

// vue token check when token exist & every time app initialize
const token = getToken();
if (token) {
  store.dispatch("auth/setAuth")
    .then(() => {
      main();
    })
} else {
  main();
}






