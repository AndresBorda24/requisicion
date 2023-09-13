import { errorAlert } from "@/partials/alerts"
import { updateState } from "@/requests/RequisicionRequests";

export default () => ({
    state: {},
    radio: {
        ['x-model']: "state.state",
        ['type']: "radio",
        ['required']: true,
        ['class']: "visually-hidden"
    },
    submitButtonColor: "",
    submitButtonHtml: "Hecho!",

    init() {
        this.$watch("data.id", () => this.state = {});

        this.$watch("state.state", (v) => {
            const x = document
                .querySelector(`input[value="${v}"] + label`);

            if (x) {
                this.submitButtonHtml = x.innerHTML;
                this.submitButtonColor = x.classList.value.match(/line-(\w+)/)[1]
            };

            setTimeout(() =>
                this.$el?.querySelector("textarea")?.focus()
            , 50);
        });
    },

    async changeState() {
        const [data, error] = await updateState(this.data.id, this.state);

        if (error) errorAlert("Ha ocurrido un error.");
        console.log(data);
    }
});
