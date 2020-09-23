import axios from "axios";
import {getToken,setToken} from './../helper/token';
//import router from './../router' 
import store from './../store';
import * as config from './../config';




export const Api = axios.create({
    baseURL: config.API_BASE_URL
});


Api.interceptors.request.use(function (config) {
  
  store.commit('auth/SET_LOADER',true);
  
  let token = getToken();

  if(token){
    config.headers.Authorization =  'bearer '+token;
    console.log('resquest',config);
  }

  return config;

}, function (error) {
  store.commit('auth/SET_LOADER',false);
  return Promise.reject(error);
});

Api.interceptors.response.use(
  response =>{ 

    console.log('response',response);

    store.commit('auth/SET_LOADER',false);

    if(response.data.status == "TOKEN_EXPIRED" && !response.config._retry){
        response.config._retry = true;
        setToken(response.data.token);
        response.config.headers.Authorization =  'bearer '+ response.data.token;
        return Api(response.config);
    }

    return response;
  },
  error => {
    console.log('error 401',error.response);

    store.commit('auth/SET_LOADER',false);

    


    return Promise.reject(error);
      // Reject promise if usual error
      
      /* 
       * When response code is 401, try to refresh the token.
       * Eject the interceptor so it doesn't loop in case
       * token refresh causes the 401 response
       */
      
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
  

export const parameters = (params) =>{
      var obj = {};
      
      if(params){
        obj['params'] = params;
      }

      return obj;
}


