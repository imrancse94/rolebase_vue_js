import module from "../../../apis/module";

export const getModules = ({ commit }) => {
   return module.getModules().then(({data}) => {
        const response = data.data;
        commit('GET_MODULE', response);
        return Promise.resolve(response);
    })
}

