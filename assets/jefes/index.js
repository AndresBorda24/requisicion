import "@/css/root.css";
import Alpine from "alpinejs";
import form from "./comp/form";
import obs from "@/partials/obs";
import grilla from "./comp/grilla";
import ver from "@/partials/ver-req";
import "@/partials/global-helpers.js";

document.addEventListener("alpine:init", () => {
    Alpine.data("Obs", obs);
    Alpine.data("ReqForm", form);
    Alpine.data("GrillaJefes", grilla);
    Alpine.data("VerRequisicion", ver);
});

document.addEventListener("DOMContentLoaded", Alpine.start);

window.Alpine = Alpine;
