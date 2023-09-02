<details x-data="GrillaFiltros" class="position-relative">
  <summary
  role="button"
  title="Filtros"
  class="d-block btn btn-outline-warning btn-small lh-1 p-1">
    <?= $this->fetch("./icons/wrench.php") ?>
    <span class="small">Filtros</span>
  </summary>
  <div
  style="width: 250px; outline: 2px solid #bceeff;"
  class="text-dark position-absolute rounded top-100 end-0 p-2 border shadow bg-body-tertiary mt-1">
    <div class="mb-2 small">
      <label for="filter-state" class="form-label m-0">Estado:</label>
      <select x-model="filters.state" id="filter-state" class="form-select form-select-sm">
        <option value="">Todos</option>
        <?php foreach (\App\Enums\Estados::all() as $key => $value): ?>
          <option value="<?= $key ?>"><?= $value ?></option>
        <?php endforeach ?>
      </select>
    </div>

    <?php if($this->isRoute("req.th")): // Solo si es la vista de TH  ?>
    <div class="mb-2 small">
      <label for="filter-area" class="form-label m-0">&Aacute;rea:</label>
      <select x-model="filters.area" id="filter-area" class="form-select form-select-sm">
        <option value="">Todas</option>
        <template x-for="area in areas()" :key="area.id">
          <option :value="area.id" x-text="area.nombre"></option>
        </template>
      </select>
    </div>
    <?php endif ?>

    <div class="mb-2 small">
      <label for="filter-cargo" class="form-label m-0">Cargo:</label>
      <input x-model.lazy="filters.cargo" type="text" id="filter-cargo" class="form-control form-control-sm">
    </div>
  </div>
</details>
