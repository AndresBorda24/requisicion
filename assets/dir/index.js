import "@/css/root.css";
import Alpine from "alpinejs";
import obs from "@/partials/obs";
import grilla from "./comp/grilla"
import ver from "@/partials/ver-req";
import obsList from "@/partials/obs-list";
import changeState from "@/partials/change-state";
import "@/partials/global-helpers.js";

import "@/stores/auth-store";

document.addEventListener("alpine:init", () => {
    Alpine.data("Obs", obs);
    Alpine.data("ObsList", obsList);
    Alpine.data("GrillaDir", grilla);
    Alpine.data("VerRequisicion", ver);
    Alpine.data("ChangeState", changeState);
});

document.addEventListener("DOMContentLoaded", Alpine.start);

window.Alpine = Alpine;
