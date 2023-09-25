<div
class="small"
x-data="UpdateRequisicion"
x-transition:enter.delay.80ms
x-show="tab === 2">
  <template x-if="! canUpdate()">
    <article class="p-3 text-center text-bg-success fs-6">
      Ya se han establecido los parametros referentes a TH. Para revisarlos mira
      la pesta&ntilde;a <span class="badge text-bg-warning rounded-5">Info</span>.
      <br><?= $this->fetch("./icons/hand-peace.php", [ "x" => 30 ]) ?>
    </article>
  </template>

  <template x-if="canUpdate">
    <section>
      <article class="bg-danger-subtle border border-danger fs-6 m-2 p-3 rounded shadow text-center">
        Aviso: Una vez guardado, no se podr&aacute; modificar y el estado de la
        requisici&oacute;n pasar&aacute; automaticamente a "Aprobado por TH".
      </article>

      <form class="p-3" @submit.prevent="save">
        <div class="mb-2">
          <label for="educacion" class="form-label small">Educaci&oacute;n*:</label>
          <select
          id="educacion"
          required
          :disabled="! canUpdate"
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
              :readonly="! canUpdate"
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
              :readonly="! canUpdate"
              x-model="state.sector_anios"
              min="0"
              id="sector_anios"
              required
              class="form-control form-control-sm">
            </div>
          </div>

          <div class="row g-0 mb-2">
            <div class="col-8 p-1">
              <label for="area" class="form-label small">&Aacute;rea*:</label>
              <input
              type="text"
              :readonly="! canUpdate"
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
              :readonly="! canUpdate"
              min="0"
              x-model="state.area_anios"
              id="area_anios"
              required
              class="form-control form-control-sm">
            </div>
          </div>

          <div class="mb-2">
            <label class="form-label mb-0 small text-muted" for="th-observacion">
              Observaci&oacute;n:
            </label>
            <textarea
            id="th-observacion"
            maxlength="280"
            style="height: 100px;"
            x-model="state.observacion"
            placeholder="Deja una observaci&oacute;n"
            class="form-control form-control-sm"
            ></textarea>
          </div>
        </div>
        <button
        type="submit"
        class="btn btn-warning btn-sm">
          Guardar!
        </button>
      </form>
    </section>
  </template>


</div>
