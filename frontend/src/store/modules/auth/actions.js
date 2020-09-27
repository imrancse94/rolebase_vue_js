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
        throw error;
        //return Promise.resolve(error);
    })
}

export const logout = ({ commit }) => {
    return auth.logout().then(() => {
        
        removeToken();
        commit('SET_LOGOUT'); 

    }).catch(()=>{
        removeToken();
        commit('SET_LOGOUT');
    })

    
}


export const refreshtoken = ({ commit }) => {
    return auth.refreshtoken().then(({data}) => {
         const response = data.data;
         if (response.token) {
             setToken(response.token)
         }
         commit('SET_LOGIN', response);
         return Promise.resolve(data);
     })
 }

 export const inValidRoute = ({commit},payload) =>{
    commit('SET_INVALID_ROUTE',payload);
    return Promise.resolve();
 }
 
