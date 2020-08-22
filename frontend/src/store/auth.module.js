import AuthService from '../services/auth.service';

const token = localStorage.getItem('token');
// const initialState = user
//   ? { status: { loggedIn: true }, user }
//   : { status: { loggedIn: false }, user: null };

  const initialState = token ?
    {
      status: { 
        loggedIn: true 
      },
      user:null,
      permissions:null
    }
  :
  {
    status: { 
      loggedIn: false 
    },
    user:null,
    permissions:null
  }

export const auth = {
  namespaced: true,
  state: initialState,

  actions: {
    login({ commit }, user) {
      return AuthService.login(user).then(
        user => {
          commit('loginSuccess', user);
          return Promise.resolve(user);
        },
        error => {
          commit('loginFailure');
          return Promise.reject(error);
        }
      );
    },
    setAuth({ commit }) {
      return AuthService.setAuth().then(
        response => {
          const reponse_data = response;
          commit('loginSuccess', reponse_data);
          return Promise.resolve(reponse_data);
        },
        error => {
          AuthService.logout();
          commit('logout');
          return Promise.reject(error);
        }
      );
    },
    logout({ commit }) {
      AuthService.logout();
      commit('logout');
    },
    register({ commit }, user) {
      return AuthService.register(user).then(
        response => {
          commit('registerSuccess');
          return Promise.resolve(response.data);
        },
        error => {
          commit('registerFailure');
          return Promise.reject(error);
        }
      );
    }
  },
  mutations: {
    loginSuccess(state, data) {

      state.status.loggedIn = true;
      state.user = data.data.user;
      state.permissions = data.data.allpermissions;
    },
    loginFailure(state) {
      state.status.loggedIn = false;
      state.user = null;
    },
    logout(state) {
      state.status.loggedIn = false;
      state.user = null;
    },
    registerSuccess(state) {
      state.status.loggedIn = false;
    },
    registerFailure(state) {
      state.status.loggedIn = false;
    }
  },
  getters: {
    getPermissions: state => {
      return state
    }
  }
};
