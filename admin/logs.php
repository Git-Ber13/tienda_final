<!DOCTYPE html>
<html lang="es">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LOGS</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
        <style>
            .container {
                margin-top: 50px;
            }
            
            table,
            th,
            td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            </style>
</head>

<body>
    <?php require_once 'nav.php';

try {
    $conn = new PDO('mysql:host=localhost;dbname=bd_tienda', 'root', '');
    } catch (PDOException $e) {
        die($e);
    }
    try {
        $stmt = $conn->query('SELECT * FROM accesos ORDER BY fecha DESC');
    } catch (\Throwable $th) {
        die($th);
    }
    if (!$stmt) {
        die('Error 404');
    } else {
        ?>
        <div class="container">
            <table class="table table-striped">
                <tr>
                    <td>ID</td>
                    <td>EMAIL</td>
                    <td>PASSWORD</td>
                    <td>IP</td>
                    <td>CORRECTO</td>
                    <td>FECHA</td>
                </tr>
                <?php
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                <td>{$fila['id']}</td>
                <td>{$fila['email']}</td>
                <td>{$fila['pass']}</td>
                <td>{$fila['ip']}</td>
                <td>{$fila['correcto']}</td>
                <td>{$fila['fecha']}</td>
                </tr>";
                }
    }
    ?>
        </table>
    </div>
</body>

</html>