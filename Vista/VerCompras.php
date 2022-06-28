<?php
include ("../Persistencia/Conexion.php");

$compras = "SELECT * FROM pago";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Compras</title>
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
                <th scope="col">ID Compra</th>
                <th scope="col">Id Cliente</th>
                <th scope="col">Operacion</th>
            </tr>
        </thead>
            <div class="table__title">Compras</div>
        <tbody>


        <?php $resultado = mysqli_query($conexion, $compras);

        while($row=mysqli_fetch_assoc($resultado)){ ?>
            <tr>
                <th><?php echo $row["id"];?></th>
                <th><?php echo $row["idCliente"];?></th>
                <th> <a href="./VerProductos.php?idPago=<?php echo $row["id"];?>">Ver Productos</a></th>
                <th><a href="./VerComentariosCompra.php?idPago=<?php echo $row["id"];?>">Ver Comentarios</a></th>
            </tr>
        <?php } mysqli_free_result($resultado)?>

        </tbody>
    </table>
    <input type="button" value="Volver" class="btn btn-secondary ml-2" onClick="history.go(-1);">
</body>
</html>