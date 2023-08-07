import { errorAlert } from "@/partials/alerts"
import { createRequisicion } from "@/jefes/requests/RequisicionRequests";

export default () => ({
    state: {},
    showForm: false,

    /**
     * Guarda la requisicion en la base de datos.
    */
    async save() {
        try {
            const data = await createRequisicion(this.state);
            this.$dispatch("new-requisicion", data.data);
            this.closeForm();
        } catch(e) {
            errorAlert("No se pudo realizar la solicitud");
            console.error("Create Req: ", e);
        }
    },

    /** Abre el modal y 'Resetea' el estado */
    openForm() {
        this.state = {};
        this.showForm = true;
    },

    /** Cierra el modal */
    closeForm() {
        this.showForm = false;
    }
});
