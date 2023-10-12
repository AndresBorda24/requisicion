import { grilla } from "@/partials/grilla";
import { getRequisiciones } from "@/requests/RequisicionRequests";

export default () => ({
    ...grilla,
    grillaEvents: {
        ...grilla.events,
        ["@new-requisicion.document"]: "addRequisicion"
    },

    async init() {
        this.grillaState = this.$el.dataset.defEstado || "";
        await this.getData();
    },

    /**
     * Obtinene la informacion de la grilla
    */
    async getData() {
        try {
            const data = await getRequisiciones();
            this.grillaData = Object.values(data);
        } catch(e) {
            errorAlert("Error al cargar las requisiciones.");
            console.error(e);
        }
    },

    /**
     * Despacha el evento para ver la informacion de la requisicion.
    */
    verRequisicion( r ) {
        this.$dispatch("ver-requisicion", r.id);
    },

    /** Agrega una requisicion a la tabla */
    addRequisicion({ detail: data }) {
        this.grillaData.push(data);
    }
});
