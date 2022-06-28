<?php
include("../Persistencia/Conexion.php");
$id = $_GET['id'];
//actualizar los datos
$eliminar = "DELETE FROM `mercaderia` WHERE id ='$id'";
$resultado = mysqli_query($conexion, $eliminar);

if($resultado){
    echo "<script>alert('Se han eliminado correctamente los datos.'); window.location='/ObligatorioPHP/Vista/AdministrarProducto.php';</script>";
}
else{
    echo "<script>alert('No se pudieron insertar los datos'); window.history.go(-1);</script>";
}
?>