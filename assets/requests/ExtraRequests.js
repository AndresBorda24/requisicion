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
