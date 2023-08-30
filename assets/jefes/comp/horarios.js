export default () => ({
    horario: "",
    custom: "...",

    init() {
        this.$watch("custom", (val) => this.horario = val);
    },

    /**
     * Se utiliza para hacer focus al input de hoario custom si el usuario
     * `otro` en el select
    */
    setCustomFocus() {
        if (this.isCustomSelected) {
            setTimeout(() => document.getElementById("custom-horario")?.focus(), 1);
        }
    },

    get isCustomSelected() {
        return this.horario === this.custom;
    }
})
