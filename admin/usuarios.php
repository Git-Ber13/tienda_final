<?php
session_start();
require_once '../admin_check.php';
require_once '../bd_conexion.php';  // Asegúrate de incluir tu archivo de conexión

// Verificar si hay un parámetro "status" en la URL
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'ok') {
        echo "<script>alert('Usuario creado exitosamente');</script>";
    } elseif ($_GET['status'] == 'error') {
        echo "<script>alert('Hubo un problema al crear el usuario. Inténtalo nuevamente.');</script>";
    }
}

// Lógica para buscar usuarios por nombre o email
$search = "";
if (isset($_GET['buscar']) && !empty($_GET['buscar'])) {
    $search = $_GET['buscar'];
    $sql = "SELECT * FROM usuarios WHERE nombre LIKE :search OR email LIKE :search";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
} else {
    // Si no hay búsqueda, obtener todos los usuarios
    $sql = "SELECT * FROM usuarios ORDER BY rol ASC";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Lógica para eliminar usuario
if (isset($_GET['eliminar_email']) && filter_var($_GET['eliminar_email'], FILTER_VALIDATE_EMAIL)) {
    $email_eliminar = $_GET['eliminar_email'];

    // Consulta para eliminar el usuario
    $sql_delete = "DELETE FROM usuarios WHERE email = :email";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bindParam(':email', $email_eliminar, PDO::PARAM_STR);
    $stmt_delete->execute();

    echo "<script>alert('Usuario eliminado correctamente');</script>";
    header('Location: usuarios.php');  // Redirigir para refrescar la página
    exit;
}
// Lógica para crear un nuevo usuario
if (isset($_POST['nuevo_usuario'])) {
    // Sanear datos recibidos del formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT); // Hash de la contraseña
    $email = htmlspecialchars($_POST['email']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $direccion = htmlspecialchars($_POST['direccion']);
    $cp = htmlspecialchars($_POST['cp']);
    $provincia = htmlspecialchars($_POST['provincia']);
    $rol = $_POST['rol'];

    // Preparar consulta para insertar el nuevo usuario
    $sql_insert = "INSERT INTO usuarios (nombre, pass, email, telefono, direccion, cp, provincia, rol) 
                   VALUES (:nombre, :pass, :email, :telefono, :direccion, :cp, :provincia, :rol)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt_insert->bindParam(':pass', $pass, PDO::PARAM_STR);
    $stmt_insert->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt_insert->bindParam(':telefono', $telefono, PDO::PARAM_STR);
    $stmt_insert->bindParam(':direccion', $direccion, PDO::PARAM_STR);
    $stmt_insert->bindParam(':cp', $cp, PDO::PARAM_STR);
    $stmt_insert->bindParam(':provincia', $provincia, PDO::PARAM_STR);
    $stmt_insert->bindParam(':rol', $rol, PDO::PARAM_STR);

    try {
        // Ejecutar la inserción
        $stmt_insert->execute();

        // Redirigir a la página con un parámetro en la URL
        header('Location: usuarios.php?status=ok');
        exit; // Asegúrate de usar exit después de header para evitar que el código siga ejecutándose
    } catch (Exception $e) {
        // Si hay algún error, redirigir con un parámetro de error
        header('Location: usuarios.php?status=error');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Aseguramos que la página ocupe el 100% */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            flex-direction: column;
            min-height: 100%;
            padding-bottom: 30px;
            box-sizing: border-box;
        }

        .fieldset-table {
            border: 2px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            flex-grow: 1;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f1f1f1;
        }

        .btn {
            margin-right: 5px;
        }

        .search-container {
            margin-bottom: 20px;
        }

        .edit-container {
            margin-top: 30px;
        }

        .new-user-container {
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <?php require_once 'nav.php'; ?>

    <div class="container">
        <div class="fieldset-table">
            <legend class="w-auto">
                <h1>Gestión de Usuarios</h1>
            </legend>

            <!-- Formulario para buscar usuarios por nombre o email -->
            <form action="" method="get" class="search-container">
                <div class="mb-3">
                    <label for="buscar" class="form-label">Buscar por Nombre o Email</label>
                    <input type="text" name="buscar" class="form-control" id="buscar"
                        placeholder="Nombre o Email a buscar" value="<?= htmlspecialchars($search) ?>">
                </div>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>

            <hr>

            <!-- Tabla de usuarios -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Provincia</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Mostrar los usuarios -->
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= htmlspecialchars($usuario['nombre']); ?></td>
                            <td><?= htmlspecialchars($usuario['email']); ?></td>
                            <td><?= htmlspecialchars($usuario['telefono']); ?></td>
                            <td><?= htmlspecialchars($usuario['direccion']); ?></td>
                            <td><?= htmlspecialchars($usuario['provincia']); ?></td>
                            <td><?= htmlspecialchars($usuario['rol']); ?></td>
                            <td>
                                <!-- Modificar: Enlace hacia "editar_usuario.php" con target="_blank" -->
                                <a href="editar_usuario.php?email=<?= urlencode($usuario['email']); ?>"
                                    class="btn btn-success btn-sm" >Editar</a>
                                <!-- Eliminar: Enlace con confirmación -->
                                <a href="?eliminar_email=<?= urlencode($usuario['email']); ?>" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <hr>

            <!-- Formulario para crear nuevo usuario -->
            <div class="new-user-container">
                <h2>Dar de Alta Nuevo Usuario</h2>
                <form action="usuarios.php" method="post">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="pass" name="pass" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                    </div>
                    <div class="mb-3">
                        <label for="cp" class="form-label">Código Postal</label>
                        <input type="text" class="form-control" id="cp" name="cp" required>
                    </div>
                    <div class="mb-3">
                        <label for="provincia" class="form-label">Provincia</label>
                        <input type="text" class="form-control" id="provincia" name="provincia" required>
                    </div>
                    <div class="mb-3">
                        <label for="rol" class="form-label">Rol</label>
                        <select class="form-control" id="rol" name="rol" required>
                            <option value="admin">Admin</option>
                            <option value="usuario" selected>Usuario</option>
                        </select>
                    </div>
                    <button type="submit" name="nuevo_usuario" class="btn btn-success">Crear Usuario</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>