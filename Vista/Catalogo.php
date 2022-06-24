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
<form action="../Vista/AgregarACarrito2.php" method="post" enctype="multipart/form-data">
    <div class="container-table">
        <div class="table__title">Productos</div>
        <div class="table__header">Producto</div>
        <div class="table__header">Precio</div>
        <div class="table__header">Stock</div>
        <div class="table__header">Operación</div>
        <?php $resultado = mysqli_query($conexion, $mercaderia);
        while($row=mysqli_fetch_assoc($resultado)){ ?>
            
            <div class="table__item"><?php echo $row["nombre"];?> </div>
            <div class="table__item"><?php echo $row["precio"];?></div>
            <div class="table__item"><?php echo $row["stock"];?></div>
            <div class="table__item">
            
            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
            <input type="hidden" name="nombre" value="<?php echo $row["nombre"]; ?>">
            <input type="hidden" name="precio" value="<?php echo $row["precio"]; ?>">

            <input type="submit" class="btn btn-primary" value="Agregar a carrito">
            </div>
        <?php } mysqli_free_result($resultado)?>
    </div>
</body>
</html>

