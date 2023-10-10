import Alpine from "alpinejs";
import { getMetaInfo } from "@/requests/ExtraRequests";

document.addEventListener("alpine:init", () => {
    Alpine.store("META", {
        _: {},

        /** @param {String} key */
        get( key ) {
            if (!this._ || ! this._.hasOwnProperty(key)) return undefined;

            return this._[ key ];
        },

        async fetchInfo() {
            const [data, err] = await getMetaInfo();
            if (err) return;

            this._ = data;
        }
    });
});

document.addEventListener('alpine:init', async () => {
    await Alpine.store("META").fetchInfo();
});
