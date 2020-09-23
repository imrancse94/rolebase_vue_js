import {Api,parameters} from "./Api";

export default {
    login(user) {
        return Api.post('login', {
            email: user.email,
            password: user.password
          })
    },

    setAuth() {
        return Api.get('auth_data',parameters(null))
    },

    logout() {
        return Api.post('logout');
    },

    refreshtoken() {
        return Api.post('refreshtoken',parameters(null));
    }
}