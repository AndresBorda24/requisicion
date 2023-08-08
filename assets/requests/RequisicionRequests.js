import axios from "axios";
import { successAlert } from "@/partials/alerts"
import { showLoader, hideLoader } from "@/partials/loader";

axios.defaults.baseURL = process.env.APP_API;

export async function createRequisicion( $data ) {
    try {
        showLoader()
        const { data } = await axios
            .post("/requisicion/create", $data)
            .finally(hideLoader);

        successAlert("Requisici&oacute;n Solicitada");
        return data;
    } catch(e) {
        throw e;
    }
}

export async function getAllRequisiciones( state = "" ) {
    try {
        showLoader()
        const { data } = await axios
            .get("/requisicion/get-th", {
                params: { state }
            }).finally(hideLoader);

        return data;
    } catch(e) {
        throw e;
    }
}
