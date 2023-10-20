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

export async function updateRequisicion( $id, $data ) {
    try {
        showLoader()
        const { data } = await axios
            .put(`/requisicion/${$id}/update`, $data)
            .finally(hideLoader);

        successAlert("Requisici&oacute;n Actualizada");
        return data;
    } catch(e) {
        throw e;
    }
}

export async function getRequisiciones() {
    try {
        showLoader()
        const { data } = await axios
            .get("/requisicion/get")
            .finally(hideLoader);

        return data;
    } catch(e) {
        throw e;
    }
}

export async function getSimilar(x) {
    let error = null;
    let _data = null;

    try {
        const { data } = await axios
            .get("/requisicion/get-similar", {
                params: { x }
            });

        _data = data;
    } catch(e) {
        error = e;
    } finally {
        return [error, _data];
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

export async function getDirRequisiciones() {
    try {
        showLoader()
        const { data } = await axios
            .get("/requisicion/get-dir")
            .finally(hideLoader);

        return data;
    } catch(e) {
        throw e;
    }
}

export async function getGerenciaRequisiciones() {
    try {
        showLoader()
        const { data } = await axios
            .get("/requisicion/get-gerencia")
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

/**
 * Se encarga de actualizar el estado de la requisicion y adjuntar una
 * observacion.
*/
export async function updateState(id, body) {
    let [_, error] = [null, null];

    try {
        showLoader();
        const { data } = await axios
            .put(`/requisicion/${id}/update-state`, {
                ... body
            })
            .finally(hideLoader);

        successAlert("Estado modificado!");
        _ = data;
    } catch(e) {
        error = e;
    } finally {
        return [_, error];
    }
}
