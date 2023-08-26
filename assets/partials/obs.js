import { errorAlert } from "@/partials/alerts"
import { createObservacion } from "@/requests/ObservacionesRequests";

export default () => ({
    obs: "",

    /**
     * Guarda la observacion en la base de datos.
    */
    async saveObs() {
        try {
            await createObservacion(this.data.id, this.obs);
            this.obs = "";
            this.$nextTick(() => this.$el?.querySelector("textarea")?.focus());
        } catch(e) {
            console.error("Save Obs:", e);
            errorAlert("No se ha logrado realizar la observaci&oacute;n")
        }
    },

    /**
     * Determina si mostrar el boton de guardar.
    */
    showSave() {
        return this.obsLength > 5;
    },

    get obsLength() {
        return this.obs.length;
    }
});
