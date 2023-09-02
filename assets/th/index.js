import "@/css/root.css";
import Alpine from "alpinejs";
import obs from "@/partials/obs";
import grilla from "./comp/grilla"
import ver from "@/partials/ver-req";
import obsList from "@/partials/obs-list";
import updateReq from "./comp/update-req";
import "@/partials/global-helpers.js";

document.addEventListener("alpine:init", () => {
    Alpine.data("Obs", obs);
    Alpine.data("ObsList", obsList);
    Alpine.data("GrillaTh", grilla);
    Alpine.data("VerRequisicion", ver);
    Alpine.data("UpdateRequisicion", updateReq);
});

document.addEventListener("DOMContentLoaded", Alpine.start);

window.Alpine = Alpine;
