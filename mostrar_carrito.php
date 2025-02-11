<?php
session_start();

if (!isset($_SESSION['carrito']) || count($_SESSION['carrito']) === 0) {
    echo "<p>El carrito está vacío.</p>";
    exit;
}

// Crear una tabla con los productos en el carrito
echo "<table class='table table-striped table-dark'>";
echo "<tr><th>Producto</th><th>Precio</th><th>Cantidad</th></tr>";
foreach ($_SESSION['carrito'] as $produc) {
    echo "<tr><td>{$produc['nombre']}</td><td>{$produc['precio']}€</td><td>{$produc['cantidad']}</td></tr>";
}
echo "</table>";
?>
