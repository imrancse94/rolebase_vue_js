import Api from "./Api";
import authHeader from './token-header';
const END_POINT = 'cart';

export default {
    login(user) {
        return Api.post('login', {
            email: user.email,
            password: user.password
          })
    },

    setAuth() {
        return Api.get('auth_data',{ headers: authHeader() })
      }
    ,

    logout() {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
    },

    deleteAll() {
        return Api.delete(END_POINT);
    }
}