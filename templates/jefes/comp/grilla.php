<div
x-data="GrillaJefes"
x-bind="grillaEvents"
data-def-estado="<?= \App\Enums\Estados::SOLICITUD ?>">
  <?= $this->fetch("./partials/grilla/grilla.php") ?>
</div>
