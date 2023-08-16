import { errorAlert } from "@/partials/alerts"
import { getRequisicion } from "@/requests/RequisicionRequests";

export default () => ({
    data: {},
    show: false,
    tab: 1,
    events: {
        ["@ver-requisicion.document.stop"]: "openModal",
        ["x-transition.opacity"]: "",
        ["x-show"]: "show"
    },

    async openModal({ detail: id }) {
        this.tab =  1;
        await this.getData( id );
        this.show = true;
        window.overflow();
    },

    closeModal() {
        this.show = false;
        window.overflow(true);
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
