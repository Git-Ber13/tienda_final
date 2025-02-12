<?php
require_once 'cabecera.php';
require_once 'checkin.php';
require_once 'bd_conexion.php';

// Conexión a la base de datos
$mysqli = new mysqli("localhost", "root", "", "bd_tienda");

// Verificar si la conexión fue exitosa
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

// Obtener los pedidos, ordenados por fecha descendente
$pedido_sql = "SELECT * FROM pedidos ORDER BY fecha DESC";
$pedidos_result = $mysqli->query($pedido_sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <!-- Agregar enlace a Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin-top: 4em;
        }
        .table {
            /* Sombra bastante marcada */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            border-radius: 8px;
        }
        .modal-content {
            border-radius: 8px;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <h2>Lista de Pedidos de <i><u><?= $_SESSION['usuario']?></u></i>.</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Pedido ID</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Iterar sobre los pedidos
                while ($row = $pedidos_result->fetch_assoc()) {
                    $pedido_id = $row['id'];
                    $total = $row['total'];
                    $fecha = $row['fecha'];

                    // Obtener los detalles del pedido desde la tabla 'detalles_pedido' y unir con productos y fotos
                    $detalle_sql = "SELECT dp.*, p.nombre AS producto, p.precio, f.ruta AS foto_imagen 
                                    FROM detalles_pedido dp
                                    INNER JOIN productos p ON dp.id_producto = p.id
                                    LEFT JOIN fotos f ON p.id = f.id_producto
                                    WHERE dp.id_pedido = $pedido_id";
                    $detalle_result = $mysqli->query($detalle_sql);
                    $detalles = '';
                    while ($detalle = $detalle_result->fetch_assoc()) {
                        $producto = $detalle['producto'];
                        $cantidad = $detalle['cantidad'];
                        $precio = $detalle['precio'];
                        $foto_imagen = $detalle['foto_imagen']; // Imagen adicional del producto
                        $imagen_final = $foto_imagen ? $foto_imagen : 'default-product-image.jpg'; // Si no tiene foto, imagen predeterminada

                        $detalles .= "<p>Producto: $producto - Cantidad: $cantidad - Precio: $$precio</p>
                                      <img src='admin/img/$imagen_final' alt='$producto' style='width: 100px; height: auto;'>";
                    }
                    ?>
                    <tr>
                        <td><?= $pedido_id ?></td>
                        <td><?= number_format($total, 2)." €" ?></td>
                        <td><?= $fecha ?></td>
                        <td>
                            <button class="btn btn-info" data-toggle="modal" data-target="#modalPedido" 
                                    data-pedido-id="<?= $pedido_id ?>"
                                    data-fecha="<?= $fecha ?>"
                                    data-total="<?= $total ?>"
                                    data-detalles="<?= htmlspecialchars($detalles) ?>">
                                Ver detalles
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para ver detalles del pedido -->
    <div class="modal fade" id="modalPedido" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Detalles del Pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Fecha:</strong> <span id="modalFecha"></span></p>
                    <p><strong>Total:</strong> <span id="modalTotal"></span></p>
                    <div id="modalDetalles">
                        <!-- Detalles del pedido se cargarán aquí -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Agregar scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        // JavaScript para cargar los detalles del pedido en el modal
        $('#modalPedido').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // El botón que activó el modal
            var pedidoId = button.data('pedido-id');
            var fecha = button.data('fecha');
            var total = button.data('total');
            var detalles = button.data('detalles');

            // Actualizar el modal con los datos del pedido
            var modal = $(this);
            modal.find('.modal-title').text('Detalles del Pedido #' + pedidoId);
            modal.find('#modalFecha').text(fecha);
            modal.find('#modalTotal').text('$' + total.toFixed(2));
            modal.find('#modalDetalles').html(detalles); // Poner los detalles del pedido
        });
    </script>
</body>
</html>

<?php
// Cerrar la conexión
$mysqli->close();
?>
