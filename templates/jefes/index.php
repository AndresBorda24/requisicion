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
    "title" => "Panel de requisiciones | Jefes"
  ]) ?>
  <main class="container my-5">
    <section
    class="mb-3"
    id="buttons-container"></section>

    <?= $this->fetch("./jefes/comp/grilla.php") ?>
  </main>
  <?= $this->fetch("./partials/footer.php") ?>

  <?= $this->fetch("./jefes/comp/req-form.php") ?>
  <?= $this->fetch("./partials/ver/ver-req.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
