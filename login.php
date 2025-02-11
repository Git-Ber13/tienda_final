<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="tienda_css/stilo.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <header>
        <div class="d-flex  justify-content-between">
            Iniciar sesión
            <a href="index.php" class>
                <button type="button" class="btn btn-danger">Cancelar</button>
            </a>

        </div>
    </header>
    <main>
        <form method="POST" action="login_comprobarPDO.php">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" placeholder="Ingresa aquí tu email" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" placeholder="********" required>
            <button type="submit">Iniciar sesión</button>
        </form>
        <?php if (isset($_SESSION['error'])): ?>
                <p class="error text-center"><?= $_SESSION['error']; ?></p>
        <?php endif; ?>
    </main>
</body>

</html>