<?php
session_start();
require 'bd_conexion.php';

if (!isset($_SESSION['carrito']) || count($_SESSION['carrito']) === 0) {
    header("Location: productos_fetch.php");
    exit();
}

try {
    $total = array_sum(array_column($_SESSION['carrito'], 'precio'));

    // Insertar el pedido
    $stmt = $conn->prepare("INSERT INTO pedidos (total, id_usuario) VALUES (:total, :id_usuario)");
    $stmt->execute([
        'total' => $total,
        'id_usuario' => $_SESSION['id_usuario']
    ]);
    $id_pedido = $conn->lastInsertId();

    // Insertar los detalles del pedido
    $stmt = $conn->prepare("INSERT INTO detalles_pedido (id_pedido, id_producto, cantidad) VALUES (:id_pedido, :id_producto, :cantidad)");

    foreach ($_SESSION['carrito'] as $item) {
        $stmt->execute([
            'id_pedido' => $id_pedido,
            'id_producto' => $item['id'],  // Se asegura de que se inserte el id del producto
            'cantidad' => 1  // Asumimos que la cantidad es 1 para cada producto en el carrito
        ]);
    }

    // Vaciar el carrito
    $_SESSION['carrito'] = [];
} catch (Exception $e) {
    die("Error al procesar la compra: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Compra Finalizada</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <main class="container h-100">
            <h1 style="margin-top: 2em;">¡Gracias por tu compra!</h1>
            <p>Tu pedido ha sido registrado.</p>
            <a href="index.php" class="btn btn-primary">Volver a la tienda</a>
        </main>
    </body>
</html>
