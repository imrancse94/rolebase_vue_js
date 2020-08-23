export const SET_LOGIN = (state, data) => {
    state.status.loggedIn = true;
    state.user = data.user;
    state.permissions = data.allpermissions;
}

export const SET_LOGOUT = (state) => {
    state.status.loggedIn = false;
    state.user = null;
    state.permissions = null;
}

