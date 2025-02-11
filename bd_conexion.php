<?php
$bd = 'bd_tienda';
$host = 'localhost';
$dsn = "mysql:host=$host;dbname=$bd";
$password_bd = '';
$username_bd = 'root';
 //conexión-bd
 try {
    $conn = new PDO($dsn, $username_bd, $password_bd);
} catch (PDOException $e) {
    print $e->getMessage();
    die();
}
