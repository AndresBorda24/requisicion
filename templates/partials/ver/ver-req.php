<div
x-data="VerRequisicion"
x-cloak
x-bind="events"
class="vh-100 vw-100 flex fixed-top bg-black bg-opacity-75 flex flex-column">
  <div class="small m-auto d-flex flex-column rounded overflow-auto" style="
    width: 100vw;
    max-height: 80vh;
    max-width: 500px;
  ">
    <?= $this->fetch("./partials/ver/modal-header.php") ?>
    <?= $this->fetch("./partials/ver/modal-nav.php") ?>

    <section
    class="flex-grow-1 overflow-auto bg-body">
      <?= $this->fetch("./partials/ver/tabs/info.php") ?>
      <?= $this->fetch("./partials/ver/tabs/extra-th.php") ?>
      <?= $this->fetch("./partials/ver/tabs/actions.php") ?>
    </section>

    <?= $this->fetch("./partials/ver/modal-footer.php") ?>
  </div>
</div>
