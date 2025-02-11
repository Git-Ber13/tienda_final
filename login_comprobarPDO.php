<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $pass = $_POST['password'] ?? '';
    // Conexión a la base de datos
    require_once('bd_conexion.php');

    // Preparar consulta
    $sql = 'SELECT * FROM usuarios WHERE email = :email AND pass = :pass';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $usuario);
    $stmt->bindParam(':pass', $pass);

    // Ejecución
    if (!$stmt->execute()) {
        die("Error en la consulta");
    }

    // Filas devueltas
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $total = count($resultados);

    //debug
    // print_r($resultados);
    // die();

    // Control de acceso
    $ip = $_SERVER['REMOTE_ADDR'];
    $sql_log = 'INSERT INTO accesos(email, pass, ip, correcto) VALUES(?, ?, ?, ?)';
    $insert_stmt = $conn->prepare($sql_log);
    $correcto = ($total === 1) ? 1 : 0;

    // Inserta log de acceso
    $insert_stmt->bindParam(1, $usuario);
    $insert_stmt->bindParam(2, $pass);
    $insert_stmt->bindParam(3, $ip);
    $insert_stmt->bindParam(4, $correcto, PDO::PARAM_INT);
    $insert_stmt->execute();

    // Fin control acceso

    if ($total !== 1) {
        $_SESSION['error'] = "Usuario o contraseña incorrectos";
        header('Location: login.php');
    } else {
        // Guardar datos del usuario en la sesión
        $_SESSION['usuario'] = $resultados[0]['nombre'];
        $_SESSION['rol'] = $resultados[0]['rol'];
        $_SESSION['id_usuario'] = $resultados[0]['email'];  // Aquí se guarda el id del usuario
        unset($_SESSION['error']);
        header('Location: index.php');
    }
    exit();
}
?>
