import {Api,header,parameters} from "./Api";

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
        return Api.get('logout',parameters(header(),null));
    }
}