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
    },

    /**
     * Se emplea para que los componentes hijo puedan acceder a la informacion
     * de la requisicion que se esta mostrando.
     *
     * @param {String} prop Nombre de la propiedad a buscar.
    */
    getReq( prop = null ) {
        if (prop === null) return this.data;

        if (Object.prototype.hasOwnProperty.call(this.data, prop)) {
            return this.data[ prop ];
        }

        return null;
    }
});
