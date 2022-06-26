<?php

include ("../Persistencia/Conexion.php");
$mercaderia = "SELECT * FROM mercaderia";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Catalogo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <div class="container-table">
        <div class="table__title">Productos</div>
        <div class="table__header">Producto</div>
        <div class="table__header">Precio</div>
        <div class="table__header">Stock</div>
        <div class="table__header">Operación</div>
        <?php $resultado = mysqli_query($conexion, $mercaderia);?>

        <?php $contador = 1;
                foreach($resultado as $fila){ ?>
            
            <div class="table__item"><?php echo $fila["nombre"];?> </div>
            <div class="table__item"><?php echo $fila["precio"];?></div>
            <div class="table__item"><?php echo $fila["stock"];?></div>
            

            <form action="../Vista/AgregarACarrito2.php" method="post" enctype="multipart/form-data">
            <div class="table__item">
                <input type="hidden" name="id" value="<?php echo $fila["id"]; ?>">
                <input type="hidden" name="nombre" value="<?php echo $fila["nombre"]; ?>">
                <input type="hidden" name="precio" value="<?php echo $fila["precio"]; ?>">

                <input type="submit" class="btn btn-primary" value="Agregar a carrito">
            </div>
            </form>
            <?php $contador = $contador + 1; } ?>
    
    </div>
</body>
</html>

