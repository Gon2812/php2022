<?php
session_start();
include "../Persistencia/Conexion.php";
$idSesion =$_SESSION['id'];

$carrito = mysqli_query($conexion, "SELECT * FROM carrito WHERE id_cliente='$idSesion'");

while($c=mysqli_fetch_assoc($carrito)){
    $idProductoEliminar = $c["id_producto"];
    $stockProductoActual = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM mercaderia WHERE id=$idProductoEliminar"))["stock"];
    $stockProductoEliminar = $c["cantidad"];
    $nuevoStockProducto = (int)$stockProductoActual - (int)$stockProductoEliminar;

    $cambiarStock = "UPDATE mercaderia SET stock = $nuevoStockProducto WHERE id=$idProductoEliminar";
    $resultadoCambioStock = mysqli_query($conexion, $cambiarStock);
}mysqli_free_result($carrito);

$borrar = "Delete from carrito where id_cliente='$idSesion'";

$resultado = mysqli_query($conexion, $borrar);

if($resultadoCambioStock && $resultado){
    echo "<script>alert('Se ha relizado la compra con éxito'); window.location='../Vista/Catalogo.php'</script>";
}
else{
    echo"<script>alert('No se pudo realizar la compra');window,history.go(-1);</script>";
}
mysqli_close($conexion);