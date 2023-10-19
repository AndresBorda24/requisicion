import Alpine from "alpinejs";
import filters from "@/partials/grilla-filtros"
import grillaItem from "@/partials/grilla-item";

// Componenetes Hijo
document.addEventListener("alpine:init", () => {
    Alpine.data("GrillaItem", grillaItem);
    Alpine.data("GrillaFiltros", filters);
});

export const grilla = {
    grillaData: [],
    grillaState: "PENDIENTE",
    filters: {
        area: "",
        cargo: "",
        state: "",
        by: ""
    },
    events: {
        ["@updated-th.document"]: "updateItemTh($event.detail)",
        ["@updated-state.document"]: "updateItemTh($event.detail)"
    },

    /**
     * Determina si hay datos o no en la grilla
    */
    noData() {
        return this.filtered().length === 0;
    },

    sort(key, $el) {
        const d = JSON.parse($el.dataset.dir);

        if (d) {
            this.grillaData.sort((a, b) => b[key].localeCompare(a[key], "es"));
        } else {
            this.grillaData.sort((a, b) => a[key].localeCompare(b[key], "es"));
        }

        $el.dataset.dir = !d;
    },

    removeItem(id) {
        const index = this.grillaData.findIndex(t => t.id == id)

        if (index > -1) {
            this.grillaData.splice(index, 1);
        }
    },


    /**
     * Una vez TH actualiza los campos necesarios se despacha un evento y se
     * actualiza el estado de la requisicion en la grilla.
    */
    updateItemTh( data ) {
        const index = this.grillaData.findIndex(t => t.id == data.id)
        console.log(index, data);
        if (index > -1) {
            this.grillaData[ index ].by     = data.by;
            this.grillaData[ index ]._state = data._state;
            this.grillaData[ index ].state  = data.state;
            this.grillaData[ index ].state_at  = data.state_at;
        }
    },

    /** @return { array } */
    filtered() {
        return this.grillaData.filter($i =>
            $i.state.includes(this.filters.state)
            && $i.by.includes(this.filters.by)
            && $i.cargo.includes(this.filters.cargo)
            && $i.area_id.toString().includes(this.filters.area)
        );
    }
}
