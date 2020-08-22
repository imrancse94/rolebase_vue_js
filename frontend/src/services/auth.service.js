import axios from 'axios';
import authHeader from './auth-header';
const API_URL = 'http://localhost/portfolio/backend/public/api/';

class AuthService {
  login(user) {
    return axios
      .post(API_URL + 'login', {
        email: user.email,
        password: user.password
      })
      .then(response => {
        
        response = response.data;

        if (response.data.token) {
          localStorage.setItem('token', response.data.token);
         // localStorage.setItem('user', JSON.stringify(response.data.user));
        }
        
        return response;
      });
  }

  setAuth() {
    return axios
      .get(API_URL + 'auth_data',{ headers: authHeader() })
      .then(response => {
        response = response.data;
        if (response.data.token) {
          localStorage.setItem('token', response.data.token);
          localStorage.setItem('user', JSON.stringify(response.data.user));
        }

        return response;
      });
  }


  logout() {
    localStorage.removeItem('token');
    localStorage.removeItem('user');
  }

  register(user) {
    return axios.post(API_URL + 'signup', {
      username: user.username,
      email: user.email,
      password: user.password
    });
  }

  
}

export default new AuthService();
