import Vue from 'vue'
import App from './components/App.vue'
import router from './router';
import store from './store';
import {getToken} from './helper/token';

Vue.config.productionTip = false

let handleOutsideClick
Vue.directive('closable', {
  bind (el, binding, vnode) {
    handleOutsideClick = (e) => {
      e.stopPropagation()
      const { handler, exclude } = binding.value
      let clickedOnExcludedEl = false
      exclude.forEach(refName => {
        if (!clickedOnExcludedEl) {
          const excludedEl = vnode.context.$refs[refName]
          clickedOnExcludedEl = excludedEl.contains(e.target)
        }
      })
      if (!el.contains(e.target) && !clickedOnExcludedEl) {
        vnode.context[handler]()
      }
    }
    document.addEventListener('click', handleOutsideClick)
    document.addEventListener('touchstart', handleOutsideClick)
  },

  unbind () {
    document.removeEventListener('click', handleOutsideClick)
    document.removeEventListener('touchstart', handleOutsideClick)
  }
})

const main = ()=>{
    new Vue({
      router,
      store,
      methods: {
        onClose () {
          this.sidebarCollapse();
        },
        sidebarCollapse(){
          const body = document.body;
          if(body.classList.contains('sidebar-collapse')){
            body.classList.remove('sidebar-collapse');
          }else{
            body.classList.add('sidebar-collapse');
            
          }
          
          if(body.classList.contains('sidebar-open')){
              body.classList.remove('sidebar-open');
              body.classList.remove('sidebar-collapse');
          }else{
            body.classList.add('sidebar-open')
          }
    
        }
      },
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