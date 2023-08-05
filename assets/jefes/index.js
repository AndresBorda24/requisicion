import "@/css/root.css";
import Alpine from "alpinejs";
import grilla from "./comp/grilla";

document.addEventListener("alpine:init", () => {
    Alpine.data("GrillaJefes", grilla);
});

document.addEventListener("DOMContentLoaded", () => {
    Alpine.start();
})
