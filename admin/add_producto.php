<?php
require_once '../bd_conexion.php';
// Definir la carpeta de destino para las imágenes
const FOLDER = 'img';  // Especifica la carpeta 'img' donde se guardarán las imágenes

// Insertar producto en la base de datos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['insertar'])) {
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // Insertar producto en la base de datos
    $insert = 'INSERT INTO productos (nombre, categoria, descripcion, precio) VALUES (?, ?, ?, ?)';
    $stmt = $conn->prepare($insert);
    $stmt->bindValue(1, $nombre);
    $stmt->bindValue(2, $categoria);
    $stmt->bindValue(3, $descripcion);
    $stmt->bindValue(4, $precio);
    $stmt->execute();

    // Obtener el ID del producto recién insertado
    $id_insertado = $conn->lastInsertId();

    if (isset($_FILES['foto'])) {
        // Función para validar si el archivo es una imagen válida
        function valida_img($file_type)
        {
            // Tipos de archivo permitidos
            $allowed_file_types = ["image/png", "image/jpeg", "image/jpg", "image/gif"];
            if (!in_array($file_type, $allowed_file_types)) {
                return false;
            }
            return true;
        }

        // Función para transliterar el nombre del archivo (para evitar caracteres especiales)
        function mi_trans($file_name)
        {
            $rules = ":: Any-Latin;
              :: NFD;
              :: [:Nonspacing Mark:] Remove;
              :: NFC;
              :: [^-[:^Punctuation:]] Remove;
              :: Lower();
              [:^L:] { [-] > ;
              [-] } [:^L:] > ;
              [-[:Separator:]]+ > '-';";
            return Transliterator::createFromRules($rules)->transliterate($file_name);
        }

        // Si el directorio no existe, lo creamos
        if (!file_exists(FOLDER)) {
            mkdir(FOLDER, 0777, true);  // Creamos el directorio con permisos adecuados
        }

        // Validamos los archivos subidos
        $file = $_FILES['foto']['name'];
        $fileType = $_FILES['foto']['type'];

        // Validamos el tipo de imagen
        if (valida_img($fileType)) {
            // Obtener la extensión del archivo
            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

            // Crear un nombre único para el archivo con la extensión original
            $filename = FOLDER . '/' . uniqid() . '_' . mi_trans(pathinfo($file, PATHINFO_FILENAME)) . '.' . $fileExtension;

            // Mover el archivo subido a la carpeta de destino
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $filename)) {

                // Insertar la foto asociada al producto en la tabla de fotos
                $insertFoto = 'INSERT INTO fotos (id_producto, ruta) VALUES (?, ?)';
                $stmtFoto = $conn->prepare($insertFoto);
                $stmtFoto->bindValue(1, $id_insertado);
                $stmtFoto->bindValue(2, $filename);
                $stmtFoto->execute();

                // Mensaje de éxito
                echo "<script>alert('Producto insertado correctamente');</script>";
                header('Location: productos.php');  // Redireccionar al inicio
                exit;
            }
        }
    }
}

// Mensaje de éxito
echo "<script>alert('Se ha producido un error');</script>";
header('Location: productos.php');  // Redireccionar al inicio
exit;