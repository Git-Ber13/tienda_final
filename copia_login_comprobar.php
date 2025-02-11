<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $pass = $_POST['password'] ?? '';
    //conexión bd
    require_once('bd_conexion.php');

    //preparar consulta
    $sql = 'SELECT * FROM usuarios WHERE email = :email AND pass = :pass';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $usuario);
    $stmt->bindParam(':pass', $pass);

    //ejecución
    if (!$stmt->execute()) {
        die("Error en la consulta");
    }
    //filas devueltas
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $total = count($resultados);
    //control de acceso
    $ip = $_SERVER['REMOTE_ADDR'];
    $sql_log = 'INSERT INTO accesos(email,pass,ip,correcto) VALUES(?,?,?,?)';
    $insert_stmt = $conn->prepare($sql_log);
    $correcto = ($total ===1) ? 1: 0;
    //inserta
    $insert_stmt->bindParam(1,$usuario);
    $insert_stmt->bindParam(2,$pass);
    $insert_stmt->bindParam(3,$ip);
    $insert_stmt->bindParam(4,$correcto, PDO::PARAM_INT );
    //ejecuta
    $insert_stmt->execute();
    //fin control acceso

    if ($total !== 1) {
        $_SESSION['error'] = "Usuario o contraseña incorrectos";
        header('Location: login.php');
    } else {
        $_SESSION['usuario'] = $resultados[0]['nombre'];
        $_SESSION['rol'] = $resultados[0]['rol'];
        unset($_SESSION['error']);
        header('Location: index.php');
    }
    exit();
}

?>