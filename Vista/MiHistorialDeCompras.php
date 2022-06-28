<?php
include ("../Persistencia/Conexion.php");
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["local"]) || $_SESSION["local"] !== true){
    header("location: ../Vista/IniciarSesion.php");
    exit;
}
$idSesion = $_SESSION['id'];
$reseñasComprasUsuario = "SELECT * FROM feedbackcompra WHERE idCliente = $idSesion";
$comentariosProductosUsuario = "SELECT * FROM feedbackproducto WHERE idCliente = $idSesion";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Comentarios</title>
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
                <th scope="col">Producto</th>
                <th scope="col">Comentario</th>
                <th scope="col">Fecha</th>
            </tr>
        </thead>
            <div class="table__title">Mi Historial de compras</div>
        <tbody>


        <?php $resultado = mysqli_query($conexion, $reseñasComprasUsuario);

        while($row=mysqli_fetch_assoc($resultado)){ ?>
            <?php $idProductoReseña = (int)$row["idMercaderia"];?>
            <tr>
                <th><?php echo mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM mercaderia WHERE id = $idProductoReseña"))["nombre"];?></th>
                <th><?php echo $row["comentario"];?></th>
                <th><?php echo $row["fecha"];?></th>
            </tr>
        <?php } mysqli_free_result($resultado)?>

        </tbody>
    </table>
</body>
</html>