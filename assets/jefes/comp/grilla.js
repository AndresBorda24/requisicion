import Pagination from "s-pagination";
import { grilla } from "@/partials/grilla";
import { getRequisiciones } from "@/requests/RequisicionRequests";

export default () => ({
    ...grilla,
    pageNum: 0,
    pageSize: 20,
    pagination: null,
    grillaEvents: {
        ...grilla.events,
        ["@new-requisicion.document"]: "addRequisicion"
    },

    async init() {
        this.$watch("filters", () => {
            console.log("updated filters");
            this.__data = this.filtered();
            this.makePagination()
        });
        this.$watch("sorting", () => {
            this.__data = this.sorted();
            console.log("updated sorting");
        });
        // ---------------------------------------------------------------------
        this.pagination = new Pagination({
            container: document.getElementById("pagination-grilla"),
            pageClickCallback: ( pageNum ) => this.pageNum = (pageNum - 1)
        });
        // ---------------------------------------------------------------------
        await this.getData();
        this.makePagination();
    },

    /**
     * Construye la paginacion
    */
    makePagination() {
        this.pageNum = 0;
        this.pagination.make(this.__data.length, this.pageSize);
    },

    /**
     * Obtinene la informacion de la grilla
    */
    async getData() {
        try {
            const data = await getRequisiciones();
            this.__data = Object.values(data);
            this.grillaData = Object.values(data);
            this.$nextTick(() => {
                this.sort(
                    "created_at",
                    document.getElementById("sort-created-at")
                );
            });
        } catch(e) {
            errorAlert("Error al cargar las requisiciones.");
            console.error(e);
        }
    },

    get page() {
        const start = (this.pageNum * 20) + 1;
        const end = start + 20;

        return this.__data.slice(start, end);
    },

    /**
     * Despacha el evento para ver la informacion de la requisicion.
    */
    verRequisicion( r ) {
        this.$dispatch("ver-requisicion", r.id);
    },

    /** Agrega una requisicion a la tabla */
    addRequisicion({ detail: data }) {
        this.grillaData.unshift(data);
    }
});
