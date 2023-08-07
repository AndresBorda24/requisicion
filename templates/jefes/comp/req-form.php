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


  <form class="m-auto d-flex flex-column rounded overflow-auto" style="
    width: 70vw;
    height: 70vh;
    max-width: 800px;
  ">
    <section class="bg-primary p-3">
      <span class="text-light fw-bold">
        Solicitar Nueva Requisici&oacute;n
      </span>
      <button
      @click="closeForm"
      type="button"
      class="btn btn-sm btn-close btn-close-white float-end"></button>
    </section>

    <section class="p-3 flex-grow-1 overflow-auto bg-body small">
      <p class="text-muted small">
        Todos los campos con (*) son requeridos.
      </p>

      <h6 class="border-bottom">Informaci&oacute;n General</h6>
      <div class="mb-3">
        <label for="cargo" class="form-label text-muted small">Cargo*:</label>
        <input
        type="text"
        required
        placeholder="Auxiliar de Sistemas"
        x-model="state.cargo"
        class="form-control form-control-sm" id="cargo">
      </div>

      <div class="mb-3 row row-cold-1 row-cols-md-2 g-0">
        <div class="p-1">
          <label for="motivo" class="form-label text-muted small">Motivo*:</label>
          <select
          id="motivo"
          x-model="state.motivo"
          required
          class="form-select form-select-sm">
            <option value="" hidden>-- Selecciona --</option>
            <option value="creacion">Creaci&oacute;n</option>
            <option value="retiro">Retiro</option>
            <option value="licvac">Lic. Vac.</option>
            <option value="traslado">Traslado</option>
          </select>
        </div>

        <div class="p-1">
          <label for="tipo" class="form-label text-muted small">Tipo*:</label>
          <select
          id="tipo"
          x-model="state.tipo"
          required
          class="form-select form-select-sm">
            <option value="" hidden>-- Selecciona --</option>
            <option value="direct">Directa con Cl&iacute;nica</option>
            <option value="temp">Temporal</option>
            <option value="outsourcing">Outsourcing</option>
            <option value="aprendiz">Contrato de Aprendizaje</option>
            <option value="mandato">Contrato de Mandato</option>
          </select>
        </div>
      </div>

      <div class="mb-4 row row-cold-1 row-cols-md-2 g-0">
        <div class="p-1">
          <label for="horario" class="form-label text-muted small">Horario*:</label>
          <input
          type="text"
          id="horario"
          requried
          x-model="state.horario"
          placeholder="Lunes - Viernes"
          class="form-control form-select-sm">
        </div>

        <div class="p-1">
          <label for="horas" class="form-label text-muted small">Horas Semanales*:</label>
          <input
          type="number"
          min="0"
          id="horas"
          required
          x-model="state.horas"
          placeholder="48"
          class="form-control form-select-sm">
        </div>
      </div>

      <h6 class="border-bottom">Cargo Nuevo</h6>
      <select
      x-model="state.nivel_educativo"
      class="form-select form-select-sm mb-2"
      id="conv-nivel-educativo"
      required>
        <option selected="" hidden="" value="">-- Seleccionar --</option>
        <option value="BACHILLER">Bachiller</option>
        <option value="TECNICO">Técnico</option>
        <option value="TECNOLOGO">Tecnólogo</option>
        <option value="PROFESIONAL">Profesional</option>
        <option value="ESPECIALIZACION">Especialización</option>
      </select>
      <div class="mb-3">
        <label for="conv-conocimientos"
        class="form-label small text-muted">Conocimientos:*</label>
        <textarea
        x-model="state.conocimientos"
        id="conv-conocimientos"
        class="form-control form-control-sm"
        required=""
        style="height: 150px;"></textarea>
      </div>


    </section>

    <section class="bg-secondary d-flex justify-content-end p-2">
      <button class="btn btn-sm btn-warning">Solicitar</button>
    </section>
  </form>
</div>
