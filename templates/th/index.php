<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Requisici&oacute;n de Personal | TH</title>
  <?= $this->loadAssets("th/app") ?>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Panel de requisiciones | TH"
  ]) ?>
  <main class="container my-5">
    <p class="text-muted small bg-light">
      Aqu&iacute; se muestran TODAS las requisiciones
      realizadas por los JEFES de &aacute;rea. Puedes
      <span class="fw-bold">filtrarlas</span> por sus estados.
    </p>
    <?= $this->fetch("./th/comp/grilla.php") ?>
  </main>
  <?= $this->fetch("./partials/footer.php") ?>

  <?= $this->fetch("./partials/ver/ver-req.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
