<?php
include "../Persistencia/Conexion.php";

$idSesion = session_id();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agregar a carrito</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>

    <div class="wrapper">
        <h2>Agregar a carrito</h2>

        <?php 
       
        
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="../Modelo/AgregarACarrito.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Cantidad</label>
                <input type="number" name="cantidad" class="form-control " value="<?php echo $cantidad; ?>">
            </div>    

            <div class="form-group">
                <label>Nombre del Producto</label>
                <label><?php echo ($_POST['nombre'] ) ?></label>
                <input type="text" readonly name="productName" class="form-control " value="<?php echo($_POST['nombre'] ) ?>">
            </div>    
            <div class="form-group">
                <label>Precio</label>
                <input type="number" readonly name="price" class="form-control " value="<?php echo($_POST['precio'] ) ?>">
            </div>

            <div class="form-group">
            <input type="hidden" readonly name="id" class="form-control" value="<?php echo($_POST['id'] ) ?>">
            </div>
        
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Agregar">
            </div>
        </form>
    </div>
</body>
</html>