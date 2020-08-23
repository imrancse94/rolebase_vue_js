import Api from "./Api";
import authHeader from './token-header';
const header =  {headers: authHeader() };
export default {
    login(user) {
        return Api.post('login', {
            email: user.email,
            password: user.password
          })
    },

    setAuth() {
        return Api.get('auth_data',header)
    },

    logout() {
        return Api.get('logout',header);
    }
}