import { getAreas } from "@/requests/ExtraRequests";

export default () => ({
    async areas() {
        return await getAreas();
    }
});
