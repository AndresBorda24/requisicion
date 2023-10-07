<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Requisici&oacute;n de Personal | Direcci&oacute;n</title>
  <?= $this->loadAssets("gerencia/app") ?>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Panel de requisiciones | Gerencia"
  ]) ?>
  <main class="container my-5">
    <p class="text-muted small bg-light">
      Aqu&iacute; se muestran TODAS las requisiciones
      realizadas por los JEFES de &aacute;rea  que ya han sido aprobadas por
      TH.
    </p>
    <?= $this->fetch("./direccion/comp/grilla.php") ?>
  </main>
  <?= $this->fetch("./partials/footer.php") ?>

  <?= $this->fetch("./partials/ver/ver-req.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
