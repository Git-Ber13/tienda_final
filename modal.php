<?php
require_once 'categorias.php';
$categoria = $_GET['categoria'];

$sql = 'SELECT * FROM   productos p
LEFT JOIN fotos f 
ON p.id = f.id_producto
 WHERE categoria = :categoria';

$stmt = $conn->prepare($sql);
$stmt->bindParam(':categoria', $categoria);
$stmt->execute();

$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($productos as $producto) {
    ?>
    <div class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= $producto['nombre'] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img class="card-img-top" src="<?= $producto['ruta'] ?>" alt="...">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}

?>