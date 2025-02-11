<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_GET['id'], $_GET['nombre'], $_GET['precio'])) {
    $producto = [
        'id' => $_GET['id'],
        'nombre' => $_GET['nombre'],
        'precio' => $_GET['precio'],
        'cantidad' => 1
    ];

    // Comprobar si el producto ya existe en el carrito
    // $existe = false;
    // foreach ($_SESSION['carrito'] as &$item) {
    //     if ($item['id'] == $producto['id']) {
    //         $item['cantidad']++;
    //         $existe = true;
    //         break;
    //     }
    // }

    // if (!$existe) {
        array_push($_SESSION['carrito'], $producto);
    // }
}

echo json_encode(['carrito_count' => count($_SESSION['carrito'])]);
?>
