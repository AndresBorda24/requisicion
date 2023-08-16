<div class="p-3 small" x-show="tab === 2">
  <form @submit.prevent>
    <div class="mb-2">
      <label for="educacion" class="form-label small">Educaci&oacute;n*:</label>
      <select
      id="educacion"
      required
      class="form-select form-select-sm">
        <option value="" hidden>-- Selecciona --</option>
        <?php foreach(\App\Enums\NivelEducativo::all() as $key => $value): ?>
          <option value="<?= $key ?>"> <?= $value ?> </option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="mb-2">
      <div class="row g-0 mb-2">
        <div class="col-8 p-1">
          <label for="sector" class="form-label small">Sector*:</label>
          <input
          type="text"
          placeholder="Ej: TI"
          id="sector"
          minlength="2"
          class="form-control form-control-sm">
        </div>
        <div class="col-4 p-1">
          <label for="sector_anios" class="form-label small">A&ntilde;os*:</label>
          <input
          type="number"
          min="0"
          id="sector_anios"
          class="form-control form-control-sm">
        </div>
      </div>

      <div class="row g-0">
        <div class="col-8 p-1">
          <label for="area" class="form-label small">&Aacute;rea*:</label>
          <input
          type="text"
          id="area"
          placeholder="Ej: Desarrollo web"
          minlength="2"
          class="form-control form-control-sm">
        </div>
        <div class="col-4 p-1">
          <label for="area_anios" class="form-label small">A&ntilde;os*:</label>
          <input
          type="number"
          min="0"
          id="area_anios"
          class="form-control form-control-sm">
        </div>
      </div>
    </div>
    <button class="btn btn-warning btn-sm d-block mx-auto">
      Guardar!
    </button>
  </form>
</div>
