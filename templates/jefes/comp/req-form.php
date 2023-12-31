<div
x-data="ReqForm"
x-cloak x-transition.opacity
x-show="showForm" x-bind="events"
style="padding-bottom: 50px;"
class="fixed-top bg-black bg-opacity-50 vh-100 vw-100 flex overflow-auto">
  <template x-teleport="#buttons-container">
    <button
    type="button"
    @click="openForm(null)"
    class="btn btn-sm btn-warning shadow">
      Formulario Requisici&oacute;n
    </button>
  </template>

  <form
  @submit.prevent="save"
  class="small d-flex flex-column rounded overflow-auto mx-auto mt-4 mb-auto" style="
    width: 600px;
  ">
    <section class="bg-primary p-2">
      <span class="text-light fw-bold ms-3">
        Solicitar Nueva Requisici&oacute;n
      </span>
      <button
      @click="closeForm"
      type="button"
      class="btn btn-sm btn-close btn-close-white float-end"></button>
    </section>

    <section class="d-flex bg-secondary p-2 text-light small">
      <div class="flex-grow-1">
        <h6 class="fw-bold text-warning m-0">Información General</h6>
        <span class="opacity-75 small">
          Todos los campos con (*) son requeridos.
        </span>
      </div>
      <template x-if="isEdit">
        <button
        @click="$dispatch('ver-requisicion', state.id)"
        type="button"
        class="btn btn-sm btn-warning">
          Ver requisici&oacute;n
        </button>
      </template>
    </section>

    <section class="p-3 overflow-auto bg-light-subtle small">
      <div class="mb-2 row g-0">
        <div class="ps-0 p-1 col-md-9 position-relative">
          <label for="cargo" class="form-label small mb-0">Cargo*:</label>
          <div class="d-flex gap-2">
            <?= $this->fetch("./jefes/comp/sugerencias.php") ?>
            <?= $this->fetch("./jefes/comp/plantillas.php") ?>
          </div>
        </div>
        <div class="pe-0 p-1 col-md-3">
          <label for="cantidad" class="form-label small mb-0">Cantidad*:</label>
          <input
          min="1"
          required
          type="number"
          placeholder="Ej: 1"
          x-model.number="state.cantidad"
          class="form-control form-control-sm" id="cantidad">
        </div>
      </div>

      <div class="mb-2">
        <label for="motivo" class="form-label small mb-0">Motivo*:</label>
        <select
        id="motivo"
        x-model="state.motivo"
        required
        class="form-select form-select-sm mb-1">
          <option value="" hidden>-- Selecciona --</option>
          <?php foreach(\App\Enums\Motivo::all() as $key => $value): ?>
            <option value="<?= $key ?>"> <?= $value ?> </option>
          <?php endforeach ?>
        </select>
        <?= $this->fetch("./partials/textarea-counter.php", [ "id" => "#motivo_desc"]) ?>
        <textarea
        required
        type="text"
        @input="resizeTextarea"
        maxlength="200"
        placeholder="Describe un poco el motivo..."
        x-model="state.motivo_desc"
        class="form-control form-control-sm" id="motivo_desc"></textarea>
      </div>

      <div class="mb-2">
        <label for="tipo" class="form-label small mb-0">Tipo de Vinculadci&oacute;n*:</label>
        <select
        id="tipo"
        x-model="state.tipo"
        required
        class="form-select form-select-sm">
          <option value="" hidden>-- Selecciona --</option>
          <?php foreach(\App\Enums\Tipo::all() as $key => $value): ?>
            <option value="<?= $key ?>"> <?= $value ?> </option>
          <?php endforeach ?>
        </select>
      </div>

      <div class="mb-2">
        <?= $this->fetch("./jefes/comp/horario.php") ?>
        <div>
          <label for="horas" class="form-label small mb-0">Horas Semanales*:</label>
          <input
          type="number"
          min="0"
          id="horas"
          required
          placeholder="Ej: 47"
          x-model.number="state.horas"
          class="form-control form-select-sm">
        </div>
      </div>

      <div class="mb-2">
        <label for="conocimientos" class="form-label small mb-0">
          Conocimientos*:
        </label>
        <?= $this->fetch("./partials/textarea-counter.php", [ "id" => "#conocimientos"]) ?>
        <textarea
        id="conocimientos"
        @input="resizeTextarea"
        x-model="state.conocimientos"
        required
        maxlength="850"
        placeholder="Describe los conocimientos necesarios para el cargo..."
        class="form-control form-control-sm"
        ></textarea>
      </div>

      <div class="mb-2">
        <label class="form-label mb-0 small text-muted" for="funciones">
          Funciones
        </label>
        <?= $this->fetch("./partials/textarea-counter.php", [ "id" => "#funciones"]) ?>
        <textarea
        id="funciones"
        maxlength="850"
        @input="resizeTextarea"
        x-model="state.funciones"
        placeholder="Si quieres, escribe las principales funciones del cargo..."
        class="form-control form-control-sm"
        ></textarea>
      </div>

      <div class="mb-2">
        <label class="form-label mb-0 small text-muted" for="funciones">
          Observaci&oacute;n:
        </label>
        <?= $this->fetch("./partials/textarea-counter.php", [ "id" => "#observacion"]) ?>
        <textarea
        id="observacion"
        maxlength="280"
        @input="resizeTextarea"
        x-model="state.observacion"
        placeholder="Deja una observaci&oacute;n"
        class="form-control form-control-sm"
        ></textarea>
      </div>
    </section>

    <section class="bg-secondary d-flex justify-content-end p-2">
      <button
      type="submit"
      class="btn btn-sm btn-warning">Solicitar</button>
    </section>
  </form>
</div>
