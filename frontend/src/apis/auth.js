import {Api,header,parameters} from "./Api";
console.log('dddd',parameters(header(),null));
export default {
    login(user) {
        return Api.post('login', {
            email: user.email,
            password: user.password
          })
    },

    setAuth() {
        return Api.get('auth_data',parameters(header(),null))
    },

    logout() {
        return Api.post('logout',parameters(header(),{}));
    },

    refreshtoken() {
        return Api.post('refreshtoken',parameters(header(),null));
    }
}