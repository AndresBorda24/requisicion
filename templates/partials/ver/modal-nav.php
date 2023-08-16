<nav class="p-2 d-flex bg-secondary justify-content-center gap-3">
  <button
  title="Informaci&Oacute;n"
  @click="tab = 1"
  :class="{'shadow active': tab === 1}"
  class="btn btn-sm btn-outline-warning px-3 rounded-5">
    Info.
  </button>

  <button
  title="Experiencia"
  @click="tab = 2"
  :class="{'shadow active': tab === 2}"
  class="btn btn-sm btn-outline-warning px-3 rounded-5">
    Experiencia
  </button>

  <button
  title="Observaciones"
  class="btn btn-sm btn-outline-warning px-3 rounded-5">
    Obs.
  </button>
</nav>
