import {Api,header,parameters} from "./Api";

export default {
    getModules(params){
        return Api.get('modules',parameters(header(),params))
    }
}