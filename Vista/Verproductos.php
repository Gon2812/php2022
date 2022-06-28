<?php
include ("../Persistencia/Conexion.php");
//obtener la url actual
$url = $_SERVER['REQUEST_URI'];
$url_components = parse_url($url);
// parse_str() para parsear el string que se envia en la url
parse_str($url_components['query'], $params);
      
// id del producto en cuestion
$id = $params['idPago'];

$productos = "SELECT * FROM pagoMercaderia WHERE idPago = '$id'";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Productos</title>
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
                <th scope="col">Id mercaderia</th>
                <th scope="col">Nombre</th>
                <th scope="col">cantidad</th>
            </tr>
        </thead>
            <div class="table__title">Productos</div>
        <tbody>


        <?php $resultado = mysqli_query($conexion, $productos);

        while($row=mysqli_fetch_assoc($resultado)){ ?>
        <?php $idProducto = (int)$row["idMercaderia"];?>
            <tr>
                <th><?php echo $row["idMercaderia"];?></th>
                <th><?php echo mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM mercaderia WHERE id = $idProducto"))["nombre"];?></th>
                <th><?php echo $row["cantidad"];?></th>
            </tr>
        <?php } mysqli_free_result($resultado)?>

        </tbody>
    </table>

</body>
</html>