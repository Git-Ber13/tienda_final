<?php
session_start();
require_once '../admin_check.php';
require_once 'consultas.php';
require_once 'nav.php';
?>

<!-- Cuerpo de la página -->
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3>Productos Actuales</h3>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Foto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Mostrar tabla productos
                    if (count($productos) > 0): ?>
                        <?php foreach ($productos as $producto): ?>
                            <tr>
                                <td><?= $producto['id']; ?></td>
                                <td><?= $producto['nombre']; ?></td>
                                <td><?= $producto['categoria']; ?></td>
                                <td><?= $producto['descripcion']; ?></td>
                                <td><?= $producto['precio'] . "€"; ?></td>
                                <td><img src="<?= $producto['ruta']; ?>" alt="Imagen" width="50"></td>
                                <td class="text-center">
                                    <!-- Botón para MODIFICAR el producto con icono Font Awesome -->
                                    <a href="p_modificar.php?id=<?= $producto['id']; ?>" class="btn btn-primary btn-sm"
                                        style="width: 48%; display: inline-flex; align-items: center; justify-content: center; margin-right: 2%; text-align: center;">
                                        <i class="fa-solid fa-pen-to-square"></i> <!-- Icono de editar -->
                                    </a>

                                    <!-- Formulario para ELIMINAR el producto con icono Font Awesome -->
                                    <form action="p_eliminar.php" method="POST"
                                        style="display:inline-flex; width: 48%; justify-content: center; text-align: center;"
                                        onsubmit="return confirm('¿Estás seguro que deseas eliminar este producto?');">
                                        <input type="hidden" name="id" value="<?= $producto['id']; ?>" />
                                        <button type="submit" name="delete" class="btn btn-danger btn-sm"
                                            style="display: inline-flex; align-items: center; justify-content: center; text-align: center;">
                                            <i class="fa-solid fa-trash-can"></i> <!-- Icono de eliminar -->
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No hay productos</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="col-md-6">
            <h3>Insertar Nuevo Producto</h3>
            <form action="add_producto.php" method="POST" enctype="multipart/form-data"
                onsubmit="return confirm('¿Estás seguro que deseas crear este producto?');">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoría</label>
                    <input type="text" class="form-control" id="categoria" name="categoria" placeholder="categoria"
                        required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" placeholder="descripción"
                        required></textarea>
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="text" class="form-control" id="precio" name="precio" placeholder="precio" required>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                </div>
                <button type="submit" name="insertar" class="btn btn-primary">Insertar</button>
            </form>
        </div>
    </div>
</div>

<!-- Añadir Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>