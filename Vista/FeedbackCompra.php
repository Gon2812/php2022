<?php
session_start();
include ("../Persistencia/Conexion.php");
//$idSesion =$_SESSION['id'];
//$carrito = "SELECT * FROM carrito WHERE id_cliente = '$idSesion' ";
$idPago = $_GET["idPago"];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback Compra</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
    <link rel="stylesheet" href="estiloCarrito.css">
</head>
<body>
<form action="../Modelo/FeedbackCompra.php?idPago=<?php echo($idPago);?>" method="post" enctype="multipart/form-data"> 
<div class="form-group ">
    <label for="exampleFormControlTextarea1">Feedback Compra</label>
    <textarea class="form-control" id="feedback" rows="3" name="feedback"></textarea>
  </div>

  <div col-auto class="row justify-content-center"> 
    <button type="submit" class="btn btn-primary">Enviar</button>
   </div>
</form>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>