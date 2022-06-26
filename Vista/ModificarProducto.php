<?php
include ("../Persistencia/Conexion.php");

//obtener la url actual
$url = $_SERVER['REQUEST_URI'];
$url_components = parse_url($url);
// parse_str() para parsear el string que se envia en la url
parse_str($url_components['query'], $params);
      
// id del producto en cuestion
$id = $params['id'];
$mercaderia = "SELECT * FROM mercaderia WHERE id = $id";
$imagen = "SELECT * FROM imgmercaderia WHERE idMercaderia = $id";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modificar Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Modificar Producto</h2>
        <?php
            // Verificamos si el usuario está logueado.
            if(isset($_SESSION["usuario"]) && $_SESSION["usuario"] === true){
                echo "Que carajos estás haciendo acá!?";
                header("location: ../Vista/MenuPrincipal.php");
                exit;
            }
        ?>
        <form action="../Modelo/ModificarProducto.php" method="post" enctype="multipart/form-data">
        
            <?php $resultado = mysqli_query($conexion, $mercaderia);
            while($row=mysqli_fetch_assoc($resultado)){ ?>

                <input type="hidden" name="productId" class="form-control" value="<?php echo $row["id"];?>">
                <div class="form-group">
                    <label>Nombre del Producto</label>
                    <input type="text" name="productName" class="form-control <?php echo (!empty($productName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $row["nombre"];?>">
                    <span class="invalid-feedback"><?php echo $productName_err; ?></span>
                </div>    
                <div class="form-group">
                    <label>Precio</label>
                    <input type="number" name="price" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $row["precio"];?>">
                    <span class="invalid-feedback"><?php echo $price_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Stock</label>
                    <input type="number" name="stock" class="form-control <?php echo (!empty($stock_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $row["stock"];?>">
                    <span class="invalid-feedback"><?php echo $stock_err; ?></span>
                </div>

                <div class="form-group">
                    <label>Imagenes</label>
                    
                    <?php $resultado2 = mysqli_query($conexion, $imagen);
                     while($row2=mysqli_fetch_assoc($resultado2)){ ?>
                        <img src="<?php echo $row2["nombre"];?>">
                    <?php } mysqli_free_result($resultado2)?>
                    <label>Cambiar imagenes</label>
                    <input type="file" id="image[]" name="image[]" class="form-control <?php echo (!empty($image_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $image; ?>" multiple="">
                    <span class="invalid-feedback"><?php echo $image_err; ?></span>
                </div> 

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Enviar">
                    <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                </div>
                
            <?php } mysqli_free_result($resultado)?>

        </form>
    </div>    
</body>
</html>