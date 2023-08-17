import { updateThRequisicion } from "@/requests/RequisicionRequests";
import { errorAlert } from "@/partials/alerts"

export default () => ({
    state: {},
    isPendiente: true,
    pendiente: undefined,

    init() {
        this.pendiente = this.$el.dataset.estadoPendiente || "";

        // data viene del componente padre, que es /partials/ver-req
        this.$watch('data', val => {
            if (val) this.setData( val );
        })
    },

    /**
     * Establece unas propiedades dependiendo de val.
    */
    setData( val ){
        this.isPendiente = (val._state == this.pendiente);
        this.state = {
            area: val.area,
            sector: val.sector,
            area_anios: val.area_anios,
            sector_anios: val.sector_anios,
            nivel_educativo: val.nivel_educativo
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
            await updateThRequisicion(
                this.getReq('id'),
                this.state
            );

            this.$dispatch('updated-th', {
                ... this.state,
                id: this.getReq('id')
            });
        } catch(e) {
            errorAlert(e.message);
        }
    }
});
