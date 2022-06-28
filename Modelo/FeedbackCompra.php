<?php
session_start();
include "../Persistencia/Conexion.php";
$idSesion =$_SESSION['id'];

$id = "";
$date = date("Y/m/d");
$target_path = "";
$type = "local";

$idPago = $_GET["idPago"];
$feedback = $_POST["feedback"];
$insertar = "INSERT INTO feedbackcompra(id, comentario, fecha, idCliente, idPago)
             VALUES ('$id', '$feedback', '$date', '$idSesion', '$idPago')";

$resultado = mysqli_query($conexion, $insertar);

if($resultado){
    echo "<script>alert('Se ha relizado la compra con éxito'); window.location='../Vista/Catalogo.php'</script>";
}
else{
    echo"<script>alert('No se pudo realizar la compra');window,history.go(-1);</script>";
}
mysqli_close($conexion);

?>