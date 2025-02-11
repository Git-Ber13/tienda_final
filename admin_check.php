<?php

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
} else {
    $haylogin = $_SESSION['usuario'];
    $admin = $_SESSION['rol'];
    
    if ($admin != 'admin') {
        header('Location: ../login.php');
        exit();
    }
}