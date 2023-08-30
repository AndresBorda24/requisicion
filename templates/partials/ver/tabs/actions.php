<div
class="p-3"
x-transition:enter.delay.80ms
x-show="tab === 4">
  <button class="btn btn-sm d-block w-100 btn-success mb-4">
    Aprobar requisici&oacute;n
    <?= $this->fetch("./icons/approved.php") ?>
  </button>

  <span
  class="text-muted small w-100 text-center d-block">
    ** Cuidado **
  </span>
  <button
  class="btn btn-sm d-block w-100 btn-danger">
    Anular requisici&oacute;n
  </button>
</div>
