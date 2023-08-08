<div x-data="GrillaTh">
  <div
  class="table-responsive-md position-relative overflow-auto shadow z-0"
  style="max-height: 500px;">
    <table class="table table-sm table-striped table-hover m-0">
      <thead class="sticky-top">
        <tr class="align-middle">
          <th>&Aacute;rea</th>
          <th style="width: 30%;">Cargo</th>
          <th>Fecha Solicitud</th>
          <th>
            <select
            @change="getData"
            x-model="grillaState"
            class="form-select form-select-sm m-0">
              <option value="PENDIENTE">Pendientes</option>
              <option value="RECHAZADA">Rechazadas</option>
            </select>
          </th>
          <th></th>
        </tr>
      </thead>

      <tbody class="small">
        <template x-if="noData">
          <tr>
            <td
            class="table-warning p-4 text-center align-middle"
            colspan="5">
              Parece que no hay requisiciones...
            </td>
          </tr>
        </template>


        <template x-for="r in grillaData">
          <tr class="small align-middle position-relative">
            <td x-text="r.area_nombre" style="white-space: nowrap;"></td>
            <td x-text="r.cargo"></td>
            <td x-text="r.created_at"></td>
            <td x-text="r.state"></td>
            <td class="position-sticky end-0">
              <button
              class="btn btn-sm btn-warning py-0"
              @click="console.log(r)"
              type="button">
                <span class="small">Ver</span>
              </button>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</div>
