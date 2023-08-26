<details
x-data
class="position-relative z-1"
@click.outside="$el.removeAttribute('open')">
  <summary class="btn btn-sm btn-primary border-0" role="button">
    Dejar Observaci&oacute;n
  </summary>

  <section
  class="bg-blue-50 border p-2 position-absolute rounded shadow-lg top-100 border-primary-subtle start-0 m-1"
  style="width: 300px;">
    <form @submit.prevent>
      <div class="d-flex align-items-center mb-1">
        <label class="flex-grow-1 m-0 form-label small text-muted" for="observacion">
          Observaci&oacute;n:
        </label>
        <button title="Guardar Observaci&oacute;n" class="btn btn-sm btn-success p-1 lh-1">
          <?= $this->fetch("./icons/save.php") ?>
        </button>
      </div>
      <textarea
      id="observacion"
      style="height: 180px; font-size: 12px;"
      placeholder="Si es necesario, deja una observaci&oacute;n..."
      class="form-control form-control-sm m-0"
      ></textarea>
    </form>
  </section>
</details>
