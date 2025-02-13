<?php
// Conectar a la base de datos
require_once 'bd_conexion.php';

if (isset($_GET['pedido_id'])) {
    $pedido_id = $_GET['pedido_id'];

    // Obtener los detalles del pedido
    $pedido_sql = "SELECT * FROM pedidos WHERE id = $pedido_id";
    $pedido_result = $mysqli->query($pedido_sql);
    $pedido = $pedido_result->fetch_assoc();
    $fecha = $pedido['fecha'];
    $total = $pedido['total'];

    // Obtener los productos asociados al pedido
    $detalle_sql = "SELECT p.id, p.nombre, p.categoria, p.precio, f.ruta
                    FROM detalles_pedido dp
                    INNER JOIN productos p ON dp.id_producto = p.id
                    LEFT JOIN fotos f ON p.id = f.id_producto
                    WHERE dp.id_pedido = $pedido_id";
    $detalle_result = $mysqli->query($detalle_sql);
}
?>

<div class="modal-body">
    <p><strong>Fecha:</strong> <?= $fecha ?></p>
    <p><strong>Total:</strong> <?= number_format($total, 2) ?> €</p>
    <h5>Productos:</h5>
    <ul>
        <?php while ($producto = $detalle_result->fetch_assoc()): ?>
            <li>
                <strong><?= $producto['nombre'] ?></strong><br>
                Categoría: <?= $producto['categoria'] ?><br>
                Precio: <?= number_format($producto['precio'], 2) ?> €<br>
                <?php if ($producto['ruta']): ?>
                    <img src="admin/<?= $producto['ruta'] ?>" alt="<?= $producto['nombre'] ?>" style="width: 100px; height: auto;">
                <?php else: ?>
                    <img src="admin/default-product-image.jpg" alt="Imagen por defecto" style="width: 100px; height: auto;">
                <?php endif; ?>
            </li>
        <?php endwhile; ?>
    </ul>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
</div>

<?php
// Cerrar la conexión
$mysqli->close();
?>
