import "@/css/root.css";
import Alpine from "alpinejs";
import form from "./comp/form";
import grilla from "./comp/grilla";
import ver from "@/partials/ver-req";

document.addEventListener("alpine:init", () => {
    Alpine.data("ReqForm", form);
    Alpine.data("GrillaJefes", grilla);
    Alpine.data("VerRequisicion", ver);
});

document.addEventListener("DOMContentLoaded", Alpine.start);

window.Alpine = Alpine;
