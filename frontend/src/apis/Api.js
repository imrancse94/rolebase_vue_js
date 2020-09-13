import axios from "axios";
import {setToken,getToken} from './../helper/token';
import router from './../router'
import store from './../store';
import * as config from './../config';

export const Api = axios.create({
    baseURL: config.API_BASE_URL
});

Api.interceptors.response.use(
  response =>{ 
    //console.log('intercept response',store.state.idleVue.isIdle)
    if(response.data.data.token){   
      setToken(response.data.data.token);
    }

    return response;
  },
  error => {

      
      // Reject promise if usual error
      if(error.response.status == 401){
        store.dispatch('auth/logout');
        router.push('/login');
        
        //window.location = '/login';
      }else{
        return Promise.reject(error);
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
     // console.log('sssssssss',error.response.status);
      
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


