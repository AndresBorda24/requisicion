import { getSimilar } from "@/requests/RequisicionRequests";

export default () => ({
    list: [],

    init() {
        this.$watch("state.cargo", (val) => (val === "")
            ?  false
            : this.findSimilar(val)
        );
        this.$watch("state.id", (val) => this.list = []);
    },

    get total() {
        return this.list.length;
    },

    async findSimilar() {
        const [error, data] = await getSimilar(this.state.cargo);

        this.list = Boolean(error) ? [] : data;
    },

    cargar( index ) {
        this.state.cargo = this.list[ index ].cargo;
        this.state.tipo = this.list[ index ].tipo;
        this.state.horas = this.list[ index ].horas;
        this.state.motivo = this.list[ index ].motivo;
        this.state.horario = this.list[ index ].horario;
        this.state.director = this.list[ index ].director;
        this.state.cantidad = this.list[ index ].cantidad;
        this.state.funciones = this.list[ index ].funciones;
        this.state.motivo_desc = this.list[ index ].motivo_desc;
        this.state.conocimientos = this.list[ index ].conocimientos;
    }
});
