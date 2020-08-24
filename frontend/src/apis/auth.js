import {Api,header} from "./Api";

export default {
    login(user) {
        return Api.post('login', {
            email: user.email,
            password: user.password
          })
    },

    setAuth() {
        return Api.get('auth_data',header())
    },

    logout() {
        return Api.get('logout',header());
    }
}