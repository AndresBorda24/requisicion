import "@/css/root.css";
import Alpine from "alpinejs";
import form from "./comp/form";
import obs from "@/partials/obs";
import grilla from "./comp/grilla";
import ver from "@/partials/ver-req";
import horarios from "./comp/horarios";
import updateReq from "@/th/comp/update-req";
import obsList from "@/partials/obs-list";
import plantillas from "./comp/plantillas";
import sugerencias from "./comp/sugerencias";
import changeState from "@/partials/change-state";

import "@/stores/meta-store";
import "@/stores/auth-store";
import "@/partials/global-helpers.js";

document.addEventListener("alpine:init", () => {
    Alpine.data("Obs", obs);
    Alpine.data("ReqForm", form);
    Alpine.data("ObsList", obsList);
    Alpine.data("Horarios", horarios);
    Alpine.data("GrillaJefes", grilla);
    Alpine.data("VerRequisicion", ver);
    Alpine.data("Sugerencias", sugerencias);
    Alpine.data("ChangeState", changeState);
    Alpine.data("ReqPlantillas", plantillas);
    Alpine.data("UpdateRequisicion", updateReq);
});

document.addEventListener("DOMContentLoaded", Alpine.start);

window.Alpine = Alpine;
