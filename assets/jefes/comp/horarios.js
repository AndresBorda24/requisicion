export default () => ({
    horario: "",
    custom: "...",
    noCustomOptions: [],

    init() {
        this.setHorarioWatch();
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

    setHorarioWatch() {
        this.$refs["custom-schedule-select"]
            .querySelectorAll("option[no-custom]")
            .forEach(op => this.noCustomOptions.push(op.value));

        const customOption = this.$refs["custom-schedule-select"]
            .querySelector('option:not([no-custom]):not([hidden])');

        this.$watch("state.horario", (val) => {
            if (! Boolean(val)) return;

            if (
                ! this.noCustomOptions.includes(val)
                && this.custom !== val
            ) {
                this.custom = val;
                if (customOption) customOption.selected = true;
            }
        });
    },

    get isCustomSelected() {
        return this.horario === this.custom;
    }
})
