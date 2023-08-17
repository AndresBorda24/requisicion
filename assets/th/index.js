import "@/css/root.css";
import ver from "@/partials/ver-req";
import Alpine from "alpinejs";
import grilla from "./comp/grilla"
import updateReq from "./comp/update-req";
import "@/partials/global-helpers.js";

document.addEventListener("alpine:init", () => {
    Alpine.data("GrillaTh", grilla);
    Alpine.data("VerRequisicion", ver);
    Alpine.data("UpdateRequisicion", updateReq);
});

document.addEventListener("DOMContentLoaded", Alpine.start);

window.Alpine = Alpine;
