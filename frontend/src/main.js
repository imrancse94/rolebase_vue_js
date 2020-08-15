import Vue from 'vue'
import App from './App.vue'
import router from './router';
import { Form, HasError, AlertError } from 'vform';
import store from './store';
import Axios from 'axios';

import 'ionicons'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'admin-lte/dist/css/adminlte.min.css'
import 'font-awesome/css/font-awesome.min.css'
import '@fortawesome/fontawesome-free/css/all.min.css'

import 'expose-loader?$!expose-loader?jQuery!jquery'
import 'bootstrap'
import 'jquery-slimscroll'
import 'jquery-ui/ui/widgets/sortable.js'
import 'jquery-ui/ui/widgets/datepicker.js'
import 'jquery-ui/themes/base/datepicker.css'
import 'admin-lte'
import 'chart.js'

import '@/assets/fonts/font.css';
import '@/assets/css/custom.css';

Vue.prototype.$http = Axios;

const token = localStorage.getItem('token')
if (token) {
  Vue.prototype.$http.defaults.headers.common['Authorization'] = token
}

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.config.productionTip = false
var eventBus  = new Vue();
Vue.prototype.$eventBus = eventBus;
Vue.prototype.$form = Form;

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app')
