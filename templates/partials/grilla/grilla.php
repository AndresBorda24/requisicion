<div
class="table-responsive-md position-relative overflow-auto shadow z-0"
style="max-height: 500px;">
  <table class="table table-sm table-bordered table-hover m-0">
    <thead class="sticky-top" style="top: -1px;">
      <tr class="align-middle small">
        <th class="px-2 text-bg-primary">#ID</th>
        <th class="px-2 text-bg-primary">&Aacute;rea</th>
        <th class="px-2 text-bg-primary" style="width: 30%;">Cargo</th>
        <th class="text-nowrap px-2 text-bg-primary">Fecha Solicitud</th>
        <th class="px-2 text-bg-primary" style="min-width: 120px;">
          Estado
        </th>
        <th class="text-bg-primary"></th>
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

      <template x-for="r in grillaData" :key="r.id">
        <?= $this->fetch("./partials/grilla/item.php") ?>
      </template>
    </tbody>
  </table>
</div>
