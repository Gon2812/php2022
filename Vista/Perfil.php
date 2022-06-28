<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["local"]) || $_SESSION["local"] !== true){
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
            <span class="navbar-brand mb-0 h1">Bienvenido <?php echo htmlspecialchars($_SESSION["username"]); ?></span>
            
            <a href="../Modelo/LogOut.php" class="btn btn-dark ml-3 " >Salir de la sesión</a>
           
        </div>
    </nav>
    <table class="table">
        <tbody>
            <tr>
                <th><a href="../Modelo/LogOut.php" class="btn btn-dark ml-3 ">Historial de compras</a></th>
            </tr>
            <tr>
                <th><a href="./MisComentarios.php" class="btn btn-dark ml-3 ">Mis comentarios</a></th>
            </tr>
        </tbody>
    </table>
        
  


    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bienvenido a este sitio para gente común.;)</h1>

</body>
</html>