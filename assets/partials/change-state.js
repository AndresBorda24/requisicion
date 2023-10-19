import { errorAlert } from "@/partials/alerts"
import { updateState } from "@/requests/RequisicionRequests";
import { CHANGE_STATE_BTN_RULES, CHANGE_STATE_RULES } from "@/partials/change-state-rules";

export default () => ({
    state: {},
    submitButtonColor: "",
    submitButtonHtml: "Hecho!",
    radio: {
        ['x-model']: "state.state",
        ['type']: "radio",
        ['required']: true,
        ['class']: "visually-hidden"
    },

    init() {
        this.setButtonWatcher();
        // Cuando se selecciona una requisicion diferente se limpia el state
        // que es en si el motivo del cambio de estado
        this.$watch("data.id", () => this.state = {});
    },

    /**
     * Aqui unicamente se realiza la solicitud y se limpia el estado
     * @return {void}
    */
    async changeState() {
        const [data, error] = await updateState(this.data.id, this.state);
        if (error) return errorAlert("Ha ocurrido un error.");

        this.$dispatch("updated-state", {
            id: this.data.id,
            ... data
        });
        this.state = {};
    },

    /**
     * Se establece un watcher en la propiedad state.state (que es el INPUT
     * tipo radio para los estados) para que cuando cambie tambien lo haga
     * el boton de enviar en el formulario
    */
    setButtonWatcher() {
        this.$watch("state.state", (v) => {
            const x = document .querySelector(`input[value="${v}"] + label`);

            if (x) {
                this.submitButtonHtml = x.innerHTML;
                this.submitButtonColor = x.classList.value.match(/line-(\w+)/)[1]
                setTimeout(() => this.$el?.querySelector("textarea")?.focus(), 50);
            };

        });
    },

    /**
     * Determina si el usuario en cuestion puede (o NO) cambiar el estado de la
     * requisicion. Recordar que *this.data* viene del componente padre que es
     * el modal VerRequisicion.
     * @return {Boolean}
    */
    canChangeState() {
        return CHANGE_STATE_RULES( this.data );
    },

    showChangeButton( state ) {
        return CHANGE_STATE_BTN_RULES( state, this.data );
    }
});
