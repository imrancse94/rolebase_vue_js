import user from './../../Api/user';


export const getUserList = ({ commit }, params) => {
    return user.getUserList(params).then(({ data }) => {
        return Promise.resolve(data.data);
    }).catch(error => {
        return Promise.reject(error);
    })
}

export const getUserById = ({ commit },params) => {
    return user.getUserById(params).then(({ data }) => {
        return Promise.resolve(data.data);
    }).catch(error => {
        return Promise.reject(error);
    })
}

export const userEdit = ({commit},params) =>{
    return user.userEdit(params).then(({ data }) => {
        return Promise.resolve(data.data);
    }).catch(error => {
        return Promise.reject(error);
    })
}

export const updatePassword = ({commit},params) =>{
    return user.updatePassword(params).then(({ data }) => {
        return Promise.resolve(data.data);
    }).catch(error => {
        return Promise.reject(error);
    })
}