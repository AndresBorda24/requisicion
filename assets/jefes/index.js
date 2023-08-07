import "@/css/root.css";
import Alpine from "alpinejs";
import form from "./comp/form";
import grilla from "./comp/grilla";

document.addEventListener("alpine:init", () => {
    Alpine.data("ReqForm", form);
    Alpine.data("GrillaJefes", grilla);
});

document.addEventListener("DOMContentLoaded", () => {
    Alpine.start();
})
