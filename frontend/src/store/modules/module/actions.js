import module from "../../../apis/module";

export const getModules = ({ commit },params) => {
   return module.getModules(params).then(({data}) => {
        const response = data.data;
        commit('GET_MODULE', response);
        return Promise.resolve(response);
    })
}


export const moduleAdd = ({ commit },params) => {
    
    return module.moduleAdd(params).then(({data}) => {
         const response = data;
         commit('ADD_MODULE', response);
         return Promise.resolve(response);
     })
 }



export const getModuleById = ({ commit },params) => {
    
    return module.getModuleById(params).then(({data}) => {
         const response = data.data;
         commit('GET_MODULE_BY_ID', response);
         return Promise.resolve(response);
     })
 }


 export const moduleEdit = ({ commit },params) => {
    
    return module.moduleEdit(params).then(({data}) => {
         const response = data;
         commit('MODULE_EDIT_BY_ID', response);
         return Promise.resolve(response);
     })
 }


 export const moduleDelete = ({ commit },params) => {
    
    return module.moduleDelete(params).then(({data}) => {
         const response = data;
         commit('MODULE_DELETE_BY_ID', response);
         return Promise.resolve(response);
     })
 }