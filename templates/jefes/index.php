<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Requisici&oacute;n de Personal</title>
    <?= $this->loadAssets("jefes/app") ?>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Panel de requisiciones"
  ]) ?>
  <main class="container container-height py-4">
    <section
    class="mb-3 d-flex justify-content-between"
    id="buttons-container">

      <?php if ($user->getUserType() === \App\Enums\UserTypes::TH): ?>
        <a
          target="_blank"
          href="<?= $this->link("excel") ?>"
          class="btn btn-sm btn-success shadow"
          style="order: 2;"
        > Generar Excel </a>
      <?php endif ?>
    </section>

    <?= $this->fetch("./jefes/comp/grilla.php") ?>
  </main>
  <?= $this->fetch("./partials/footer.php") ?>

  <?= $this->fetch("./jefes/comp/req-form.php") ?>
  <?= $this->fetch("./partials/ver/ver-req.php") ?>
  <?= $this->fetch("./partials/notificaciones.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
