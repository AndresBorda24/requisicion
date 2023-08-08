import AWN from "awesome-notifications";

const ALERTS = new AWN({
    position: "top-right",
    labels: {
        success: "Hecho!",
        warning: "Hey!"
    }
})

export function errorAlert(message = "Ha ocurrido un error!") {
    ALERTS.alert(message);
}

export function successAlert(message = "Hecho!") {
    ALERTS.success(message);
}
