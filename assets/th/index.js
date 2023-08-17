import "@/css/root.css";
import Alpine from "alpinejs";
import grilla from "./comp/grilla"
import ver from "@/partials/ver-req";
import "@/partials/global-helpers.js";

document.addEventListener("alpine:init", () => {
    Alpine.data("GrillaTh", grilla);
    Alpine.data("VerRequisicion", ver);
});

document.addEventListener("DOMContentLoaded", Alpine.start);

window.Alpine = Alpine;
