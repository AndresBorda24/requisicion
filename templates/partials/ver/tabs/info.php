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
  <p> Las principales funciones son las siguientes: </p>
  <p x-text="data.funciones" class="fw-semibold"></p>
</div>
