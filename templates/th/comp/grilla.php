<div
x-data="GrillaTh"
x-bind="events"
data-def-estado="<?= \App\Enums\Estados::SOLICITUD ?>">
  <?= $this->fetch("./partials/grilla/grilla.php") ?>
</div>
