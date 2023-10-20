<div
x-data="GrillaJefes"
x-bind="grillaEvents">
  <?= $this->fetch("./partials/grilla/grilla.php") ?>
    <div id="pagination-grilla" class="d-flex justify-content-end pt-3"></div>
</div>
