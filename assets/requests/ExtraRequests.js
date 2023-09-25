import axios from "axios";
// import { successAlert } from "@/partials/alerts"
// import { showLoader, hideLoader } from "@/partials/loader";

axios.defaults.baseURL = process.env.APP_API;

export async function getAreas() {
    try {
        const { data } = await axios.get(`/get/areas`);
        return data;
    } catch(e) {
        throw e;
    }
}

export async function getAuthInfo() {
    try {
        const { data } = await axios.get(`/auth/info`);
        return data;
    } catch(e) {
        throw e;
    }
}

export async function getMetaInfo() {
    let [_, error] = [null, null];

    try {
        const { data } = await axios .get(`/get/meta`);
        _ = data;
    } catch(e) {
        error = e;
    } finally {
        return [_, error];
    }
}
