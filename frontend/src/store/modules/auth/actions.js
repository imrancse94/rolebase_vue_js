import auth from "../../../apis/auth";
import {setToken,removeToken} from './../../../helper/token';

export const login = ({ commit },user) => {
   return auth.login(user).then(({data}) => {
        const response = data.data;
        if (response.token) {
            setToken(response.token)
        }
        commit('SET_LOGIN', response);
        return Promise.resolve(data);
    })
}

export const setAuth = ({ commit }) => {
    return auth.setAuth().then(({data}) => {
        const response = data.data;
        commit('SET_LOGIN', response);
        return Promise.resolve(data);
    }).catch((error)=>{
        removeToken();
        commit('SET_LOGOUT');
        return Promise.resolve(error);
    })
}

export const logout = ({ commit }) => {
    removeToken();
    commit('SET_LOGOUT');
    
}
