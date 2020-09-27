import {Api} from "./Api";


export default {
    getSubModules(params){
        return Api.get('submodules',params)
    },
    
    subModuleAdd(params){
        return Api.post('submoduleAdd',params)
    },
    
    getSubModuleById(params){
        return Api.get('submodule/edit/'+params)
    },

    subModuleEdit(params){ 

        return Api.put('submodule/edit/'+params.id,params)

    },

    subModuleDelete(params){
        return Api.delete('submodule/delete/'+params)
    }
}


