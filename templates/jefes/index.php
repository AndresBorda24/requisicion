<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Requisici&oacute;n de Personal</title>
    <?= $this->loadAssets("jefes/app") ?>
</head>
<body>
    <?= $this->fetch("./partials/header.php") ?>
    <main class="container my-5">
        <?= $this->fetch("./jefes/comp/grilla.php") ?>
    </main>
    <?= $this->fetch("./partials/footer.php") ?>
</body>
</html>
