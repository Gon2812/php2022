
<?php
include "../Persistencia/Conexion.php";
session_start();

$id = $productName = $price = $cantidad = "";
$target_path = "";
$type = "local";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}




    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Comprobar si llegaron los campos requeridos:
        if(isset($_POST['id']) && isset($_POST['productName']) && isset($_POST['price']) && isset($_POST['cantidad']))

        $productName = $_POST["productName"];
        $id = $_POST["id"];
        $price = $_POST["price"];
        $cantidad = test_input($_POST["cantidad"]);
        $total = $price*$cantidad;
        $idSesion =$_SESSION['id'];

        $insertar = "INSERT INTO carrito(id_cliente, cantidad, id_producto, precio, nombreProducto,total)
        VALUES('$idSesion', '$cantidad', '$id', '$price', '$productName','$total')";

        $resultado = mysqli_query($conexion, $insertar);

        if($resultado){
            echo "<script>alert('Se ha agregado al carrito con éxito'); window.location='/ObligatorioPHP/Vista/Catalogo.php'</script>";
        }
        else{
            echo"<script>alert('No se pudo agregar al carrito');window,history.go(-1);</script>";
        }
        mysqli_close($conexion);
    
    }

?>