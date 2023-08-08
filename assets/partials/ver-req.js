import { errorAlert } from "@/partials/alerts"
import { getRequisicion } from "@/requests/RequisicionRequests";

export default () => ({
    data: {},
    show: false,
    events: {
        ["@ver-requisicion.document.stop"]: "openModal",
        ["x-transition.opacity"]: "",
        ["x-show"]: "show"
    },

    async openModal({ detail: id }) {
        await this.getData( id );
        this.show = true;
    },

    closeModal() {
        this.show = false;
    },

    async getData( id ) {
        try {
            const data = await getRequisicion(id);
            this.data = data.data;
        } catch(e) {
            errorAlert("No se ha conseguido la informaci&oacute;n.");
            console.error("Find req: ", e);
        }
    }
});
