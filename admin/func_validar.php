<?php
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
?>