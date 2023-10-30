import { notyCambioEstado } from "@/requests/RequisicionRequests";


export default () => ({
    events: {
        "@new-requisicion.document": "triggerNoti($event.detail)",
        "@updated-state.document": "triggerNoti($event.detail)",
        "@updated-th.document": "triggerNoti($event.detail)"
    },

    async triggerNoti({ id }) {
        // const [data, error] = await notyCambioEstado(id);
        // if (error) {
        //     console.error("Notificaciones: ", error);
        // }
        // if (data) {
        //     console.log(data);
        // }
    }
});
