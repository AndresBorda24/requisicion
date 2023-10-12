<div
class="bg-body border overflow-auto position-relative rounded shadow-sm table-responsive-md z-0"
style="height: 500px;">
  <table class="table table-sm table-striped-columns table-hover m-0">
    <thead class="sticky-top">
      <tr class="align-middle small position-relative">
        <th class="px-2 text-bg-primary">#</th>
        <th class="px-2 text-bg-primary">&Aacute;rea</th>
        <th class="px-2 text-bg-primary" style="width: 30%;">Cargo</th>
        <th @click="sort('created_at', $el)" data-dir="true" role="button"
        class="text-nowrap px-2 text-bg-primary">Fecha Solicitud</th>
        <th class="px-2 text-bg-primary" style="min-width: 120px;"> Estado </th>
        <th class="text-bg-primary position-sticky end-0">
          <?= $this->fetch("./partials/grilla/filtros.php") ?>
        </th>
      </tr>
    </thead>

    <tbody class="small">
      <template x-if="noData">
        <tr>
          <td
          class="table-warning p-4 text-center align-middle"
          colspan="6">
            Parece que no hay requisiciones...
          </td>
        </tr>
      </template>

      <template x-for="r in filtered" :key="r.id">
        <?= $this->fetch("./partials/grilla/item.php") ?>
      </template>
    </tbody>
  </table>
</div>
