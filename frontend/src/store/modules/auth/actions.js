import auth from "../../../apis/auth";

export const login = ({ commit },user) => {
   return auth.login(user).then(({data}) => {
        const response = data.data;
        if (response.token) {
            localStorage.setItem('token', response.token);
            localStorage.setItem('user', JSON.stringify(response.user));
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
        console.log(error)
        auth.logout();
        commit('SET_LOGOUT');
    })
}

export const logout = ({ commit }) => {
    auth.logout();
    commit('SET_LOGOUT');
}
