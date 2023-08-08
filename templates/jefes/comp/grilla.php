<div x-data="GrillaJefes" x-bind="grillaEvents">
  <div id="grilla-jefes" class="shadow rounded"></div>
  <div class="table-responsive-md">
    <table class="table table-sm table-bordered table-hover">
      <thead>
        <tr>
          <th>Cargo</th>
          <th>Fecha Solicitud</th>
          <th>Estado</th>
          <th></th>
        </tr>
      </thead>

      <tbody class="small">
        <template x-for="r in grillaData">
          <tr class="small align-middle position-relative">
            <td x-text="r.cargo" style="white-space: nowrap;"></td>
            <td x-text="r.created_at"></td>
            <td x-text="r.state"></td>
            <td class="position-sticky end-0">
              <button
              class="btn btn-sm btn-warning"
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
