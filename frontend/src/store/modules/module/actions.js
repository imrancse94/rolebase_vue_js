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

