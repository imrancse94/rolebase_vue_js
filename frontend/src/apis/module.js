import {Api,header} from "./Api";

export default {
    getModules(params){
        console.log(params)
        return Api.get('modules',{headers:header(),params:{params}})
    }
}