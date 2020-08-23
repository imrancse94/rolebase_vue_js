import {getToken} from './../helper/token';
export default function authHeader() {
  let token = getToken();
  let obj = {};

  if (token) {
    obj = { Authorization: 'Bearer ' + token };
  } 

  return obj;
}
