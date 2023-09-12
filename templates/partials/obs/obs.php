<details
x-data="Obs"
class="position-relative z-1"
x-ref="obsCreate"
@click.outside="closeDetail">
  <summary @click="setFocus" class="btn btn-sm btn-primary border-0" role="button">
    Dejar Observaci&oacute;n
  </summary>

  <section
  style="box-shadow: 0px 1rem 3rem 0px rgb(0 0 0 / .5);"
  class="bg-body small border p-2 position-absolute rounded top-100 start-0 mt-1 w-100">
    <form @submit.prevent="saveObs">
      <div class="d-flex align-items-center">
        <label class="flex-grow-1 m-0 form-label small text-muted py-1" for="observacion">
          Observaci&oacute;n:
        </label>
        <button
        x-show="showSave" x-transition
        title="Guardar Observaci&oacute;n"
        class="btn btn-sm btn-success p-1 lh-1">
          <?= $this->fetch("./icons/save.php") ?>
        </button>
      </div>
      <span class="small text-dark">
        <span x-text="obsLength"></span> / Longitud m&iacute;nima: 6
      </span>
      <textarea
      required
      id="observacion"
      x-model="obs"
      minlength="5"
      style="height: 180px; font-size: 12px;"
      placeholder="Si es necesario, deja una observaci&oacute;n..."
      class="form-control form-control-sm m-0"
      ></textarea>
    </form>
  </section>
</details>
