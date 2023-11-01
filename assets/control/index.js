import "@/css/root.css";
import Alpine from "alpinejs";
import obs from "@/partials/obs";
import obsList from "@/partials/obs-list";
import grilla from "./comp/grilla";
import ver from "@/partials/ver-req";

import "@/stores/meta-store";
import "@/stores/auth-store";
import "@/partials/global-helpers.js";

document.addEventListener("alpine:init", () => {
    Alpine.data("Obs", obs);
    Alpine.data("ObsList", obsList);
    Alpine.data("GrillaControl", grilla);
    Alpine.data("VerRequisicion", ver);
});

document.addEventListener("DOMContentLoaded", Alpine.start);

window.Alpine = Alpine;
