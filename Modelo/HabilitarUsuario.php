<?php
include "../Persistencia/Conexion.php";
 
$id = $_GET['id'];
$insertar='';

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $dato = "SELECT tipo, habilitado FROM cliente WHERE id = '$id'";
    $bool = mysqli_query($conexion, $dato);
    while($fila=mysqli_fetch_assoc($bool)){
        if($fila['tipo'] == "local"){
            if($fila['habilitado'] == true){
                echo "Entré al if";
                $insertar = "UPDATE `cliente` SET `habilitado` = '0' WHERE `id`='$id'";
            }
            else{
                echo "Entré al else $id";
                $insertar = "UPDATE `cliente` SET `habilitado` = '1' WHERE `id`='$id'";
            }
            $resultado = mysqli_query($conexion, $insertar);
        }
    }
    

    mysqli_close($conexion);
    if($resultado){
        echo "<script>alert('Modificado con éxito.'); window.location='/ObligatorioPHP/Vista/MenuPrincipalAdmin.php'</script>";
    }
    else{
        echo"<script>alert('No es buena idea deshabilitar a un admin...');window,history.go(-1);</script>";
    }
}