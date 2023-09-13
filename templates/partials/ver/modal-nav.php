<nav class="p-2 d-flex bg-secondary justify-content-center gap-3 border-bottom border-warning-subtle">
  <button
  title="Informaci&oacute;n"
  @click="tab = 1"
  :class="{'shadow active': tab === 1}"
  class="btn btn-sm btn-outline-warning px-3 rounded-5">
    Info.
  </button>

  <button
  @click="tab = 3"
  :class="{'shadow active': tab === 3}"
  title="Observaciones"
  class="btn btn-sm btn-outline-warning px-3 rounded-5">
    Obs.
  </button>

  <?php if($user->isTh() && $this->isRoute('req.th')): ?>
    <button
    title="Talento Humano"
    @click="tab = 2"
    :class="{'shadow active': tab === 2}"
    class="btn btn-sm btn-outline-warning px-3 rounded-5">
      TH
    </button>

    <button
    title="Acciones"
    @click="tab = 4"
    :class="{'shadow active': tab === 4}"
    class="btn btn-sm btn-outline-warning px-3 rounded-5 lh-1">
      <?= $this->fetch("./icons/wrench.php") ?>
    </button>
  <?php endif ?>
</nav>
