import { getAreas } from "@/requests/ExtraRequests";

export default () => ({
    async areas() {
        return await getAreas();
    },

    resetFilters() {
        this.filters = {
            area: "",
            cargo: "",
            state: "",
            by: ""
        };
    }
});
