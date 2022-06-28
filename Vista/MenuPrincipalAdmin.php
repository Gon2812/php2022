<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true){
    header("location: ../Vista/IniciarSesion.php");
    exit;
}
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
</head>
<body>
    <nav class="navbar bg-light">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Bienvenido Administrador <?php echo htmlspecialchars($_SESSION["username"]); ?></span>
            <a href="../Modelo/LogOut.php" class="btn btn-dark ml-3" >Salir de la sesión</a>
        </div>
    </nav>

    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bienvenido a este sitio para administradores.</h1>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="./AdministrarProducto.php" class="btn btn-lg btn-dark">Administrar Productos</a>
            </div>
            <div class="col-12">
                <a href="./AdministrarUsuario.php" class="btn btn-lg btn-dark">Administrar Usuarios</a>
            </div>
            <div class="col-12">
            <a href="./VerCompras.php" class="btn btn-lg btn-dark">Ver Compras</a>
            </div>
        </div>
    </div>
</body>
</html>