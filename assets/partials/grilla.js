export const grilla = {
    grillaData: [],
    grillaState: "PENDIENTE",

    /**
     * Determina si hay datos o no en la grilla
    */
    noData() {
        return this.grillaData.length === 0;
    },
}
