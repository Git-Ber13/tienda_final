<?php
// session_start();
require_once 'cabecera.php';
require_once 'checkin.php';
require_once 'bd_conexion.php';

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['nombre'], $_POST['precio'])) {
    $producto = [
        'id' => $_POST['id'],
        'nombre' => $_POST['nombre'],
        'precio' => $_POST['precio'],
        'cantidad' => 1
    ];

    array_push($_SESSION['carrito'], $producto);
}

if (isset($_GET['eliminar'])) {
    array_splice(
        $_SESSION['carrito'],
        $_GET['eliminar'],
        1
    );
}

$total = array_sum(array_column($_SESSION['carrito'], 'precio'));
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Carrito</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <main class="container h-100">
            <h1 style="margin-top: 2em" ;>Carrito de Compras</h1>
            <table class='table table-striped table-dark'>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Acción</th>
                </tr>
                <?php foreach ($_SESSION['carrito'] as $i => $produc) { ?>
                    <tr>
                        <td><?= $produc['nombre'] ?></td>
                        <td><?= $produc['precio'] ?>€</td>
                        <td>
                            <a href="carrito.php?eliminar=<?= $i ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <p>Total:
                <?= $total ?>
                €</p>
            <div>
                <form method="post" action="index.php">
                    <span>
                        <a href="index.php" class="btn btn-primary">Seguir comprando</a>
                    </span>
                    <span>
                        <button type="submit" class="btn btn-success">Finalizar Compra</button>
                    </span>
                </form>
            </div>

        </main>
    </body>
</html>

