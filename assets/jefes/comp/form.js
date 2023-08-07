export default () => ({
    state: {},
    showForm: false,

    /** Abre el modal y 'Resetea' el estado */
    openForm() {
        this.state = {};
        this.showForm = true;
    },

    /** Cierra el modal */
    closeForm() {
        this.showForm = false;
    }
});
