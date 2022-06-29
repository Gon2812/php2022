<?php
// Initialize the session
session_start();
 
include ("../Persistencia/Conexion.php");



// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["local"]) || $_SESSION["local"] !== true){
    header("location: ../Vista/IniciarSesion.php");
    exit;
}
$idUsuario = $_SESSION["id"];
$usuario = "SELECT * FROM cliente WHERE id = $idUsuario";
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
    <link rel="stylesheet" href="estiloUsuario.css">
</head>
<body>
    <nav class="navbar bg-light">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Bienvenido <?php echo htmlspecialchars($_SESSION["username"]); ?></span>
            
            <a href="../Modelo/LogOut.php" class="btn btn-dark ml-3 " >Salir de la sesión</a>
           
        </div>
    </nav>        

    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <a href="./MiHistorialDeCompras.php" class="btn btn-lg btn-dark">Historial de compras</a>
            </div>
            <div class="col-6">
                <a href="./MisComentarios.php" class="btn btn-lg btn-dark">Mis comentarios</a>
            </div>
        </div>
    </div>

    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bienvenido a este sitio para gente común.;)</h1>
    
    <div class="container-table container-table--edit2">
        <div class="row">
            <div class="col">Nombre</div>
            <div class="col">Correo</div>
            <div class="col">Nombre de Usuario</div>
        </div>

    <?php $resultado = mysqli_query($conexion, $usuario);
        while($row=mysqli_fetch_assoc($resultado)){ ?>   
            <div class="row">        
                <div class="col"><?php echo $row["nombre"];?></div>
                <div class="col"><?php echo $row["correo"];?></div>
                <div class="col"><?php echo $row["nombreUsuario"];?></div> 
            </div>         
        <?php 
    } mysqli_free_result($resultado)?>
    </div>

    <input type="button" value="Volver" class="btn btn-secondary ml-2" onClick="history.go(-1);">
</body>
</html>