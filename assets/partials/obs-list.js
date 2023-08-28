import { errorAlert } from "@/partials/alerts"
import { getObservaciones } from "@/requests/ObservacionesRequests";

export default () => ({
    obsList: [],

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
    }
});
