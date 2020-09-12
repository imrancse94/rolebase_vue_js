import axios from "axios";
import {getToken} from './../helper/token';
import router from './../router'
import store from './../store';

export const Api = axios.create({
    baseURL: 'http://localhost/portfolio/backend/public/api/'
});

Api.interceptors.response.use(
  response =>{ 
    //console.log('intercept response',store.state.idleVue.isIdle)
    return response;
  },
  error => {

      
      // Reject promise if usual error
      if(error.response.status == 401){
        store.dispatch('auth/logout');
        router.push('/login');
      }

      /* 
       * When response code is 401, try to refresh the token.
       * Eject the interceptor so it doesn't loop in case
       * token refresh causes the 401 response
       */
      //Api.interceptors.response.eject(interceptor);

      /* return Api.post('refreshtoken',{}).then(response => {
          
          
      }).catch(error => {
          
      }); */

      return Promise.reject(error);
  }
);


export const header = () => {
    let token = getToken();
    let obj = {};
  
    if (token) {
      obj = { 
        'Authorization': 'Bearer ' + token,
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      };
    } 
  
    return obj;
  }
  

export const parameters = (hedaers, params) =>{
      var obj = {};
      if(hedaers){
        obj['headers'] = hedaers;
      }

      if(params){
        obj['params'] = params;
      }

      return obj;
}


