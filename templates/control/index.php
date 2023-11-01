<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Requisici&oacute;n de Personal | Control</title>
    <?= $this->loadAssets("control/app") ?>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Panel de requisiciones | Control"
  ]) ?>
  <main class="container container-height py-4">
    <p>Listado completo de requisiciones:</p>
    <?= $this->fetch("./control/comp/grilla.php") ?>
  </main>
  <?= $this->fetch("./partials/footer.php") ?>

  <?= $this->fetch("./partials/ver/ver-req.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
