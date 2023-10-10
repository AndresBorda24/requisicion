import Alpine from "alpinejs";

export default (itemId) => ({
    id: itemId,

    get item() {
        return this.grillaData.find(({ id }) => id == this.id);
    },

    get style() {
        switch (this.item?.state) {
            case Alpine.store("META")?.get("estados").RECHAZADO:
            case Alpine.store("META")?.get("estados").ANULADO:
                return "border-danger bg-opacity-10 bg-danger";

            case Alpine.store("META")?.get("estados").APROBADO:
            case Alpine.store("META")?.get("estados").CUMPLIDO:
                return "border-success bg-opacity-10 bg-success";

            case Alpine.store("META")?.get("estados").DEVUELTO:
                return "border-dark bg-opacity-10 bg-dark";

            case Alpine.store("META")?.get("estados").SOLICITUD:
                return "border-primary bg-opacity-10 bg-primary";

            default:
                return "";
        }
    }
});
