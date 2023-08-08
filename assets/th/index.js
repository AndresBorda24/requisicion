import "@/css/root.css";
import Alpine from "alpinejs";
import ver from "./comp/ver";
import grilla from "./comp/grilla"

document.addEventListener("alpine:init", () => {
    Alpine.data("GrillaTh", grilla);
    Alpine.data("VerRequisicion", ver);
});

document.addEventListener("DOMContentLoaded", Alpine.start);

window.Alpine = Alpine;
