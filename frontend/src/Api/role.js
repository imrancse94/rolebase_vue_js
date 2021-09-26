import { Api } from './index';
import { makeURLQueryString } from '../Helper';

export default {
    getRoles(params) {
        return Api.get(makeURLQueryString('roles', params))
    },

    RoleAdd(params) {
        return Api.post('roleAdd', params)
    },

    getRoleById(params) {
        return Api.get('role/edit/' + params.id)
    },

    RoleEdit(params) {
        return Api.put('role/edit/' + params.id, params)
    },

    RoleDelete(params) {
        return Api.delete('role/delete/' + params)
    }
}