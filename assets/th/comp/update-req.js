import { updateThRequisicion } from "@/requests/RequisicionRequests";
import { errorAlert } from "@/partials/alerts"

export default () => ({
    state: {},

    async save() {
        try {
            const data = await updateThRequisicion(this.state);

            console.log(data);
        } catch(e) {
            errorAlert(e);
        }
    }
});
