import Fuse from "fuse.js";
import cargos from "@/jefes/cargos.json";

export default () => ({
    input: "",
    sugerencias: [],
    selectedItem: 0,

    init() {
        this.$watch("sugerencias", () => this.selectedItem = 0);
        this.fuse = new Fuse(
            cargos, {
                threshold: 0.3,
                keys:["cargo"]
            }
        )
    },

    /**
     * Busca las sugerencias y las pone en un array general.
     * @param {String} value Es el termino a buscar.
    */
    searchCargo( value ) {
        this.sugerencias = this.fuse
            .search(value)
            .map(x => x.item);
    },

    /** @return {void|Boolean} */
    selectItem() {
        if (this.isEmpty) return false;

        this.input = this.sugerencias[ this.selectedItem ].cargo;
        this.state.director = this.sugerencias[ this.selectedItem ].direccion;
        this.sugerencias = [];
        setTimeout(() => document.getElementById('cargo')?.focus(), 1);
    },

    /** @return {void}*/
    goDown() {
        if (this.selectedItem < this.sugerencias.length - 1)
            this.selectedItem++;
    },

    /** @return {void} */
    goUp() {
        if (this.selectedItem > 0)
            this.selectedItem--;
    },

    get isEmpty() {
        return this.sugerencias.length === 0;
    }
});
