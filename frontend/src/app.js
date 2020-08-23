import Vue from 'vue'
import App from './components/App.vue'
import router from './router';
import store from './store';
import {getToken} from './helper/token';

Vue.config.productionTip = false

const main = ()=>{
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