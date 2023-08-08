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
  class="small m-auto d-flex flex-column rounded overflow-auto" style="
    width: 70vw;
    height: 80vh;
    max-width: 800px;
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

    <section class="p-3 flex-grow-1 overflow-auto bg-body small text-primary-emphasis">
      <p class="text-muted small">
        Todos los campos con (*) son requeridos.
      </p>

      <h6>Informaci&oacute;n General</h6>
      <div class="mb-2 row g-0">
        <div class="p-1 col-md-9">
          <label for="cargo" class="form-label text-muted small">Cargo*:</label>
          <input
          type="text"
          required
          placeholder="Auxiliar de Sistemas"
          x-model="state.cargo"
          class="form-control form-control-sm" id="cargo">
        </div>
        <div class="p-1 col-md-3">
          <label for="cantidad" class="form-label text-muted small"># Cargos*:</label>
          <input
          min="1"
          required
          type="number"
          x-model="state.cantidad"
          class="form-control form-control-sm" id="cantidad">
        </div>
      </div>

      <div class="mb-2 row row-cols-1 row-cols-md-2 g-0">
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

      <div class="mb-4 row row-cols-1 row-cols-md-2 g-0">
        <div class="p-1">
          <label for="horario" class="form-label text-muted small">Horario*:</label>
          <input
          type="text"
          id="horario"
          required
          x-model="state.horario"
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
          class="form-control form-select-sm">
        </div>
      </div>

      <h6>Cargo Nuevo</h6>
      <div class="mb-2">
        <label class="form-label text-muted small" for="nivel_educativo">
          Educaci&oacute;n en (Nivel Acad&eacute;mico):
        </label>
        <select
        x-model="state.nivel_educativo"
        class="form-select form-select-sm"
        id="nivel_educativo"
        required>
          <option selected="" hidden="" value="">-- Seleccionar --</option>
          <option value="BACHILLER">Bachiller</option>
          <option value="TECNICO">Técnico</option>
          <option value="TECNOLOGO">Tecnólogo</option>
          <option value="PROFESIONAL">Profesional</option>
          <option value="ESPECIALIZACION">Especialización</option>
        </select>
      </div>

      <div class="mb-4">
        <label for="conv-conocimientos"
        class="form-label small text-muted">Conocimientos:</label>
        <textarea
        x-model="state.conocimientos"
        id="conv-conocimientos"
        style="height: 110px;"
        class="form-control form-control-sm"
        placeholder="Detalla los conocimientos necesarios..."></textarea>
      </div>


      <h6>Experiencia Laboral</h6>
      <div class="mb-2 row g-0">
        <div class="p-1 col-12 col-md-7">
          <label for="sector" class="form-label text-muted small">Sector*:</label>
          <input
          type="text"
          id="sector"
          x-model="state.sector"
          required
          class="form-control form-control-sm">
        </div>

        <div class="p-1 col-12 col-md-5">
          <label for="sector_anios" class="form-label text-muted small">A&ntilde;os*:</label>
          <input
          min="0"
          required
          type="number"
          id="sector_anios"
          x-model="state.sector_anios"
          class="form-control form-control-sm">
        </div>
      </div>

      <div class="mb-2 row g-0">
        <div class="p-1 col-12 col-md-7">
          <label for="area" class="form-label text-muted small">Area*:</label>
          <input
          id="area"
          required
          type="text"
          x-model="state.area"
          class="form-control form-control-sm">
        </div>

        <div class="p-1 col-12 col-md-5">
          <label for="area_anios" class="form-label text-muted small">A&ntilde;os*:</label>
          <input
          min="0"
          required
          type="number"
          id="area_anios"
          x-model="state.area_anios"
          class="form-control form-control-sm">
        </div>
      </div>

      <div class="mb-4">
        <label class="form-label small text-muted" for="funciones">
          Funciones principales del cargo
        </label>
        <textarea
        required
        id="funciones"
        style="height: 110px;"
        x-model="state.funciones"
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
