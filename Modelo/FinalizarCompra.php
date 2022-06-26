<?php
session_start();
include "../Persistencia/Conexion.php";
$idSesion =$_SESSION['id'];

$borrar = "Delete from carrito where id_cliente='$idSesion'";

$resultado = mysqli_query($conexion, $borrar);

if($resultado){
    echo "<script>alert('Se ha relizado la compra con éxito'); window.location='../Vista/Catalogo.php'</script>";
}
else{
    echo"<script>alert('No se pudo realizar la compra');window,history.go(-1);</script>";
}
mysqli_close($conexion);