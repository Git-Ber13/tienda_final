<?php

if (isset($_POST['nombre']) && isset($_POST['pass']) && isset($_POST['email']) && isset($_POST['telefono']) && isset($_POST['direccion']) && isset($_POST['rol'])) {
    require_once 'bd_conexion.php';
    $insert = 'INSERT INTO usuarios (nombre,pass,email,telefono,direccion,cp,provincia,rol) VALUES (:nombre,:pass,:email,:telefono,:direccion,:cp,:provincia)';
    $stm_insert = $conn->prepare($insert);
    $stm_insert->bindValue(':nombre', $_POST['nombre']);
    $stm_insert->bindValue(':pass', $_POST['pass']);
    $stm_insert->bindValue(':email', $_POST['email']);
    $stm_insert->bindValue(':telefono', $_POST['telefono']);
    $stm_insert->bindValue(':direccion', $_POST['direccion']);
    $stm_insert->bindValue(':cp', $_POST['cp']);
    $stm_insert->bindValue(':provincia', $_POST['provincia']);
    // $stm_insert->bindValue(':rol', $_POST['rol']);


    try {
        $ok = $stm_insert->execute();
    } catch (\Throwable $th) {
        $ok = false;
        echo $th;
    }
?>
    <script src="sweetalert2.all.min.js"></script>
<?php
    if ($ok) {
        echo"ok";
        ?>
        <script>
            Swal.fire({
                title: "¡Registrado!",
                text: "El usuario ha sido registrado correctamente.",
                icon: "success"
            });
        </script>
        <?php
    } else {
        ?>
        <script>
            Swal.fire({
                icon: "error",
                title: "Algo salió mal",
                text: "No se ha podido registrar el usuario, comprueba los datos.",
                footer: '<a href="registro.php">Volver a intentarlo</a>'
            });
        </script>
        <?php
    }
}

?>