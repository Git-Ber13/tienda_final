<?php
session_start();
require_once '../admin_check.php';
require_once '../bd_conexion.php';
require_once 'nav.php';
require_once 'add_foto.php';  // Incluir el archivo add_foto.php para usar la lógica de mover imágenes
require_once 'func_validar.php'; // Incluir las funciones comunes


// Verificar si el id está presente en la URL (cuando se hace clic en "Modificar")
if (isset($_GET['id'])) {
    $id_modificar = $_GET['id'];

    // Verificar si el id es válido (es un número entero)
    if (filter_var($id_modificar, FILTER_VALIDATE_INT)) {
        // Consulta para obtener los datos del producto
        $sql = 'SELECT * FROM productos WHERE id = :id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id_modificar, PDO::PARAM_INT);
        $stmt->execute();
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si el producto no existe, redirigir al listado
        if (!$producto) {
            echo "<script>alert('Producto no encontrado.'); window.location.href='productos.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('ID no válido.'); window.location.href='productos.php';</script>";
        exit;
    }
}

// Si se hace una actualización (POST)
if (isset($_POST['modificar']) && isset($_POST['id'])) {
    $id_modificar = $_POST['id'];
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $foto = $_FILES['foto'];  // Ahora la foto viene de los archivos subidos, no del formulario como texto

    // Verificar si el id es válido
    if (filter_var($id_modificar, FILTER_VALIDATE_INT)) {
        try {
            // Actualizar producto
            $update_producto = "UPDATE productos SET nombre = :nombre, categoria = :categoria, descripcion = :descripcion, precio = :precio WHERE id = :id";
            $stmt = $conn->prepare($update_producto);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id_modificar, PDO::PARAM_INT);
            $stmt->execute();

            // Si se sube una nueva foto, moverla y actualizar la base de datos
            if ($foto['error'] === 0) {
                // Usar la lógica del archivo add_foto.php para mover la imagen
                // Esta función mueve la imagen y nos devuelve el nombre de la imagen movida
                include 'add_foto.php';  // Llamada a la función definida en add_foto.php

                // Si la imagen se movió correctamente, actualizar la base de datos
                if ($resultado[0]['success']) {
                    $foto_path = $resultado[0]['file'];  // Obtener la ruta del archivo movido

                    // Actualizar la ruta de la foto en la base de datos
                    $update_foto = "UPDATE fotos SET ruta = :foto WHERE id_producto = :id";
                    $stmt_foto = $conn->prepare($update_foto);
                    $stmt_foto->bindParam(':foto', $foto_path, PDO::PARAM_STR);
                    $stmt_foto->bindParam(':id', $id_modificar, PDO::PARAM_INT);
                    $stmt_foto->execute();
                } else {
                    echo "<script>alert('Error al subir la imagen.');</script>";
                    exit;
                }
            }

            echo "<script>alert('Producto actualizado correctamente');</script>";
            header('Location: productos.php');  // Redirecciona a la página principal
            exit;

        } catch (PDOException $e) {
            echo "<script>alert('Error al actualizar el producto: " . $e->getMessage() . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: rgb(209, 206, 206);
            /* color: white; */
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h2>Modificar Producto</h2>

        <!-- Formulario para modificar los datos del producto -->
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                    value="<?= isset($producto) ? $producto['nombre'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <input type="text" class="form-control" id="categoria" name="categoria"
                    value="<?= isset($producto) ? $producto['categoria'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion"
                    required><?= isset($producto) ? $producto['descripcion'] : ''; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="text" class="form-control" id="precio" name="precio"
                    value="<?= isset($producto) ? $producto['precio'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto">
            </div>
            <input type="hidden" name="id" value="<?= isset($producto) ? $producto['id'] : ''; ?>">
            <button type="submit" class="btn btn-primary" name="modificar">Guardar Cambios</button>
        </form>

        <!-- Tabla de productos -->
        <h3 class="mt-5">Productos Existentes</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mostrar productos
                $stmt = $conn->query("SELECT * FROM productos ORDER BY id DESC");
                $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($productos as $producto):
                    ?>
                    <tr>
                        <td><?= $producto['id']; ?></td>
                        <td><?= $producto['nombre']; ?></td>
                        <td><?= $producto['categoria']; ?></td>
                        <td><?= $producto['descripcion']; ?></td>
                        <td><?= $producto['precio']; ?>€</td>
                        <td>
                            <a href="p_modificar.php?id=<?= $producto['id']; ?>"
                                class="btn btn-success btn-sm">Modificar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>