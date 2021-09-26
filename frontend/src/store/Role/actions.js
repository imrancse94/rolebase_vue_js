import role from './../../Api/role';

export const getRoles = ({ commit }, params) => {
    return new Promise((resolve, reject) => {
        return role.getRoles(params).then(({ data }) => {
            resolve(data)
        }).catch(error => {
            reject(error) // return error to calling function
        })
    })

}

export const getRoleById = ({ commit }, params) => {
    return new Promise((resolve, reject) => {
        return role.getRoleById(params).then(({ data }) => {
            resolve(data)
        }).catch(error => {
            reject(error) // return error to calling function
        })
    })

}