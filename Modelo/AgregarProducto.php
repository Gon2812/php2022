<?php
include "../Persistencia/Conexion.php";
 
// Define variables and initialize with empty values
$id = $productName = $price = $stock = $image = "";
$productName_err = $price_err = $stock_err = $image_err = "";
$target_path = "";
$type = "local";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Arrays para guardar mensajes y errores:
$aErrores = array();
$aMensajes = array();

// Patrón para usar en expresiones regulares (admite letras acentuadas y espacios):
$patron_producto = "/^[0-9a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
$patron_numeral = "/^[0-9]+$/";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Comprobar si llegaron los campos requeridos:
    if( isset($_POST['productName']) && isset($_POST['price']) && isset($_POST['stock']) && isset($_FILES['image']))
    {
        // Nombre del Producto:
        if( empty($_POST['productName']) )
            $productName_err = "Debe especificar el nombre del producto.";
        else
        {
            // Comprobar mediante una expresión regular, que no contenga caracteres raros:
            if( preg_match($patron_producto, $_POST['productName']) ){
                $productName = test_input($_POST["productName"]);
            }
            else
                $productName_err = "El nombre sólo puede contener letras y espacios.";
        }

        // Precio:
        if(empty($_POST["price"])){
            $price_err = "Debe especificar un precio.";     
        } 
        elseif(($_POST["price"]) < 0){
            $price_err = "El precio no puede ser negativo.";
        } 
        else{
            $price = test_input($_POST["price"]);
        }

        // Stock:
        if(empty($_POST["stock"])){
            $stock_err = "Debe especificar un stock.";     
        } 
        elseif(($_POST["stock"]) < 0){
            $stock_err = "El stock no puede ser negativo.";
        } 
        else{
            $stock = test_input($_POST["stock"]);
        }

        // Imagen:
        //Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
        if (isset($_FILES['image'])){
            $cantidad= count($_FILES["image"]["tmp_name"]);
            for ($i=0; $i<$cantidad; $i++){
                //Comprobamos si el fichero es una imagen
                if (!$_FILES['image']['type'][$i]=='image/png' || !$_FILES['image']['type'][$i]=='image/jpeg'){
                    $image_err = "La imagen debe ser png o jpeg";
                }
            }
        }
    }

    else
    {
        echo "<p>No se han especificado todos los datos requeridos.</p>";
    }

    $aErrores = array($productName_err, $price_err, $stock_err, $image_err);
    // Si han habido errores se muestran, sino se mostrán los mensajes
    $aErrores = array_unique($aErrores );
    echo count($aErrores);
    if( count($aErrores) == 1 )
    {
        $insertar = "INSERT INTO mercaderia(id,	nombre,	precio,	stock)
        VALUES('$id', '$productName', '$price', '$stock')";

        $resultado = mysqli_query($conexion, $insertar);

        $dato = "SELECT id FROM mercaderia WHERE nombre = '$productName'";
        $id = mysqli_query($conexion, $dato);
        while($row=mysqli_fetch_assoc($id)){
            $idImagen = implode($row);
            foreach($_FILES["image"]['tmp_name'] as $key => $tmp_name)
            {
                //Validamos que el archivo exista
                if($_FILES["image"]["name"][$key]) {
                    $filename = $_FILES["image"]["name"][$key]; //Obtenemos el nombre original del archivo
                    $source = $_FILES["image"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
                    
                    $directorio = '../Img'; //Declaramos un  variable con la ruta donde guardaremos los archivos
                    
                    //Validamos si la ruta de destino existe, en caso de no existir la creamos
                    if(!file_exists($directorio)){
                        mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
                    }
                    
                    $dir=opendir($directorio); //Abrimos el directorio de destino
                    $target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del archivo
                    
                    //Movemos y validamos que el archivo se haya cargado correctamente
                    //El primer campo es el origen y el segundo el destino
                    if(move_uploaded_file($source, $target_path)) {	
                        $insertarImg = "INSERT INTO imgmercaderia(nombre, idMercaderia)
                                    VALUES('$target_path', '$idImagen')";
                        $resultadoImg = mysqli_query($conexion, $insertarImg);
                    } 
                    else {	
                        $image_err = "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
                    }
                    closedir($dir); //Cerramos el directorio de destino
                }
            }
        }
        
        mysqli_close($conexion);
        if($resultado && $resultadoImg){
            echo "<script>alert('Se ha registrado la mercadería con éxito'); window.location='/ObligatorioPHP/Vista/MenuPrincipalAdmin.php'</script>";
        }
        else{
            echo"<script>alert('No se pudo registrar');window,history.go(-1);</script>";
        }
    }
}