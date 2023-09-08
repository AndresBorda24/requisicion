<div
x-transition:enter.delay.80ms
x-show="tab === 1">
  <p class="lh-sm border-bottom p-3 shadow-sm">
    <span class="d-flex justify-content-between mb-2 fs-5">
      <span x-text="data.cargo" class="fw-semibold"></span>
      <span x-text="'x '+data.cantidad" class="fw-semibold text-nowrap"></span>
    </span>
    <span class="small">
      <span x-text="data.jefe_nombre" class="small fw-semibold"></span><br>
      <span x-text="data.area_nombre" class="small"></span>
    </span>
  </p>
  <ul class="list-group list-group-flush px-3 mb-3" style="font-size: 0.9em;">
    <li class="list-group-item">
      Motivo: <span x-html="data._motivo" class="fw-semibold"></span>.
      <template x-if="data.motivo_desc">
        <span x-text="data.motivo_desc" class="d-block p-1 rounded-1">
        </span>
      </template>
    </li>
    <li class="list-group-item">
      Tipo de vinculaci&oacute;n: <span x-html="data._tipo" class="fw-semibold"></span>.
    </li>
    <li class="list-group-item">
      Horario: <span x-text="data.horario"class="fw-semibold"></span>.
    </li>
    <li class="list-group-item">
      Horas semanales: <span x-text="data.horas"class="fw-semibold"></span>.
    </li>
    <template x-if="data.state != '<?= \App\Enums\Estados::SOLICITUD ?>'">
    <li class="list-group-item">
      Nivel educatico:
      <span x-html="data._nivel_educativo" class="fw-semibold"></span>.
    </li>
    </template>
    <li class="list-group-item">
      Conocimientos:
      <span x-text="data.conocimientos || 'No especificados...'"
      class="d-block p-1"></span>
    </li>
    <li class="list-group-item">
      Funciones:
      <span x-text="data.funciones || 'No especificadas...'"
      class="d-block p-1"></span>
    </li>
    <template x-if="data.state != '<?= \App\Enums\Estados::SOLICITUD ?>'">
    <li class="list-group-item">
      Experiencia:
      <ul>
        <li>En el sector <span x-text="data.sector" class="fw-semibold"></span>
        de <span x-text="data.sector_anios" class="fw-semibold"></span> a&ntilde;os</li>
        <li>En el area de <span x-text="data.area" class="fw-semibold"></span> de
        <span x-text="data.area_anios" class="fw-semibold"></span> a&ntilde;os.</li>
      </ul>
    </li>
    </template>
  </ul>

  <template x-if="data.state != '<?= \App\Enums\Estados::SOLICITUD ?>'">
    <div class="pt-3"></div>
  </template>
</div>
