<div
x-data="VerRequisicion"
x-cloak
x-bind="events"
class="vh-100 vw-100 flex fixed-top bg-black bg-opacity-75 flex flex-column">
  <div class="small m-auto d-flex flex-column rounded overflow-auto" style="
    width: 70vw;
    height: 80vh;
    max-width: 800px;
  ">
    <section class="bg-primary p-2">
      <span class="text-light fw-bold ms-3">
        Requisici&oacute;n
      </span>
      <button
      @click="closeModal"
      type="button"
      class="btn btn-sm btn-close btn-close-white float-end"></button>
    </section>

    <section
    class="p-3 flex-grow-1 overflow-auto bg-body small text-primary-emphasis">
      <h6>Informaci&oacute;n General</h6>
      <div class="mb-2">
        <span for="cargo" class="d-block mb-2 form-label text-muted small">Cargo:</span>
        <span
        x-text="data.cargo"
        class="form-control form-control-sm"></span>
      </div>

      <div class="mb-2 row row-cols-1 row-cols-md-2 g-0">
        <div class="p-1">
          <span for="motivo" class="d-block mb-2 form-label text-muted small">Motivo:</span>
          <span
          x-text="data.motivo"
          class="form-control form-control-sm"></span>
        </div>

        <div class="p-1">
          <span class="d-block mb-2 form-label text-muted small">Tipo:</span>
          <span
          x-text="data.tipo"
          class="form-control form-control-sm"></span>
        </div>
      </div>

      <div class="mb-4 row row-cols-1 row-cols-md-2 g-0">
        <div class="p-1">
          <span class="d-block mb-2 form-label text-muted small">Horario:</span>
          <span
          x-text="data.horario"
          class="form-control form-control-sm"></span>
        </div>

        <div class="p-1">
          <span class="d-block mb-2 form-label text-muted small">Horas Semanales:</span>
          <span
          x-text="data.horas"
          class="form-control form-control-sm"></span>
        </div>
      </div>

      <h6>Cargo Nuevo</h6>
      <div class="mb-2">
        <span class="d-block mb-2 form-label text-muted small">
          Educaci&oacute;n en (Nivel Acad&eacute;mico):
        </span>
        <span
        x-text="data.nivel_educativo"
        class="form-control form-control-sm"></span>
      </div>

      <div class="mb-4">
        <span class="d-block mb-2 form-label text-muted small"> Conocimientos: </span>
        <span
        x-text="data.conocimientos"
        class="form-control form-control-sm"></span>
      </div>


      <h6>Experiencia Laboral</h6>
      <div class="mb-2 row g-0">
        <div class="p-1 col-12 col-md-7">
          <span class="d-block mb-2 form-label text-muted small"> Sector: </span>
          <span
          x-text="data.sector"
          class="form-control form-control-sm"></span>
        </div>

        <div class="p-1 col-12 col-md-5">
          <span class="d-block mb-2 form-label text-muted small"> A&ntilde;os: </span>
          <span
          x-text="data.sector_anios"
          class="form-control form-control-sm"></span>
        </div>
      </div>

      <div class="mb-2 row g-0">
        <div class="p-1 col-12 col-md-7">
          <span class="d-block mb-2 form-label text-muted small"> &Aacute;rea: </span>
          <span
          x-text="data.area"
          class="form-control form-control-sm"></span>
        </div>

        <div class="p-1 col-12 col-md-5">
          <span class="d-block mb-2 form-label text-muted small"> A&ntilde;os: </span>
          <span
          x-text="data.area_anios"
          class="form-control form-control-sm"></span>
        </div>
      </div>

      <div class="mb-4">
        <span class="d-block mb-2 form-label text-muted small">
          Funciones principales del cargo:
        </span>
        <span
        x-text="data.funciones"
        class="form-control form-control-sm"></span>
      </div>
    </section>

    <section class="bg-secondary p-2 text-center">
      <span class="text-light">Asotrauma</span>
    </section>
  </div>
</div>
