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

export async function getRequisicionesJefe( state = "" ) {
    try {
        showLoader()
        const { data } = await axios
            .get("/requisicion/get-jefe", {
                params: { state }
            }).finally(hideLoader);

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

export async function updateThRequisicion( state ) {
    try {
        showLoader()
        const { data } = await axios
            .put(`/requisicion/${state.id}/update-th`, state)
            .finally(hideLoader);

        return data;
    } catch(e) {
        throw e;
    }
}
