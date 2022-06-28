<?php
session_start();
include ("../Persistencia/Conexion.php");
$idSesion =$_SESSION['id'];
$carrito = "SELECT * FROM carrito WHERE id_cliente = '$idSesion' ";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carrito</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
    <link rel="stylesheet" href="estiloCarrito.css">
</head>
<body>

    <div class="container-table">
        <div class="table__title">Carrito</div>
        <div class="table__header">Producto</div>
        <div class="table__header">Cantidad</div>
        <div class="table__header">Precio</div>
        
        <?php $resultado = mysqli_query($conexion, $carrito);
          $total = 0;
        while($fila=mysqli_fetch_assoc($resultado)){ ?>
            
            <div class="table__item"><?php echo $fila["nombreProducto"];?> </div>
            <div class="table__item"><?php echo $fila["cantidad"];?></div>
            <div class="table__item">$ <?php echo $fila["precio"];?></div>
            <?php
                $total = $total + $fila['total'];

            }?>
            <div class="table__footer">Total $ <?php echo $total;?></div>
            
           
            <?php mysqli_free_result($resultado)?>
    </div>
    <div col-auto class="row justify-content-center"> 
            <a href="../Vista/MetodosPago.php" class="btn btn-primary ml-3 " >Finalizar Compra</a>
            <input type="button" value="Volver" class="btn btn-secondary ml-2" onClick="history.go(-1);">
    </div>
</body>
</html>

