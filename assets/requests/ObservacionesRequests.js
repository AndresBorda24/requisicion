import axios from "axios";
import { successAlert } from "@/partials/alerts"
import { showLoader, hideLoader } from "@/partials/loader";

axios.defaults.baseURL = process.env.APP_API;

export async function createObservacion( reqId, obs ) {
    try {
        showLoader()
        const { data } = await axios
            .post(`/observacion/${reqId}/create`, {
                body: obs
            }).finally(hideLoader);

        successAlert();
        return data;
    } catch(e) {
        throw e;
    }
}

export async function getObservaciones( reqId ) {
    try {
        const { data } = await axios
            .get(`/requisicion/${reqId}/observaciones`, {
                body: obs
            });

        return data;
    } catch(e) {
        throw e;
    }
}
