export default () => ({
    /** @var Tabulator */
    grilla: undefined,
    grillaData: [],
    grillaEvents: {
        ["@new-requisicion.document"]: "addRequisicion"
    },

    init() {
    },

    /** Agrega una requisicion a la tabla */
    addRequisicion({ detail: data }) {
        this.grillaData.push(data);
    }
});
