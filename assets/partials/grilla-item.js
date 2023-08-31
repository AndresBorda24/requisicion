export default (itemId) => ({
    id: itemId,

    get stateClass() {
        const classes = {
            SO: "text-bg-solicitud",
            RV: "text-bg-revision",
            AP: "text-bg-aprobado",
            AN: "text-bg-anulado",
            CR: "text-bg-cerrado",
            PA: "text-bg-pendiente"
        };

        return classes[ this.item.state ] || "";
    },

    get item() {
        return this.grillaData.find( ({ id }) => id == this.id );
    }
});
