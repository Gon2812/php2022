
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
        $stockMercaderia = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM mercaderia WHERE id=$id"))["stock"];
        $stockMercaderiaEnCarrito = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM carrito WHERE id_producto=$id"))["cantidad"];

        if((int)$cantidad > 0 && ((int)$stockMercaderia - (int)$stockMercaderiaEnCarrito) >= (int)$cantidad){

            $insertar = "INSERT INTO carrito(id_cliente, cantidad, id_producto, precio, nombreProducto,total)
            VALUES('$idSesion', '$cantidad', '$id', '$price', '$productName','$total')";

            $resultado = mysqli_query($conexion, $insertar);

            if($resultado){
                echo "<script>alert('Se ha agregado al carrito con éxito'); window.location='../Vista/Catalogo.php'</script>";
            }
            else{
                echo"<script>alert('No se pudo agregar al carrito');window,history.go(-1);</script>";
            }
            mysqli_close($conexion);
        }
        else{
            if((int)$cantidad < 1){
                echo"<script>alert('La cantidad del producto seleccionado debe de ser mayor a 0');window,history.go(-1);</script>";
            }
            else{
                echo"<script>alert('No se pudo agregar al carrito por falta de stock');window,history.go(-1);</script>";
            }
        }
    }

?>