<?php
session_start();
require_once '../admin_check.php';
require_once '../bd_conexion.php';

// Función para eliminar categoría
if (isset($_GET['eliminar_nombre'])) {
    $nombre_eliminar = $_GET['eliminar_nombre'];

    if (!empty($nombre_eliminar)) {
        try {
            $delete_categoria = "DELETE FROM categorias WHERE nombre = :nombre";
            $stmt = $conn->prepare($delete_categoria);
            $stmt->bindParam(':nombre', $nombre_eliminar, PDO::PARAM_STR);
            $stmt->execute();

            echo "<script>alert('Categoría eliminada correctamente');</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Error al eliminar la categoría: " . $e->getMessage() . "');</script>";
        }
    }
}

// Si se hace una actualización (POST) para modificar la categoría
if (isset($_POST['modificar_categoria']) && isset($_POST['nombre_categoria'])) {
    $nombre_modificar = $_POST['nombre_categoria'];
    $nombre = $_POST['nombre'];

    // Aquí no es necesario verificar si el nombre es un entero
    try {
        // Actualizar categoría
        $update_categoria = "UPDATE categorias SET nombre = :nombre WHERE nombre = :nombre";
        $stmt = $conn->prepare($update_categoria);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $nombre_modificar, PDO::PARAM_STR);
        $stmt->execute();

        echo "<script>alert('Categoría actualizada correctamente');</script>";
        header('Location: categorias.php');  // Redirige después de actualizar
        exit;
    } catch (PDOException $e) {
        echo "<script>alert('Error al actualizar la categoría: " . $e->getMessage() . "');</script>";
    }
}

// Función para crear una nueva categoría
if (isset($_POST['crear_categoria'])) {
    $nombre = $_POST['nombre'];

    if (!empty($nombre)) {
        try {
            $insert_categoria = "INSERT INTO categorias (nombre) VALUES (:nombre)";
            $stmt = $conn->prepare($insert_categoria);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->execute();

            echo "<script>alert('Categoría creada correctamente');</script>";
            header('Location: categorias.php');  // Redirige después de crear
            exit;
        } catch (PDOException $e) {
            echo "<script>alert('Error al crear la categoría: " . $e->getMessage() . "');</script>";
        }
    } else {
        echo "<script>alert('El nombre de la categoría no puede estar vacío.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            padding-bottom: 5em;
        }
    </style>
</head>

<body>
    <?php require_once 'nav.php' ?>

    <div class="container mt-5">
        <!-- Tabla para mostrar las categorías existentes -->
        <h3 class="mt-5">Categorías Actuales</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mostrar categorías
                $stmt = $conn->query("SELECT * FROM categorias ORDER BY nombre DESC");
                $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($categorias as $categoria):
                    ?>
                    <tr>
                        <td><?= $categoria['nombre']; ?></td>
                        <td>
                            <!-- Botones para modificar y eliminar -->
                            <a href="categorias.php?nombre=<?= $categoria['nombre']; ?>"
                                class="btn btn-success btn-sm">Modificar</a>
                            <a href="categorias.php?eliminar_nombre=<?= $categoria['nombre']; ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Seguro que deseas eliminar esta categoría?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Formulario para modificar una categoría -->
        <?php if (isset($_GET['nombre'])): ?>
            <?php
            // Obtener la categoría que se va a modificar
            $nombre_modificar = $_GET['nombre'];

            // Verificar que el nombre no esté vacío
            if (!empty($nombre_modificar)) {
                // Consulta para obtener los datos de la categoría
                $sql = 'SELECT * FROM categorias WHERE nombre = :nombre';
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nombre', $nombre_modificar, PDO::PARAM_STR);
                $stmt->execute();
                $categoria = $stmt->fetch(PDO::FETCH_ASSOC);

                // Si la categoría no existe, redirigir al listado
                if (!$categoria) {
                    echo "<script>alert('Categoría no encontrada.'); window.location.href='categorias.php';</script>";
                    exit;
                }
            }
            ?>

            <h3 class="mt-5">Modificar Categoría</h3>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre de la Categoría</label>
                    <input type="text" class="form-control" id="nombre" name="nombre"
                        value="<?= $categoria['nombre']; ?>" required>
                </div>
                <input type="hidden" name="nombre_categoria" value="<?= $categoria['nombre']; ?>">
                <button type="submit" class="btn btn-primary" name="modificar_categoria">Guardar Cambios</button>
            </form>
        <?php endif; ?>

        <!-- Formulario para crear nueva categoría -->
        <h3 class="mt-5">Crear Nueva Categoría</h3>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Categoría</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <button type="submit" class="btn btn-primary" name="crear_categoria">Crear Categoría</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
