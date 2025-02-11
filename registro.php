<?php
require_once('cabecera.php');
?>

<main class="container">
    <form action="registro_PDO.php" method="post" class="row g-1 needs-validation" novalidate>
        <div class="col-md-3">
            <label for="validationCustom01" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" id="validationCustom01" placeholder="Juan" required>
            <div class="valid-feedback">
                Bonito nombre.
            </div>
        </div>
        <div class="col-md-3">
            <label for="validationCustom02" class="form-label">Contraseña</label>
            <input type="text" name="pass" class="form-control" id="validationCustom02" placeholder="********" required>
            <div class="valid-feedback">
                Contraseña segura.
            </div>
            <div class="invalid-feedback">
                La contraseña no es valida.
            </div>
        </div>
        <div class="col-md-3">
            <label for="validationCustomUsername" class="form-label">Usuario</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@gmail.com</span>
                <input type="text" name="email" placeholder="ejemplo@gmail.com" class="form-control"
                    id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                    El correo no es válido.
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <label for="validationCustom03" class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" id="validationCustom03" required>
            <div class="invalid-feedback">
                El teléfono no es válido.
            </div>
        </div>
        <div class="col-md-3">
            <label for="validationCustom03" class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control" id="validationCustom03" required>
        </div>
        <div class="col-md-3">
            <label for="validationCustom03" class="form-label">Código Postal</label>
            <input type="text" name="cp" class="form-control" id="validationCustom03" required>
        </div>
        <div class="col-md-3">
            <label for="validationCustom03" class="form-label">Provincia</label>
            <input type="text" name="provincia" class="form-control" id="validationCustom03" required>
        </div>        
        </div>
        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                <label class="form-check-label" for="invalidCheck">
                    Acepto los términos y condiciones.
                </label>
                <div class="invalid-feedback">
                    Debes aceptar los términos y condiciones.
                </div>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Registrar</button>
        </div>
        </div>
    </form>
</main>

<?php
require_once('pie.php');
?>