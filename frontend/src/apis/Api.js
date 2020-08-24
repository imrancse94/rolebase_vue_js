import axios from "axios";
import {getToken} from './../helper/token';

export const Api = axios.create({
    baseURL: 'http://localhost/portfolio/backend/public/api/'
});

export const header = () => {
    let token = getToken();
    let obj = {};
  
    if (token) {
      obj = {headers:{ Authorization: 'Bearer ' + token }};
    } 
  
    return obj;
  }
  


