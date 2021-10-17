import { Api } from './index';
import { makeURLQueryString } from './../Helper';

export default {
   getUserList(params){
        return Api.get(makeURLQueryString('users', params))
   },

   getUserById(params){
      return Api.get('user/edit/'+params)
   },

   userEdit(params) {
      return Api.put('user/edit/' + params.id, params)
  },

  updatePassword(params){
      return Api.put('user/password/update/' + params.id, params)
  }

}