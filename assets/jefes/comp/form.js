import { errorAlert } from "@/partials/alerts"
import { createRequisicion } from "@/requests/RequisicionRequests";

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
        window.overflow();
        this.state = { cargo: "" };
        this.showForm = true;
        setTimeout(() => {
            const _ = document.getElementById('cargo');
            _.focus();
        }, 1);
    },

    /** Cierra el modal */
    closeForm() {
        window.overflow(true);
        this.showForm = false;
    }
});
