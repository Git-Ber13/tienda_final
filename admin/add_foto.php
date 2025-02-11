<?php
require_once '../bd_conexion.php';
require_once 'func_validar.php'; // Incluir las funciones comunes

// Definir la carpeta de destino para las imágenes
const FOLDER = 'img';  // Especifica la carpeta 'img' donde se guardarán las imágenes

// Si el directorio no existe, lo creamos
if (!file_exists(FOLDER)) {
    mkdir(FOLDER, 0777, true);  // Creamos el directorio con permisos adecuados
}

// Verificamos que el formulario haya sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {
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
        $success = move_uploaded_file($_FILES['foto']['tmp_name'], $filename);

        // Devolver el resultado
        $resultado[] = [
            'success' => $success,
            'file' => $filename // Ruta del archivo movido
        ];
    } else {
        // Si la validación falla, retornamos un error
        $resultado[] = [
            'success' => false,
            'file' => $file
        ];
    }
}
