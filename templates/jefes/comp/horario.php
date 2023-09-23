<div
x-data="Horarios"
x-model="state.horario"
x-modelable="horario"
class="mb-2">
  <label for="horario" class="form-label small">Horario*:</label>
  <select
  id="horario"
  x-model="horario"
  @change="setCustomFocus"
  required
  x-ref="custom-schedule-select"
  class="form-select form-select-sm">
    <option value="" hidden>-- Selecciona --</option>
    <option no-custom value="Administrativo Oficina">Administrativo Oficina</option>
    <option no-custom value="Administrativo Medio tiempo">Administrativo Medio tiempo</option>
    <option no-custom value="Asistencial (L-D Turnos 12 horas)">Asistencial ( L-D Turnos 12 horas)</option>
    <option no-custom value="Asistencial medio cuadro">Asistencial medio cuadro</option>
    <option :value="custom">Otro:</option>
  </select>
  <div class="mt-2" x-show="isCustomSelected">
    <?= $this->fetch("./partials/textarea-counter.php", [ "id" => "#custom-horario"]) ?>
    <input
    type="text"
    x-transition
    id="custom-horario"
    maxlength="100"
    :required="isCustomSelected"
    x-model.debounce.1000="custom"
    class="form-control form-select-sm">
  </div>
</div>
