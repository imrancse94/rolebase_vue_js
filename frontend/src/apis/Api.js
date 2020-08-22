import axios from "axios";

const Api = axios.create({
    baseURL: 'http://localhost/portfolio/backend/public/api/'
});

export default Api;