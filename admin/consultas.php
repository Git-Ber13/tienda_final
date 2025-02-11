<?php
$bd = 'bd_tienda';
$host = 'localhost';
$dsn = "mysql:host=$host;dbname=$bd";
$password_bd = '';
$username_bd = 'root';

// Conexión a la base de datos
try {
    $conn = new PDO($dsn, $username_bd, $password_bd);

} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
    die();
}

// Consulta SQL para obtener los productos y sus fotos
$sql = 'SELECT * FROM productos p
LEFT JOIN fotos f 
ON p.id = f.id_producto
ORDER BY p.id DESC';

$stmt = $conn->prepare($sql);  // Prepara la consulta
$stmt->execute();  // Ejecuta la consulta

// Obtener todos los resultados en un array asociativo
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);


