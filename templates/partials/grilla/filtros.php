<details
x-data="GrillaFiltros"
@click.outside="$el.removeAttribute('open')"
class="position-relative">
  <summary
  role="button"
  title="Filtros"
  class="d-block btn btn-outline-warning btn-small lh-1 p-1">
    <?= $this->fetch("./icons/wrench.php") ?>
    <span class="small d-none d-lg-inline-block">Filtros</span>
  </summary>
  <div
  style="width: 250px;"
  class="text-bg-secondary position-absolute rounded-1 top-100 end-0 p-2 shadow mt-1 border border-warning-subtle">
    <div class="mb-2 small">
      <label for="filter-state" class="form-label m-0">Estado:</label>
      <select x-model="filters.state" id="filter-state"
      class="bg-opacity-10 bg-white border-opacity-25 border-white form-select form-select-sm text-light text-uppercase">
        <option value="" class="text-dark">Todos</option>
        <?php foreach (\App\Enums\Estados::all() as $key => $value): ?>
          <option value="<?= $key ?>" class="text-dark"><?= $value ?></option>
        <?php endforeach ?>
      </select>
    </div>

    <div class="mb-2 small">
      <label for="filter-by" class="form-label m-0">Por:</label>
      <select x-model="filters.by" id="filter-by"
      class="bg-opacity-10 bg-white border-opacity-25 border-white form-select form-select-sm text-light text-uppercase">
        <option value="" class="text-dark">Todos</option>
        <?php foreach (\App\Enums\UserTypes::all() as $key => $value): ?>
          <option value="<?= $key ?>" class="text-dark"><?= $value ?></option>
        <?php endforeach ?>
      </select>
    </div>

    <?php if($user->getUserType() !== \App\Enums\UserTypes::JEFE): // Solo si es la vista de TH  ?>
    <div class="mb-2 small">
      <label for="filter-area" class="form-label m-0">&Aacute;rea:</label>
      <select x-model="filters.area" id="filter-area"
      class="bg-opacity-10 bg-white border-opacity-25 border-white form-select form-select-sm text-light text-uppercase">
        <option value="" class="text-dark">Todas</option>
        <template x-for="area in areas()" :key="area.id">
          <option :value="area.id" x-text="area.nombre" class="text-dark"></option>
        </template>
      </select>
    </div>
    <?php endif ?>

    <div class="mb-2 small">
      <label for="filter-cargo" class="form-label m-0">Cargo:</label>
      <input
      x-model.debounce.600="filters.cargo"
      type="text" id="filter-cargo"
      @keyup="$el.value = $el.value.toUpperCase()"
      class="bg-opacity-10 bg-white border-opacity-25 border-white form-control form-control-sm text-light text-uppercase">
    </div>

    <button
    @click="resetFilters"
    class="btn btn-sm small text-decoration-underline text-light fw-light">
      Limpiar filtros
    </button>
  </div>
</details>
