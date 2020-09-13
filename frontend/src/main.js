
import Vue from 'vue' // vue import from library
import IdleVue from 'idle-vue' // check user is active or not
import App from './components/App.vue' // master layout
import router from './router'; // all route of application
import store from './store'; // vuex store
import { getToken,removeToken } from './helper/token'; // set token, get token here
import jwt from 'jsonwebtoken';

import * as config from './config';

// all css & js here
import './assets/css';
import './assets/js';


Vue.use(IdleVue, { 
  ventEmitter: new Vue(), 
  store ,
  idleTime: 30000, // 30 seconds
  startAtIdle: false
})

// events of application
import './events/eventbus';

//pagination component
import pagination from './components/pagination';
import ErrorValidation from './components/include/ErrorValidation';
Vue.component('pagination',pagination);
Vue.component('ErrorValidation',ErrorValidation);

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
var token = getToken();

if (token) {
  jwt.verify(token, config.jwt_secret, (err, decoded) => {

    if (err) {
      removeToken();
      token = null;
    } else {
      if (decoded.iss !== config.API_BASE_URL+"login") {
        removeToken();
        token = null;
      }
    }
  });
}


if (token) {
  store.dispatch("auth/setAuth")
    .then(() => {
      main();
    })
} else {
  main();
}






