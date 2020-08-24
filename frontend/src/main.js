
import Vue from 'vue'
import App from './components/App.vue'
import router from './router';
import store from './store';
import {getToken} from './helper/token';

import './assets/css';
import './assets/js';

import './events/eventbus';

//import Helper from './helper/moment';

Vue.config.productionTip = false





const main = ()=>{
  //Vue.filter('setDateFormat',Helper.setDateFormat)
    new Vue({
      router,
      store,
      render: h => h(App),
    }).$mount('#app')
}

const token = getToken();
if (token) {
  store.dispatch("auth/setAuth")
  .then(()=>{
    main();
  })
}else{
  main();
}






