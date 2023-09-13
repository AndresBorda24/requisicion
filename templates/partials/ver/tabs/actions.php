<div
x-transition:enter.delay.80ms
x-show="tab === 4">
  <form @submit.prevent="changeState" x-data="ChangeState">
    <p class="m-0 text-muted p-3 pb-0">Selecciona el estado:</p>
    <div class="p-3 border-bottom shadow-sm flex justify-content-center flex-wrap gap-1 mb-2 pt-2">
      <!-- rs-# radio-state -->
      <input x-bind="radio" id="rs-1" value="<?= \App\Enums\Estados::APROBADO ?>">
      <label
        for="rs-1"
        class="flex-grow-1 btn opacity-hover btn-outline-success btn-sm border-0 label-activable"
      > Aprobar <?= $this->fetch("./icons/approved.php") ?> </label>

      <input x-bind="radio" id="rs-2" value="<?= \App\Enums\Estados::ANULADO ?>">
      <label
        for="rs-2"
        class="flex-grow-1 btn opacity-hover btn-outline-danger btn-sm border-0 label-activable"
      > Anular <?= $this->fetch("./icons/cancel.php") ?> </label>

      <input x-bind="radio" id="rs-3" value="<?= \App\Enums\Estados::DEVUELTO ?>">
      <label
        for="rs-3"
        class="flex-grow-1 btn opacity-hover btn-outline-primary btn-sm border-0 label-activable"
      > Devolver <?= $this->fetch("./icons/back.php") ?> </label>
    </div>

    <div class="p-3">
      <label for="new-state-obs" class="text-muted">Deja una observaci&oacute;n:</label>
      <span class="text-muted small d-block">
        <span x-text="state.obs?.length || '0'"></span> / 280
      </span>
      <textarea
        required
        maxlength="280"
        id="new-state-obs"
        x-model="state.obs"
        :readonly="! Boolean(state.new_state)"
        class="form-control form-control-sm"
        style="height: 200px; max-height: 300px;"
      ></textarea>
    </div>

    <button
    x-html="submitButtonHtml"
    x-show="Boolean(state.new_state)"
    class="block btn btn-sm m-auto mb-3 w-50"
    :class="`btn-${submitButtonColor}`">
      Hecho!
    </button>
  </form>
</div>
