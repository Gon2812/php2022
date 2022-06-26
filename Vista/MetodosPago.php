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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
</head>
<body>



<form action="../Modelo/FinalizarCompra.php" method="post" enctype="multipart/form-data">
<div class="col-md-4 container center_div">
    <h2 class="my-5">Metodos de Pago</h2>
</div>
  <div class="col-md-4 container center_div">
  <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label for="">Tarjeta de credito</label>
  </div>

  <div class="col-md-4 container center_div">
  <input type="checkbox" class="form-check-input" id="exampleCheck2">
    <label  for="">Efectivo</label>
  </div>

  <div col-auto class="row justify-content-center"> 
    <button type="submit" class="btn btn-primary">Comprar</button>
   </div>
</form>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>

