<?php session_start();
$haylogin = isset($_SESSION['usuario']);
// $ruta = basename($_SERVER['PHP_SELF']);
// $ruta = $_GET['categoria'];
$ruta = isset($_GET['categoria']) ? $_GET['categoria'] : null;
?>

<!DOCTYPE html>
<html lang="es" class="h-100">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="tienda_css/diseño.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Inicio</title>
</head>

<body class="d-flex flex-column h-100 vh-100">

  <div class="container-fluid" style="padding:0px">
    <nav class="navbar navbar-expand-lg fixed-top custom-navbar container-fluid">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="nav nav-pills me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link tColor2
                <?= ($ruta === 'index.php') ? 'active' : ''; ?>
                    " href="index.php">HOME</a>
            </li>
            <?php
            if ($haylogin) {
              ?>
              <li class="nav-item">
                <a class="nav-link tColor2
                <?= ($ruta === 'hombre') ? 'active' : ''; ?>
                 " href="categorias.php?categoria=hombre">Hombre</a>
              </li>
              <li class="nav-item">
                <a class="nav-link tColor2
                <?= ($ruta === 'mujer') ? 'active' : ''; ?>
                    " href="categorias.php?categoria=mujer">Mujer</a>
              </li>
              <li class="nav-item">
                <a class="nav-link tColor2
                <?= ($ruta === 'ofertas') ? 'active' : ''; ?>
                 " href="categorias.php?categoria=ofertas">Ofertas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link tColor2" href="cerrar.php">Cerrar sesión</a>
              </li>
            </ul>
            <!-- </ul> -->
            <!-- <ul class="nav nav-pills me-0 mb-2 mb-lg-0"> -->
            <ul class="nav nav-pills ms-auto mb-2 mb-lg-0">
              <li class="nav-item  justify-content: end border-start border-end">
                <a class="nav-link
                  <?= ($ruta === 'mis_pedidos.php') ? 'active' : ''; ?>
                  " href="mis_pedidos.php">Mis pedidos</a>
              </li>
            </ul>
            <ul class="nav nav-pills  mb-2 mb-lg-0">
              <li class="nav-item  justify-content: end ms-auto border-start border-end">
                <a class="nav-link
                  <?= ($ruta === 'contacto.php') ? 'active' : ''; ?>
                  " href="contacto.php?categoria=contacto">Contacto</a>
              </li>
            </ul>
            <!-- </ul> -->
          <?php } else {
              ?>
            <ul class="nav nav-pills ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link
                <?= ($ruta === 'login.php') ? 'active' : ''; ?>
                 " href="login.php">Iniciar Sesión</a>
              </li>
              <li class="nav-item border-start">
                <a class="nav-link
                <?= ($ruta === 'registro.php') ? 'active' : ''; ?>
                " href="registro.php">Registrarse</a>
              </li>
            </ul>
            <!-- Prueba contacto final -->
            <ul class="nav nav-pills ms-auto mb-2 mb-lg-0">
              <li class="nav-item  justify-content: end ms-auto border-end border-start">
                <a class="nav-link <?= ($ruta === 'contacto.php') ? 'active' : ''; ?>" href="contacto.php">Contacto</a>
              </li>
            </ul>
          <?php } ?>
          <?php
          if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin') {
            ?>
            <ul class="nav nav-pills mb-2 mb-lg-0">
              <li class="nav-item border-start border-end">
                <a class="nav-link <?= ($ruta === 'admin/productos.php') ? 'active' : ''; ?>"
                  href="admin/productos.php?categoria=admin">Administrar Web</a>
              </li>
            </ul>
            <?php
          }
          ?>
        </div>
      </div>
    </nav>