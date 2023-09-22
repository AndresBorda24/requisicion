<div
x-data="VerRequisicion"
x-cloak
x-bind="events"
class="vh-100 vw-100 flex fixed-top overflow-auto bg-black bg-opacity-75 flex flex-column">
  <div class="small d-flex flex-column rounded mx-auto mt-3 mb-5 mb-md-3" style="
    width: 100vw;
    max-width: 500px;
  ">
    <?= $this->fetch("./partials/ver/modal-header.php") ?>
    <?= $this->fetch("./partials/ver/modal-nav.php") ?>

    <section class="p-1 text-bg-primary text-center">
        <span x-html="data?._state"></span>
    </section>

    <section
    class="flex-grow-1 overflow-auto bg-body">
      <?= $this->fetch("./partials/ver/tabs/info.php") ?>
      <?= $this->fetch("./partials/ver/tabs/obs.php") ?>
      <?php
        if($user->isTh() && $this->isRoute('req.th')) {
          echo $this->fetch("./partials/ver/tabs/extra-th.php");
          echo $this->fetch("./partials/ver/tabs/actions.php");
        }
      ?>
    </section>

    <?= $this->fetch("./partials/ver/modal-footer.php") ?>
  </div>
</div>
