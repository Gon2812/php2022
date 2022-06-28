<?php
include ("../Persistencia/Conexion.php");
$mercaderia = "SELECT * FROM mercaderia";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrar un Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container-table">
    <div class="table__title">Mercadería<a href="./AgregarProducto.php" class="title_edit">Agregar</a></div>
        <div class="table__header">Producto</div>
        <div class="table__header">Precio</div>
        <div class="table__header">Stock</div>
        <div class="table__header">Operación</div>
        <?php $resultado = mysqli_query($conexion, $mercaderia);
        while($row=mysqli_fetch_assoc($resultado)){ ?>
            
            <div class="table__item"><?php echo $row["nombre"];?></div>
            <div class="table__item"><?php echo $row["precio"];?></div>
            <div class="table__item"><?php echo $row["stock"];?></div>
            <div class="table__item">
                <a href="./VerComentarios.php?id=<?php echo $row["id"];?>" class="table__item__link">Comentarios</a> |
                <a href="./ModificarProducto.php?id=<?php echo $row["id"];?>" class="table__item__link">Editar</a> |
                <a href="../Modelo/EliminarProducto.php?id=<?php echo $row["id"];?>" class="table__item__link">Eliminar</a>
            </div>
        <?php } mysqli_free_result($resultado)?>
    </div>
</body>
</html>

