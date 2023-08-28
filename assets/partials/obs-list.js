import { errorAlert } from "@/partials/alerts"
import { getObservaciones } from "@/requests/ObservacionesRequests";

export default () => ({
    obsList: [],
    events: {
        ['@obs-created.document.stop']: "addObs"
    },

    init() {
        this.$watch("data.id", (val) => {
            console.log("Req: ", val);
            this.getObs();
        })
    },

    /**
     * Obtiene las observaciones de una requisicion especifica.
    */
    async getObs() {
        try {
            this.obsList = [];
            this.obsList = await getObservaciones(this.data.id);
        } catch(e) {
            console.error("Get Obs:", e);
            errorAlert();
        }
    },

    /**
     * Agrega una observacion al array. Esto se hace con la finalidad de evitar
     * hacer la consulta y volver a cargar todas las observaciones.
    */
    addObs({ detail: data }) {
        this.obsList.unshift(data);
    }
});
