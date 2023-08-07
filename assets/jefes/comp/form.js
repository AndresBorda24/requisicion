export default () => ({
    state: {},
    showForm: false,

    /** Abre el modal y 'Resetea' el estado */
    openForm() {
        this.state = {};
        this.showForm = true;
    },

    /**
     * Guarda la requisicion en la base de datos.
    */
    async save() {
        const data = JSON.parse(JSON.stringify(this.state));
        data.state = "Pendiente";
        data.created_at = "2023-08-07 10:20";

        this.$dispatch("new-requisicion", data);
        this.closeForm();
    },

    /** Cierra el modal */
    closeForm() {
        this.showForm = false;
    }
});
