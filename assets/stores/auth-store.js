import Alpine from "alpinejs";
import { getAuthInfo } from "@/requests/ExtraRequests";

document.addEventListener("alpine:init", () => {
    Alpine.store("AUTH", {
        _: {},

        /** @param {String} key */
        get( key ) {
            if (! this._.hasOwnProperty(key)) return undefined;

            return this._[ key ];
        },

        async fetchInfo() {
           try {
                this._ = await getAuthInfo();
           } catch(e) {
                // Por hacer
           }
        }
    });
});

document.addEventListener('alpine:init', async () => {
    await Alpine.store("AUTH").fetchInfo();
});
