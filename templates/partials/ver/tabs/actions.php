<!-- <div
x-transition:enter.delay.80ms
x-show="tab === 4"> -->
  <form
  @submit.prevent="changeState"
  x-data="ChangeState"
  >
    <template x-if="canChangeState">
      <div class="bg-blue-900 text-light p-1">
        <p class="m-0 small p-2" style="color: #cdcdcd;">
          En esta secci&oacute;n puedes modificar el estado actual
          de la requisici&oacute;n. Recuerda dejar una observaci&oacute;n clara para que
          as&iacute; todos entiendan tu decisi&oacute;n.
        </p>
        <p class="m-0 p-2 pb-0">Selecciona el estado:</p>
        <div class="p-2 flex justify-content-center flex-wrap gap-1 pt-2 border-bottom
        border-secondary border-opacity-50">
          <!-- rs-# radio-state -->
          <?php if(! $this->isRoute("req.th")): ?>
            <input x-bind="radio" id="rs-1" value="<?= \App\Enums\Estados::APROBADO ?>">
            <label
            for="rs-1"
            x-show="showChangeButton('<?= \App\Enums\Estados::APROBADO ?>')"
            class="flex-grow-1 btn btn-outline-success btn-sm border-0 label-activable"
            > Aprobar <?= $this->fetch("./icons/approved.php") ?> </label>
          <?php endif ?>

          <input x-bind="radio" id="rs-3" value="<?= \App\Enums\Estados::CUMPLIDO ?>">
          <label
          for="rs-3"
          x-show="showChangeButton('<?= \App\Enums\Estados::CUMPLIDO ?>')"
          class="flex-grow-1 btn btn-outline-info btn-sm border-0 label-activable"
          > Cumplida <?= $this->fetch("./icons/hand-peace.php") ?> </label>

          <input x-bind="radio" id="rs-4" value="<?= \App\Enums\Estados::RECHAZADO ?>">
          <label
          for="rs-4"
          x-show="showChangeButton('<?= \App\Enums\Estados::RECHAZADO ?>')"
          class="flex-grow-1 btn btn-outline-danger btn-sm border-0 label-activable"
          > Rechazar <?= $this->fetch("./icons/cancel.php") ?> </label>

          <input x-bind="radio" id="rs-5" value="<?= \App\Enums\Estados::ANULADO ?>">
          <label
          for="rs-5"
          x-show="showChangeButton('<?= \App\Enums\Estados::ANULADO ?>')"
          class="flex-grow-1 btn btn-outline-danger btn-sm border-0 label-activable"
          > Anular <?= $this->fetch("./icons/cancel.php") ?> </label>

          <input x-bind="radio" id="rs-6" value="<?= \App\Enums\Estados::DEVUELTO ?>">
          <label
          for="rs-6"
          x-show="showChangeButton('<?= \App\Enums\Estados::DEVUELTO ?>')"
          class="flex-grow-1 btn btn-outline-primary btn-sm border-0 label-activable"
          > Devolver <?= $this->fetch("./icons/back.php") ?> </label>
        </div>

        <div class="p-3">
          <label for="new-state-obs" class="opacity-75">Deja una observaci&oacute;n:</label>
          <span class=" small d-block opacity-75">
            <span x-text="state.detail?.length || '0'"></span> / 280
          </span>
          <textarea
            required
            maxlength="280"
            id="new-state-obs"
            x-model="state.detail"
            :readonly="! Boolean(state.state)"
            class="form-control form-control-sm"
            style="height: 200px; max-height: 300px;"
          ></textarea>
        </div>

        <button
        x-html="submitButtonHtml"
        x-show="Boolean(state.state)"
        class="block btn btn-sm m-auto mb-3 w-50"
        :class="`btn-${submitButtonColor}`">
          Hecho!
        </button>
      </div>
    </template>
  </form>
<!-- </div> -->
