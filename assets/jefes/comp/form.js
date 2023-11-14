import { errorAlert } from "@/partials/alerts"
import { setInvalid, removeInvalid } from "@/partials/form-validation";
import { createRequisicion, updateRequisicion } from "@/requests/RequisicionRequests";

export default () => ({
    state: {},
    showForm: false,
    events: {
        ["@update-requisicion-info.document"]: "openForm($event.detail)"
    },

    /**
     * Guarda la requisicion en la base de datos.
    */
    async save() {
        try {
            removeInvalid();
            if ( this.isEdit ) {
                const data = await updateRequisicion(this.state.id, this.state);
                this.$dispatch("updated-state", data.data);
            } else {
                const data = await createRequisicion(this.state);
                this.$dispatch("new-requisicion", data.data);
            }
            this.closeForm();
        } catch(e) {
            setInvalid(e?.response?.data?.fields || {});
            errorAlert("No se pudo realizar la solicitud");
            console.error("Create Req: ", e);
        }
    },

    /** Abre el modal y 'Resetea' el estado */
    openForm( _data = null ) {
        window.overflow();
        this.state = _data ?? { cargo: "" };
        this.showForm = true;
        setTimeout(() => {
            const _ = document.getElementById('cargo');
            _.focus();
        }, 20);
    },

    /** Cierra el modal */
    closeForm() {
        window.overflow(true);
        this.showForm = false;
    },

    /**
     * Determina si una requisicion se esta creando o editando
    */
    get isEdit() {
        return Boolean(this.state.id);
    }
});
