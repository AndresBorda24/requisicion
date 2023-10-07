import { updateThRequisicion } from "@/requests/RequisicionRequests";
import { errorAlert } from "@/partials/alerts"

export default () => ({
    state: {},

    init() {
        // data viene del componente padre, que es /partials/ver-req
        this.$watch('data', val => {
            if (val) this.setData( val );
        })
    },

    /**
     * Establece unas propiedades dependiendo de val.
    */
    setData( val ){
        this.state = {
            area: val.area,
            sector: val.sector,
            area_anios: val.area_anios,
            sector_anios: val.sector_anios,
            nivel_educativo: val.nivel_educativo,
            director: val.director
        };
    },

    /**
     * Actualiza el valor del _nivel_educativo.
    */
    updateEduText({ target: T }) {
        this.state._nivel_educativo = T.options[ T.selectedIndex ].text
    },

    /**
     * Realiza la solicutud y actualiza los datos.
    */
    async save() {
        try {
            const data = await updateThRequisicion(
                this.getReq('id'),
                this.state
            );

            this.$dispatch('updated-th', {
                ... { ... this.state, ... data.__ctrl }, // Gracias JavaScript <3
                id: this.getReq('id')
            });
        } catch(e) {
            errorAlert(e.message);
        }
    },

    /**
     * Determina si se muestra o no el formulario para que TH realice las
     * modificaciones.
    */
    canUpdate() {
        if (! this.data?.id) return false;

        if (this.data.state === this.$store.META.get('estados')?.SOLICITUD) {
            return true;
        }

        if (
            this.data.state === this.$store.META.get('estados')?.DEVUELTO && (
            this.data.by    === this.$store.META.get('u_tipos')?.DIRECTOR_CIENTIFICO
            || this.data.by === this.$store.META.get('u_tipos')?.DIRECTOR_ADMINISTRATIVO
        )) {
            return true;
        }

        return false;
    }
});
