<?php require_once 'cabecera.php'; ?>
<?php require_once 'checkin.php'; ?>
<?php require_once 'bd_conexion.php'; ?>

<!-- Obtener categoría de la URL -->
<?php
$categoria = $_GET['categoria'];
$sql = 'SELECT * FROM productos p
LEFT JOIN fotos f ON p.id = f.id_producto
WHERE categoria = :categoria';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':categoria', $categoria);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if ($haylogin): ?>
    <main class="container mt-5 flex-shrink-0">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-3 justify-content-center">
            <?php foreach ($productos as $producto): ?>
                <div class="col mb-5 pt-5">
                    <div class="card h-100">
                        <!-- Nombre del producto y botón de carrito -->
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="fw-bolder text-center"><?= $producto['nombre'] ?></h3>
                            <button type="button" class="btn btn-outline-dark" id="add-to-cart-<?= $producto['id'] ?>" data-id="<?= $producto['id'] ?>" onclick="agregarAlCarrito(<?= $producto['id'] ?>, '<?= $producto['nombre'] ?>', <?= $producto['precio'] ?>)">
                                <i class="bi bi-cart-plus"></i> <!-- Icono de carrito de Bootstrap -->
                            </button>
                        </div>

                        <!-- Imagen del producto -->
                        <img class="card-img-top" src="admin/<?= $producto['ruta'] ?>" alt="...">

                        <!-- Detalles del producto -->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <p><?= $producto['descripcion'] ?></p>
                                <p><?= $producto['desc_larga'] ?></p>
                                <h3><?= $producto['precio'] ?> €</h3>
                            </div>
                        </div>

                        <!-- Modal "Ver más" -->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <button type="button" class="btn btn-secondary text-white btn-outline-dark mt-auto" data-bs-toggle="modal" data-bs-target="#productModal"
                                    data-nombre="<?= $producto['nombre'] ?>" data-imagen="admin/<?= $producto['ruta'] ?>" data-descripcion="<?= $producto['desc_larga'] ?>" data-precio="<?= $producto['precio'] ?> €">
                                    Ver más
                                </button>
                                <!-- Botón para añadir al carrito -->
                                <button type="button" class="btn btn-secondary" id="add-to-cart-button-<?= $producto['id'] ?>" data-id="<?= $producto['id'] ?>" onclick="agregarAlCarrito(<?= $producto['id'] ?>, '<?= $producto['nombre'] ?>', <?= $producto['precio'] ?>)">Añadir al carrito</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Modal para ver más información del producto -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalImage" class="img-fluid" src="" alt="Imagen del producto">
                    <h4 id="modalNombre"></h4>
                    <p id="modalDescripcion"></p>
                    <h5 id="modalPrecio"></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

<?php else: ?>
    <main>
        <div class="card" tabindex="1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Iniciar sesión</h5>
                    </div>
                    <div class="modal-body">
                        <p>Para poder acceder a la página debe iniciar sesión.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="LOGin.php">
                            <button type="button" class="btn btn-primary">Iniciar sesión</button>
                        </a>
                        <a href="index.php">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php endif; ?>

<?php require_once 'pie.php'; ?>

<!-- Incluye Bootstrap Icons para el icono de carrito -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- Añadir el contador flotante -->
<div id="carrito-icon" class="position-fixed bottom-0 start-0 m-3">
    <button class="btn btn-primary position-relative" onclick="window.location.href='carrito.php'">
        <i class="bi bi-cart"></i>
        <span id="carrito-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <?= isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0 ?>
        </span>
    </button>
</div>

<script>
    // Función para agregar al carrito usando fetch
    function agregarAlCarrito(id, nombre, precio) {
        fetch(`actualizar_carrito.php?id=${id}&nombre=${nombre}&precio=${precio}`, {
            method: 'GET',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        })
        .then(response => response.json())
        .then(data => {
            if (data.carrito_count) {
                // alert('Producto añadido al carrito');
                document.getElementById('carrito-count').textContent = data.carrito_count;  // Actualizar el contador del carrito
            } else {
                alert('Hubo un error al añadir al carrito');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al comunicarse con el servidor.');
        });
    }
</script>

<style>
    /* Estilos para el icono flotante */
    #carrito-icon {
        z-index: 999;
    }

    #carrito-count {
        font-size: 1rem;
    }
</style>
