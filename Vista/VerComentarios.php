<?php
include ("../Persistencia/Conexion.php");

//obtener la url actual
$url = $_SERVER['REQUEST_URI'];
$url_components = parse_url($url);
// parse_str() para parsear el string que se envia en la url
parse_str($url_components['query'], $params);
      
// id del producto en cuestion
$id = $params['id'];
$reseñasCompras = "SELECT * FROM feedbackcompra WHERE id = $id";
$comentariosProductos = "SELECT * FROM feedbackproducto WHERE id = $id";
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
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Comentario</th>
                <th scope="col">Fecha</th>
                <th scope="col">ID Cliente</th>
                <th scope="col">ID Pago</th>
            </tr>
        </thead>
            <div class="table__title">Reseñas</div>
        <tbody>


        <?php $resultado = mysqli_query($conexion, $reseñasCompras);
        while($row=mysqli_fetch_assoc($resultado)){ ?>
            <tr>
                <th><?php echo $row["id"];?></th>
                <th><?php echo $row["comentario"];?></th>
                <th><?php echo $row["fecha"];?></th>
                <th><?php echo $row["idCliente"];?></th>
                <th><?php echo $row["idPago"];?></th>
            </tr>
        <?php } mysqli_free_result($resultado)?>

        </tbody>
    </table>

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

        <?php $resultado2 = mysqli_query($conexion, $comentariosProductos);
        while($row=mysqli_fetch_assoc($resultado2)){ ?>
            <tr>
                <th><?php echo $row["id"];?></th>
                <th><?php echo $row["comentario"];?></th>
                <th><?php echo $row["fecha"];?></th>
                <th><?php echo $row["idCliente"];?></th>
            </tr>
        <?php } mysqli_free_result($resultado2)?>
        </tbody>
    </table>
</body>
</html>