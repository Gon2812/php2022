<?php
include("../Persistencia/Conexion.php");
echo "Esto es sólo una prueba... ";
$id = $_POST['id'];
echo "Hola que tal el id es: ";
echo $id;
//actualizar los datos
$eliminar = "DELETE FROM mercaderia INNER JOIN imgmercaderia ON mercaderia.id = imgmercaderia.idMercaderia
                WHERE id='$id'";
$resultado = mysqli_query($conexion, $eliminar);

if($resultado){
    echo "<script>alert('Se han eliminado correctamente los datos.'); window.location='/ObligatorioPHP/Vista/AdministrarProducto.php';</script>";
}
else{
    echo "<script>alert('No se pudieron insertar los datos'); window.history.go(-1);</script>";
}
?>