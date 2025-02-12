<?php
// Iniciar sesión
session_start();

// Incluir la conexión a la base de datos
require_once '../bd_conexion.php';

// Si se ha pasado el email por GET, recuperamos los datos del usuario
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    // Preparamos la consulta para obtener los datos del usuario
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $conn->prepare($sql);
    // Vinculamos el parámetro :email con el valor de $email
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    // Recuperamos los datos del usuario
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Lógica para actualizar los datos del usuario cuando se envía el formulario
if (isset($_POST['modificar_usuario'])) {
    // Recuperamos los datos del formulario
    $email_usuario = $_POST['email_usuario'];  // El email original, usado para la comparación en la actualización
    $nombre = $_POST['nombre'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $cp = $_POST['cp'];
    $provincia = $_POST['provincia'];
    $rol = $_POST['rol'];

    // Preparamos la consulta para actualizar los datos del usuario
    $sql_update = "UPDATE usuarios SET nombre = :nombre, pass = :pass, email = :email, telefono = :telefono, direccion = :direccion, cp = :cp, provincia = :provincia, rol = :rol WHERE email = :email_usuario";
    $stmt_update = $conn->prepare($sql_update);

    // Vinculamos los parámetros con los valores correspondientes
    $stmt_update->bindParam(':nombre', $nombre);
    $stmt_update->bindParam(':pass', $pass);  // Aquí no estamos haciendo hash de la contraseña, solo se guarda tal cual
    $stmt_update->bindParam(':email', $email);
    $stmt_update->bindParam(':telefono', $telefono);
    $stmt_update->bindParam(':direccion', $direccion);
    $stmt_update->bindParam(':cp', $cp);
    $stmt_update->bindParam(':provincia', $provincia);
    $stmt_update->bindParam(':rol', $rol);
    $stmt_update->bindParam(':email_usuario', $email_usuario);  // Usamos el email original para el WHERE

    // Ejecutamos la consulta para actualizar el usuario
    if ($stmt_update->execute()) {
        // Si la actualización es exitosa, actualizamos la sesión con el nuevo nombre
        $_SESSION['usuario'] = $nombre;  // Actualizamos el nombre en la sesión
        
        // Mostrar un mensaje de éxito antes de redirigir
        echo "<script>alert('Usuario actualizado correctamente');</script>";

        // Redirigir para refrescar la página y mostrar el nuevo nombre
        header('Location: usuarios.php');
        exit;
    } else {
        // Si hubo un error en la actualización, mostramos un mensaje de error
        echo "<script>alert('Hubo un error al actualizar el usuario');</script>";
    }
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
            padding-bottom: 50px;
        }

        .btn {
            margin-top: 20px;
        }

        /* Asegurar que el formulario y contenido tengan un margen adecuado */
        .form-container {
            margin-bottom: 50px;
        }

        /* Estilo adicional para centrar el texto del nombre de usuario */
        .welcome-message {
            text-align: center;
            font-size: 1.5rem;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <?php require_once 'nav.php'; // Incluir la barra de navegación ?>

    <div class="container">
        <div class="form-container">
            <h2>Editar Usuario: <?= htmlspecialchars($usuario['nombre']) ?></h2>

            <!-- Formulario para editar los datos del usuario -->
            <form action="" method="post">
                <input type="hidden" name="email_usuario" value="<?= htmlspecialchars($usuario['email']); ?>">

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($usuario['email']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario['nombre']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="pass" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="pass" name="pass" value="<?= htmlspecialchars($usuario['pass']); ?>" required>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="mostrar_contraseña">
                    <label class="form-check-label" for="mostrar_contraseña">Mostrar Contraseña</label>
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

    <script>
        const checkbox = document.getElementById('mostrar_contraseña');
        const passwordField = document.getElementById('pass');

        checkbox.addEventListener('change', function () {
            if (checkbox.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    </script>

</body>

</html>
