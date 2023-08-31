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

export async function getAllRequisiciones() {
    try {
        showLoader()
        const { data } = await axios
            .get("/requisicion/get-th")
            .finally(hideLoader);

        return data;
    } catch(e) {
        throw e;
    }
}

export async function getRequisicionesJefe() {
    try {
        showLoader()
        const { data } = await axios
            .get("/requisicion/get-jefe")
            .finally(hideLoader);

        return data;
    } catch(e) {
        throw e;
    }
}

export async function getRequisicion( id ) {
    try {
        showLoader()
        const { data } = await axios
            .get(`/requisicion/${id}/get`)
            .finally(hideLoader);

        return data;
    } catch(e) {
        throw e;
    }
}

export async function updateThRequisicion( id, state ) {
    try {
        showLoader()
        const { data } = await axios
            .put(`/requisicion/${id}/update-th`, state)
            .finally(hideLoader);

        return data;
    } catch(e) {
        throw e;
    }
}
