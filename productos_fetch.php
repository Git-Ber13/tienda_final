<?php
session_start();
include 'conexion.php';

$stmt = $conn->query("SELECT * FROM productos");
$productos = $stmt->fetchAll();

// Para que calcule la cantidad de artículos si recargamos la página
$carrito_count = isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Tienda Online</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

    <script>
        // Función que agrega el producto al carrito usando fetch
        function agregarAlCarritoFetch(id, nombre, precio) {
            fetch(`actualizar_carrito.php?id=${id}&nombre=${nombre}&precio=${precio}`, {
                'method': 'GET',
                'headers': { 'Content-Type': 'application/x-www-form-urlencoded' }
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    document.getElementById('carrito-count').textContent = data.carrito_count;
                });
        }

        // Mostrar carrito
        function mostrarCarrito() {
            let carritoDiv = document.getElementById('carrito');
            if (carritoDiv.style.display === 'none') {

                fetch('mostrar_carrito.php')
                    .then(response => response.text())
                    .then(html => {
                        carritoDiv.innerHTML = html;
                        carritoDiv.style.display = 'block';
                    });

            } else {
                carritoDiv.style.display = 'none';
            }
        }

        // Mostrar pedidos
        function mostrarPedidos() {
            let pedidosDiv = document.getElementById('carrito');
            if (pedidosDiv.style.display === 'none') {
                fetch('mostrar_pedidos.php')
                    .then(response => response.text())
                    .then(html => {
                        pedidosDiv.innerHTML = html;
                        pedidosDiv.style.display = 'block';
                    });
            } else {
                pedidosDiv.style.display = 'none';
            }
        }
    </script>
</head>

<body>
    <h1>Productos</h1>
    <a href="carrito.php" class="btn btn-primary">Ver carrito</a>
    <a href="carrito.php" class="btn btn-primary">Ver carrito (<span
            id="carrito-count"><?= $carrito_count ?></span>)</a>

    <div class="productos">
        <?php foreach ($productos as $producto) { ?>
            <div class="producto">
                <h2><?= htmlspecialchars($producto['nombre']) ?></h2>
                <p>Precio: <?= number_format($producto['precio'], 2) ?>€</p>
                <br />
                <button class="btn btn-light"
                    onclick="agregarAlCarritoFetch(<?= $producto['id'] ?>, '<?= $producto['nombre'] ?>', <?= $producto['precio'] ?>)">
                    Comprar por fetch
                </button>
            </div>
        <?php } ?>
    </div>
    <br />
    <button class="btn btn-primary" onclick="mostrarCarrito()">Ver Carrito</button>
    <button class="btn btn-success" onclick="mostrarPedidos()">Ver Pedidos</button>
    <br />
    <div id="carrito" style="display: none; border: 1px solid #ddd; padding: 10px; margin-top: 10px;"></div>

</body>

</html>
