<?php
session_start();
require_once '../admin_check.php';
require_once '../bd_conexion.php';
// Eliminar producto si se recibe el id desde POST
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $id_delete = $_POST['id'];

    // Verificar si el id es válido (es un número entero)
    if (filter_var($id_delete, FILTER_VALIDATE_INT)) {
        // Consulta para eliminar el producto seleccionado
        $delete = "DELETE FROM fotos
                    WHERE id_producto = :id";
        $deleteStmt = $conn->prepare($delete);
        $deleteStmt->bindParam(':id', $id_delete, PDO::PARAM_INT);
        $deleteStmt->execute();


        $deleteProducto = "DELETE FROM productos
                           WHERE id = :id";
        $deleteProductoStmt = $conn->prepare($deleteProducto);
        $deleteProductoStmt->bindParam(':id', $id_delete, PDO::PARAM_INT);
        $deleteProductoStmt->execute();

        // Mensaje de confirmación
        echo "<script>alert('Producto eliminado');</script>";
        header('Location: productos.php');  // Redirecciona a productos.php
        exit;
    }
}