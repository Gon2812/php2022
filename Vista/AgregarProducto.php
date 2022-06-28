<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agregar un Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="container mx-auto mt-5">
        <h2>Agregar un Producto</h2>
        <?php
            // Verificamos si el usuario está logueado.
            if(isset($_SESSION["usuario"]) && $_SESSION["usuario"] === true){
                echo "Que carajos estás haciendo acá!?";
                header("location: ../Vista/MenuPrincipal.php");
                exit;
            }
            //include "../Modelo/AgregarProducto.php"
        ?>
        <form action="../Modelo/AgregarProducto.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="productId" class="form-control" value="">
            <div class="form-group">
                <label>Nombre del Producto</label>
                <input type="text" name="productName" class="form-control <?php echo (!empty($productName_err)) ? 'is-invalid' : ''; ?>" value="">
                <span class="invalid-feedback"><?php echo $productName_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Precio</label>
                <input type="number" name="price" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $price; ?>">
                <span class="invalid-feedback"><?php echo $price_err; ?></span>
            </div>
            <div class="form-group">
                <label>Stock</label>
                <input type="number" name="stock" class="form-control <?php echo (!empty($stock_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $stock; ?>">
                <span class="invalid-feedback"><?php echo $stock_err; ?></span>
            </div>

            <div class="form-group">
                <label>Imagenes</label>
                <input type="file" id="image[]" name="image[]" class="form-control <?php echo (!empty($image_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $image; ?>" multiple="">
                <span class="invalid-feedback"><?php echo $image_err; ?></span>
            </div> 

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Agregar">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                <input type="button" value="Volver" class="btn btn-secondary ml-2" onClick="history.go(-1);">
            </div>
        </form>
    </div>
</body>
</html>