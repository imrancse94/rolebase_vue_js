import {Api,header} from "./Api";

export default {
    getModules(){
        return Api.get('modules',header())
    }
}