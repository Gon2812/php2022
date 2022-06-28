<?php
include ("../Persistencia/Conexion.php");

//obtener la url actual
$url = $_SERVER['REQUEST_URI'];
$url_components = parse_url($url);
// parse_str() para parsear el string que se envia en la url
parse_str($url_components['query'], $params);
      
// id del producto en cuestion
$id = $params['idPago'];

$comentariosCompra = "SELECT * FROM feedbackcompra WHERE idPago = $id";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Comentarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <div class="table__title">Comentarios</div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Comentario</th>
                <th scope="col">Fecha</th>
                <th scope="col">ID Cliente</th>
            </tr>
        </thead>

        <tbody>

        <?php $resultado2 = mysqli_query($conexion, $comentariosCompra);
        while($row2=mysqli_fetch_assoc($resultado2)){ ?>
            <tr>
                <th><?php echo $row2["id"];?></th>
                <th><?php echo $row2["comentario"];?></th>
                <th><?php echo $row2["fecha"];?></th>
                <th><?php echo $row2["idCliente"];?></th>
            </tr>
        <?php } mysqli_free_result($resultado2)?>
        </tbody>
    </table>
</body>
</html>