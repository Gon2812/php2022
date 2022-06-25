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

<table class="table">
<thead>
    <div class="table__title">Productos</div>
    <tr>
        <th scope="col">Producto</th>
        <th scope="col">Precio</th>
        <th scope="col">Stock</th>
        <th scope="col">Operación</th>
    </tr>
    </thead>
    <tbody>
        <?php $resultado = mysqli_query($conexion, $mercaderia);
        while($row=mysqli_fetch_assoc($resultado)){ ?>
            <tr>
                <td><?php echo $row["nombre"];?> </td>
                <td><?php echo $row["precio"];?></td>
                <td><?php echo $row["stock"];?></td>
                <td>
                    <form action="../Vista/AgregarACarrito2.php" method="post" enctype="multipart/form-data">                   
                        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                        <input type="hidden" name="nombre" value="<?php echo $row["nombre"]; ?>">
                        <input type="hidden" name="precio" value="<?php echo $row["precio"]; ?>">

                        <input type="submit" class="btn btn-primary" value="Agregar a carrito">
                    </form>
                </td>
                <td>
                    <form action="../Vista/Comentar.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                        <input type="text" name="comentario" value=''>
                        <button>Comentar</button>
                    </form>
                </td>
            </tr>
        <?php } mysqli_free_result($resultado)?>
    </tbody>
</table>

</body>
</html>

