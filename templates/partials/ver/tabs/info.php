<div class="p-3"
x-transition:enter.delay.80ms
x-show="tab === 1">
  <p>
    <span x-text="data.jefe_nombre" class="fw-semibold"></span>,
    jefe del &aacute;rea de <span x-text="data.area_nombre" class="fw-semibold"></span>,
    ha solicitado <span x-text="data.cantidad" class="fw-semibold"></span> cargo(s)
    de <span x-text="data.cargo"class="fw-semibold"></span>.
  </p>
  <p>
    El susodicho cargo contempla el siguiente horario:
    <span x-text="data.horario"class="fw-semibold"></span>, con un total de horas
    semanales de <span x-text="data.horas"class="fw-semibold"></span>.
  </p>
  <p class="m-0"> Los conocimientos requeridos son: </p>
  <p x-text="data.conocimientos || 'No especificados...'" class="fw-semibold"></p>

  <p class="m-0"> Las principales funciones son las siguientes: </p>
  <p x-text="data.funciones || 'No especificadas...'" class="fw-semibold"></p>

  <template x-if="data._state != '<?= \App\Enums\Estados::SOLICITUD?>'">
    <div class="border-top pt-3">
      <p>Siendo el nivel educatico requerido:
        <span x-html="data._nivel_educativo" class="fw-semibold"></span>,  con
        experiencia en el sector <span x-text="data.sector" class="fw-semibold"></span>
        de <span x-text="data.sector_anios" class="fw-semibold"></span> a&ntilde;os
        y en el area de <span x-text="data.area" class="fw-semibold"></span> de
        <span x-text="data.area_anios" class="fw-semibold"></span> a&ntilde;os.
      </p>
    </div>
  </template>
</div>
