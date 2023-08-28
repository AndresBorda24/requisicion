import { errorAlert } from "@/partials/alerts"
import { createObservacion } from "@/requests/ObservacionesRequests";

export default () => ({
    obs: "",

    /**
     * Guarda la observacion en la base de datos.
    */
    async saveObs() {
        try {
            const data = await createObservacion(this.data.id, this.obs);
            this.obs = "";
            this.$dispatch("obs-created", data.new);
            this.closeDetail();
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

    closeDetail() {
        this.$refs.obsCreate?.removeAttribute('open');
    },

    setFocus() {
        this.$nextTick(() => this.$refs.obsCreate?.querySelector("textarea")?.focus())
    },

    get obsLength() {
        return this.obs.length;
    }
});
