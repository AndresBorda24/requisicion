<div
x-data="VerRequisicion"
x-cloak
x-bind="events"
class="vh-100 vw-100 flex fixed-top overflow-auto bg-black bg-opacity-75 flex flex-column">
  <div class="small d-flex flex-column rounded mx-auto mt-5 mb-5 mt-md-3 mb-md-3" style="
    width: 100vw;
    max-width: 600px;
  ">
    <?= $this->fetch("./partials/ver/modal-header.php") ?>
    <?= $this->fetch("./partials/ver/modal-nav.php") ?>

    <section class="p-1 bg-primary text-light text-center">
      <span x-html="data?._state"></span>
    </section>

    <section
    class="flex-grow-1 bg-body">
      <?= $this->fetch("./partials/ver/tabs/info.php") ?>
      <?= $this->fetch("./partials/ver/tabs/obs.php") ?>
      <?php
        if($user->isTh() && $this->isRoute("req.jefes")) {
          echo $this->fetch("./partials/ver/tabs/extra-th.php");
        }
      ?>
    </section>

    <?= $this->fetch("./partials/ver/modal-footer.php") ?>
  </div>
</div>
