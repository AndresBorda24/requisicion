<div
x-data="ReqForm"
x-cloak x-transition.opacity
x-show="showForm"
class="fixed-top bg-black bg-opacity-50 vh-100 vw-100 flex">
  <template x-teleport="#buttons-container">
    <button
    type="button"
    @click="openForm"
    class="btn btn-sm btn-warning">
      Formulario Requisici&oacute;n
    </button>
  </template>


  <form
  @submit.prevent="save"
  class="small d-flex flex-column rounded overflow-auto" style="
    max-height: 80vh;
    max-width: 800px;
    margin: 10% auto;
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

    <section class="bg-secondary p-2 text-light small">
      <h6 class="fw-bold text-warning m-0">Información General</h6>
      <span class="opacity-75 small">
        Todos los campos con (*) son requeridos.
      </span>
    </section>

    <section class="p-3 overflow-auto bg-light-subtle small">
      <div class="mb-2 row g-0">
        <div class="p-1 col-md-9">
          <label for="cargo" class="form-label small">Cargo*:</label>
          <input
          type="text"
          required
          placeholder="Ej: Auxiliar de Sistemas"
          x-model="state.cargo"
          class="form-control form-control-sm" id="cargo">
        </div>
        <div class="p-1 col-md-3">
          <label for="cantidad" class="form-label small">Cantidad*:</label>
          <input
          min="1"
          required
          type="number"
          placeholder="Ej: 1"
          x-model="state.cantidad"
          class="form-control form-control-sm" id="cantidad">
        </div>
      </div>

      <div class="mb-2 d-flex gap-2">
        <div class="flex-grow-1">
          <label for="motivo" class="form-label small">Motivo*:</label>
          <select
          id="motivo"
          x-model="state.motivo"
          required
          class="form-select form-select-sm">
            <option value="" hidden>-- Selecciona --</option>
            <?php foreach(\App\Enums\Motivo::all() as $key => $value): ?>
              <option value="<?= $key ?>"> <?= $value ?> </option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="flex-grow-1">
          <label for="tipo" class="form-label small">Tipo*:</label>
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
      </div>

      <div class="mb-2">
        <div class="mb-2">
          <label for="horario" class="form-label small">Horario*:</label>
          <input
          type="text"
          id="horario"
          required
          x-model="state.horario"
          class="form-control form-select-sm">
        </div>

        <div>
          <label for="horas" class="form-label small">Horas Semanales*:</label>
          <input
          type="number"
          min="0"
          id="horas"
          required
          placeholder="Ej: 47"
          x-model="state.horas"
          class="form-control form-select-sm">
        </div>
      </div>

      <div class="mb-2">
        <label for="conocimientos" class="form-label small">
          Conocimientos*:
        </label>
        <textarea
        id="conocimientos"
        style="height: 100px;"
        x-model="state.conocimientos"
        required
        placeholder="Describe los conocimientos necesarios para el cargo..."
        class="form-control form-control-sm"
        ></textarea>
      </div>

      <div class="mb-2">
        <label class="form-label small text-muted" for="funciones">
          Funciones
        </label>
        <textarea
        id="funciones"
        style="height: 100px;"
        x-model="state.funciones"
        placeholder="Si quieres, escribe las principales funciones del cargo..."
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
