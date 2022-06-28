<?php
session_start();
include "../Persistencia/Conexion.php";
$idSesion =$_SESSION['id'];

$carrito = mysqli_query($conexion, "SELECT * FROM carrito WHERE id_cliente='$idSesion'");
$idMayor =  mysqli_query($conexion,"SELECT Max(id) As idpago FROM pago");
$idVacio = "";

while($c=mysqli_fetch_assoc($carrito)){
    $idProductoEliminar = $c["id_producto"];
    $stockProductoActual = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM mercaderia WHERE id=$idProductoEliminar"))["stock"];
    $stockProductoEliminar = $c["cantidad"];
    $nuevoStockProducto = (int)$stockProductoActual - (int)$stockProductoEliminar;

    $cambiarStock = "UPDATE mercaderia SET stock = $nuevoStockProducto WHERE id=$idProductoEliminar";
    $resultadoCambioStock = mysqli_query($conexion, $cambiarStock);
    $total = 0;
    while($i=mysqli_fetch_assoc($idMayor)){
        $id = $i["idpago"]+1;
        $cantidad = $c["cantidad"];
        $total = $total + $c['total'];
        $pago="INSERT INTO pago(id, idCliente, total) VALUES('$id','$idSesion', '$total')";
        $resultadoInsertPago = mysqli_query($conexion, $pago);
    }
    $pagoMercaderia="INSERT INTO pagomercaderia(id, idPago, idMercaderia, cantidad) VALUES('$idVacio','$id','$idProductoEliminar', '$cantidad')";
    $resultadoInsertPagoMercaderia = mysqli_query($conexion, $pagoMercaderia);
    
}mysqli_free_result($carrito);



$borrar = "Delete from carrito where id_cliente='$idSesion'";

$resultado = mysqli_query($conexion, $borrar);

if($resultadoCambioStock && $resultado){
    echo "<script>alert('Se ha relizado la compra con éxito'); window.location='../Vista/FeedbackCompra.php?idPago=$id'</script>";
}
else{
    echo"<script>alert('No se pudo realizar la compra');window,history.go(-1);</script>";
}
mysqli_close($conexion);