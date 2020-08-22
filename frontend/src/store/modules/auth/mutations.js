export const SET_LOGIN = (state, data) => {
    state.status.loggedIn = true;
    state.user = data.user;
    state.permissions = data.allpermissions;
}

export const SET_LOGOUT = (state) => {
    console.log('logout',state);
    state.status.loggedIn = false;
    state.user = null;
}

