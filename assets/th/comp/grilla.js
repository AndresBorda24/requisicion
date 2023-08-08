import { errorAlert } from "@/partials/alerts"
import { getAllRequisiciones } from "@/requests/RequisicionRequests";

export default () => ({
    grillaData: [],
    grillaState: "PENDIENTE",

    async init() {
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
        this.$dispatch("ver-requisicion", r);
    },

    /**
     * Determina si hay datos o no en la grilla
    */
    get noData() {
        return this.grillaData.length === 0;
    }
});
