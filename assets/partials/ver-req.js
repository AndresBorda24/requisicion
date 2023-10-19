import Alpine from "alpinejs";
import { errorAlert } from "@/partials/alerts"
import { getRequisicion } from "@/requests/RequisicionRequests";

export default () => ({
    data: {},
    show: false,
    tab: 1,
    events: {
        ["id"]: "ver-requisicion",
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
        this.$nextTick(() => this.$el.scroll(0, 0));
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
     * Determina si mostrar o no el boton para modificar la requisicion
     */
    canOpenEdit() {
        return this.data.state === Alpine.store("META").get("estados")?.DEVUELTO
          && this.data.by === Alpine.store("META").get("u_tipos")?.TH
          && this.data.jefe_id == Alpine.store("AUTH").get("jefe");
    },

    /**
     * Una vez talento humano actualiza los datos de educacion y experiendia
     * se emite un evento ( updated-th ) y se actualizan algunos datos
    */
    updateData({ detail: data }){
        this.data.by = data.by;
        this.data.area = data.area;
        this.data.state = data.state;
        this.data._state = data._state;
        this.data.sector = data.sector;
        this.data._director = data._director;
        this.data.area_anios = data.area_anios;
        this.data.sector_anios = data.sector_anios;
        this.data.nivel_educativo = data.nivel_educativo;
        this.data._nivel_educativo = data._nivel_educativo || "";
    },

    /**
     * Aqui se actualiza unicamente el estado.
    */
    updateState({ detail: data } ) {
        document
            .getElementById(this.events["id"])
            ?.scroll(0, 0);
        this.data.by = data.by;
        this.data.state = data.state;
        this.data._state = data._state;
    }
});
