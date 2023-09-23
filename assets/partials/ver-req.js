import { errorAlert } from "@/partials/alerts"
import { getRequisicion } from "@/requests/RequisicionRequests";

export default () => ({
    data: {},
    show: false,
    tab: 1,
    events: {
        ["@ver-requisicion.document.stop"]: "openModal",
        ["x-transition.opacity"]: "",
        ["x-show"]: "show",
        ["@updated-th"]: "updateData($event)",
        ["@updated-state"]: "updateState($event)"
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
    },

    /**
     * Si la requisicion puede modificarse se mostrara un boton para abrir el
     * modal de edicion
    */
    openEdit() {
        this.$dispatch('update-requisicion-info', this.data);
        this.show = false;
    },

    /**
     * Una vez talento humano actualiza los datos de educacion y experiendia
     * se emite un evento ( updated-th ) y se actualizan algunos datos
    */
    updateData({ detail: data }){
        this.data.area = data.area;
        this.data.state = "_"; // Esto es para que los inputs esten disabled
        this.data.sector = data.sector;
        this.data.area_anios = data.area_anios;
        this.data.sector_anios = data.sector_anios;
        this.data.nivel_educativo = data.nivel_educativo;
        this.data._nivel_educativo = data._nivel_educativo || "";
    },

    /**
     * Aqui se actualiza unicamente el estado.
    */
    updateState({ detail: data } ) {
        this.data.by = data.by;
        this.data.state = data.state;
        this.data._state = data._state;
    }
});
