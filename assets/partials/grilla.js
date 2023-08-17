export const grilla = {
    grillaData: [],
    grillaState: "PENDIENTE",
    events: {
        ["@updated-th.document"]: "removeItem($event.detail.id)"
    },

    /**
     * Determina si hay datos o no en la grilla
    */
    noData() {
        return this.grillaData.length === 0;
    },


    removeItem(id) {
        const index = this.grillaData.findIndex(t => t.id == id)

        if (index > -1) {
            this.grillaData.splice(index, 1);
        }
    }
}
