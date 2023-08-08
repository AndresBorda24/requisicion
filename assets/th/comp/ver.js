export default () => ({
    data: {},
    show: false,
    events: {
        ["@ver-requisicion.document.stop"]: "openModal",
        ["x-transition.opacity"]: "",
        ["x-show"]: "show"
    },

    openModal({ detail: data }) {
        this.data = data;
        this.show = true;
    },

    closeModal() {
        this.show = false;
    }
});
