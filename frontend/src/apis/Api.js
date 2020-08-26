import axios from "axios";
import {getToken} from './../helper/token';

export const Api = axios.create({
    baseURL: 'http://localhost/portfolio/backend/public/api/'
});

export const header = () => {
    let token = getToken();
    let obj = {};
  
    if (token) {
      obj = { Authorization: 'Bearer ' + token };
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


