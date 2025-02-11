<?php
// Aquí va la lógica PHP para editar el usuario
require_once '../bd_conexion.php';

if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Lógica para actualizar usuario
if (isset($_POST['modificar_usuario'])) {
    $email_usuario = $_POST['email_usuario'];
    $nombre = $_POST['nombre'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $cp = $_POST['cp'];
    $provincia = $_POST['provincia'];
    $rol = $_POST['rol'];

    $sql_update = "UPDATE usuarios SET nombre = :nombre, pass = :pass, email = :email, telefono = :telefono, direccion = :direccion, cp = :cp, provincia = :provincia, rol = :rol WHERE email = :email_usuario";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bindParam(':nombre', $nombre);
    $stmt_update->bindParam(':pass', $pass);
    $stmt_update->bindParam(':email', $email);
    $stmt_update->bindParam(':telefono', $telefono);
    $stmt_update->bindParam(':direccion', $direccion);
    $stmt_update->bindParam(':cp', $cp);
    $stmt_update->bindParam(':provincia', $provincia);
    $stmt_update->bindParam(':rol', $rol);
    $stmt_update->bindParam(':email_usuario', $email_usuario);
    $stmt_update->execute();

    echo "<script>alert('Usuario actualizado correctamente');</script>";
    header('Location: usuarios.php');  // Redirigir para refrescar la página
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Añadir margen al formulario para que no quede pegado al fondo */
        .container {
            padding-bottom: 50px; /* Ajusta este valor según el espacio que desees */
        }

        .btn {
            margin-top: 20px;
        }

        /* Asegurar que el formulario y contenido tengan un margen adecuado */
        .form-container {
            margin-bottom: 50px;
        }
    </style>
</head>

<body>

    <?php require_once 'nav.php'; ?>

    <div class="container">
        <div class="form-container">
            <h2>Editar Usuario: <?= htmlspecialchars($usuario['nombre']) ?></h2>
            <form action="" method="post">
                <!-- Campo Email editable -->
                <div class="mb-3">
                    <label for="email_usuario" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email_usuario" name="email_usuario" value="<?= htmlspecialchars($usuario['email']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario['nombre']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="pass" name="pass" value="<?= htmlspecialchars($usuario['pass']); ?>" required>
                </div>
                
                <!-- Opción para mostrar/ocultar contraseña -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="mostrar_contraseña">
                    <label class="form-check-label" for="mostrar_contraseña">
                        Mostrar Contraseña
                    </label>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="<?= htmlspecialchars($usuario['telefono']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" value="<?= htmlspecialchars($usuario['direccion']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="cp" class="form-label">Código Postal</label>
                    <input type="text" class="form-control" id="cp" name="cp" value="<?= htmlspecialchars($usuario['cp']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="provincia" class="form-label">Provincia</label>
                    <input type="text" class="form-control" id="provincia" name="provincia" value="<?= htmlspecialchars($usuario['provincia']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="rol" class="form-label">Rol</label>
                    <select class="form-control" id="rol" name="rol" required>
                        <option value="admin" <?= $usuario['rol'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                        <option value="usuario" <?= $usuario['rol'] == 'usuario' ? 'selected' : ''; ?>>Usuario</option>
                    </select>
                </div>
                <button type="submit" name="modificar_usuario" class="btn btn-primary">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script para mostrar u ocultar la contraseña -->
    <script>
        // Obtener el checkbox y el campo de contraseña
        const checkbox = document.getElementById('mostrar_contraseña');
        const passwordField = document.getElementById('pass');

        // Añadir un evento de cambio al checkbox
        checkbox.addEventListener('change', function() {
            // Cambiar el tipo del campo de contraseña entre 'password' y 'text'
            if (checkbox.checked) {
                passwordField.type = 'text'; // Mostrar la contraseña
            } else {
                passwordField.type = 'password'; // Ocultar la contraseña
            }
        });
    </script>

</body>

</html>
