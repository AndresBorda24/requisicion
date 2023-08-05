import {Tabulator, FormatModule, InteractionModule} from 'tabulator-tables';

Tabulator.registerModule([FormatModule, InteractionModule]);

export default () => ({
    /** @var Tabulator */
    grilla: undefined,
    grillaData: [],

    init() {
        this.grilla = new Tabulator("#grilla-jefes", {
            data: this.grillaData,
            layout: "fitColumns",
            columns:[
                {title:"Name", field:"name", width:150},
                {title:"Age", field:"age", hozAlign:"left", formatter:"progress"},
                {title:"Favourite Color", field:"col"},
                {title:"Date Of Birth", field:"dob", hozAlign:"center"},
            ],
        });

        this.grilla.on("rowClick", (e, row) => {
            alert("Row " + row.getData().id + " Clicked!!!!");
        });
    }
});
