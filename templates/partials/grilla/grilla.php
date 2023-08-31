<div
class="table-responsive-md position-relative overflow-auto shadow z-0"
style="max-height: 500px;">
  <table class="table table-sm table-striped table-bordered table-hover m-0">
    <thead class="sticky-top" style="top: -1px;">
      <tr class="align-middle small">
        <th class="px-2">#ID</th>
        <th class="px-2">&Aacute;rea</th>
        <th class="px-2" style="width: 30%;">Cargo</th>
        <th class="text-nowrap px-2">Fecha Solicitud</th>
        <th class="px-2" style="min-width: 120px;">
          <select
          @change="getData"
          x-model="grillaState"
          class="form-select form-select-sm m-0">
            <?php foreach(\App\Enums\Estados::all() as $key => $value): ?>
              <option value="<?= $key ?>"> <?= $value ?> </option>
            <?php endforeach ?>
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

      <template x-for="r in grillaData" :key="r.id">
        <tr class="small align-middle position-relative">
          <td x-text="r.id" style="white-space: nowrap;"></td>
          <td x-text="r.area_nombre" style="white-space: nowrap;"></td>
          <td x-text="r.cargo" class="text-nowrap"></td>
          <td x-text="r.created_at"></td>
          <td x-html="r.state"></td>
          <td class="position-sticky end-0">
            <button
            class="btn btn-sm btn-warning py-0"
            @click="verRequisicion( r )"
            type="button">
              <span class="small">Ver</span>
            </button>
          </td>
        </tr>
      </template>
    </tbody>
  </table>
</div>
