import { grilla } from "@/partials/grilla";
import { getRequisicionesJefe } from "@/requests/RequisicionRequests";

export default () => ({
    ...grilla,
    grillaEvents: {
        ["@new-requisicion.document"]: "addRequisicion"
    },

    async init() {
        await this.getData();
    },

    /**
     * Obtinene la informacion de la grilla
    */
    async getData() {
        try {
            const data = await getRequisicionesJefe(this.grillaState);
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

    /** Agrega una requisicion a la tabla */
    addRequisicion({ detail: data }) {
        this.grillaData.push(data);
    }
});
