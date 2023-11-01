import Pagination from "s-pagination";
import { grilla } from "@/partials/grilla";
import { getAllRequisiciones } from "@/requests/RequisicionRequests";

export default () => ({
    ...grilla,
    pageNum: 0,
    pageSize: 15,
    pagination: null,

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
            pageClickCallback: ( pageNum ) => this.pageNum = (pageNum - 1),
            maxVisibleElements: 10
        });
        // ---------------------------------------------------------------------
        await this.getData();
        this.makePagination();
    },

    /**
     * Construye la paginacion
    */
    makePagination( page = null ) {
        this.pagination.make(this.__data.length, this.pageSize);
        if (page === null) {
            this.pageNum = 0
        } else {
            this.pagination.goToPage(page);
        }
    },

    /**
     * Obtinene la informacion de la grilla
    */
    async getData() {
        try {
            const data = await getAllRequisiciones();
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

    page() {
        const start = (this.pageNum * this.pageSize);
        const end = start + this.pageSize;

        return this.__data.slice(start, end);
    },

    /**
     * Despacha el evento para ver la informacion de la requisicion.
    */
    verRequisicion( r ) {
        this.$dispatch("ver-requisicion", r.id);
    },
});
