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
  class="form-select form-select-sm">
    <option value="" hidden>-- Selecciona --</option>
    <option value="Administrativo Oficina">Administrativo Oficina</option>
    <option value="Administrativo Medio tiempo">Administrativo Medio tiempo</option>
    <option value="Asistencial (L-D Turnos 12 horas)">Asistencial ( L-D Turnos 12 horas)</option>
    <option value="Asistencial medio cuadro">Asistencial medio cuadro</option>
    <option :value="custom">Otro:</option>
  </select>

  <input
  type="text"
  x-transition
  id="custom-horario"
  x-show="isCustomSelected"
  :required="isCustomSelected"
  x-model.debounce.1000="custom"
  class="form-control form-select-sm mt-2">
</div>
