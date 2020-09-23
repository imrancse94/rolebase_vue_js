import {Api,parameters} from "./Api";


export default {
    getModules(params){
        return Api.get('modules',parameters(params))
    },
    moduleAdd(params){
        return Api.post('moduleAdd',parameters(params))
    }
}


