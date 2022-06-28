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

    <div class="container mx-auto">
        <div class="table__title">Productos</div>
        <div class="row">

        <?php $resultado = mysqli_query($conexion, $mercaderia);?>

        <?php $contador = 1;
                foreach($resultado as $fila){ ?>
            <?php $filaID = $fila["id"];
            $filaImagen = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM imgmercaderia WHERE idMercaderia = '$filaID'"))?>

            <div class="col-4">
                <div class="card">
                    <img class="card-img-top" src="<?php echo $filaImagen["nombre"];?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $fila["nombre"];?></h5>
                        <p class="card-text">Precio: $<?php echo $fila["precio"];?></p>
                        <p class="card-text">Stock: <?php echo $fila["stock"];?></p>
                        <form action="../Vista/AgregarACarrito2.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $fila["id"]; ?>">
                            <input type="hidden" name="nombre" value="<?php echo $fila["nombre"]; ?>">
                            <input type="hidden" name="precio" value="<?php echo $fila["precio"]; ?>">

                            <input type="submit" class="btn btn-primary" value="Agregar a carrito">
                        </form>
                        <div>
                            <form action="../Vista/Comentar.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $fila["id"]; ?>">
                                <input type="text" name="comentario">
                                <input type="submit" value="Comentar">
                            </form>
                        </div>
                    </div>
                </div>         
            </div>
            <?php $contador = $contador + 1; } ?>
        </div>
    </div>
    
    </div>
</body>
</html>

