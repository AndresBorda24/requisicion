import { grilla } from "@/partials/grilla";
import { errorAlert } from "@/partials/alerts"
import { getAllRequisiciones } from "@/requests/RequisicionRequests";

export default () => ({
    ...grilla,

    async init() {
        this.grillaState = this.$el.dataset.defEstado || "";
        await this.getData();
    },

    /**
     * Obtinene la informacion de la grilla
    */
    async getData() {
        try {
            const data = await getAllRequisiciones(this.grillaState);
            this.grillaData = data.data;
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
});
