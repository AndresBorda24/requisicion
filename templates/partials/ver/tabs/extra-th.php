<div
class="small"
x-data="UpdateRequisicion"
data-estado-pendiente="<?= \App\Enums\Estados::SOLICITUD ?>"
x-transition:enter.delay.80ms
x-show="tab === 2">
  <article class="p-3 text-center text-bg-danger" x-show="isPendiente">
    Aviso: Una vez guardado, no se podr&aacute; modificar y el estado de la
    requisici&oacute;n pasar&aacute; automaticamente a "En revisi&oacute;n".
  </article>

  <form class="p-3" @submit.prevent="save">
    <div class="mb-2">
      <label for="educacion" class="form-label small">Educaci&oacute;n*:</label>
      <select
      id="educacion"
      required
      :disabled="! isPendiente"
      @change="updateEduText"
      x-model="state.nivel_educativo"
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
          :readonly="! isPendiente"
          x-model="state.sector"
          placeholder="Ej: TI"
          id="sector"
          required
          minlength="2"
          class="form-control form-control-sm">
        </div>
        <div class="col-4 p-1">
          <label for="sector_anios" class="form-label small">A&ntilde;os*:</label>
          <input
          type="number"
          :readonly="! isPendiente"
          x-model="state.sector_anios"
          min="0"
          id="sector_anios"
          required
          class="form-control form-control-sm">
        </div>
      </div>

      <div class="row g-0">
        <div class="col-8 p-1">
          <label for="area" class="form-label small">&Aacute;rea*:</label>
          <input
          type="text"
          :readonly="! isPendiente"
          id="area"
          required
          placeholder="Ej: Desarrollo web"
          x-model="state.area"
          minlength="2"
          class="form-control form-control-sm">
        </div>
        <div class="col-4 p-1">
          <label for="area_anios" class="form-label small">A&ntilde;os*:</label>
          <input
          type="number"
          :readonly="! isPendiente"
          min="0"
          x-model="state.area_anios"
          id="area_anios"
          required
          class="form-control form-control-sm">
        </div>
      </div>
    </div>
    <button
    x-show="isPendiente"
    type="submit"
    class="btn btn-warning btn-sm">
      Guardar!
    </button>
  </form>
</div>
