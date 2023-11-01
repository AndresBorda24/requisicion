<nav>
  <a
    class="btn btn-sm btn-outline-warning <?=
      $this->isRoute('req.jefes') ? 'active pe-none' : '' ?>"
    style="font-size: 10px;"
    href="<?= $this->link("req.jefes") ?>"
  >Inicio</a>
  <a
    class="btn btn-sm btn-outline-warning <?=
      $this->isRoute('req.control') ? 'active pe-none' : '' ?>"
    style="font-size: 10px;"
    href="<?= $this->link("req.control") ?>"
  >Control</a>
</nav>
