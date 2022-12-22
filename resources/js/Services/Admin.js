import axios from "axios";
export default class Admin {
    constructor(api) {
        this.api = api;
    }

    find(params = []) {
        return axios.get(this.api, {params})
    }

    delete(url) {
        console.log("delete", url)
        return axios.delete(url);
    }
}
