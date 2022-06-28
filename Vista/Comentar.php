<?php
    include("../Persistencia/Conexion.php");

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
    $patron_texto = "/^[.,!?a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";

    // Comprobar si llegaron los campos requeridos:
    if(isset($_POST['comentario']) && isset($_POST['id']))
    {

        // Comentario:
        if(empty($_POST['comentario']))
            $aErrores[] = "Debe especificar un comentario.";
        else
        {
            // Comprobar que sólo contiene letras y espacios:
            if( preg_match($patron_texto, $_POST['comentario']) ){
                $aMensajes[] = "Comentario: [".$_POST['comentario']."]";
                $comentario = test_input($_POST["comentario"]);
            }
            else
                $aErrores[] = "No pongas signos raros en los comentarios...";
        }

        // ID:
        if(empty($_POST['id']))
            $aErrores[] = "Debe especificar el ID.";
        else
        {
            // Comprobar que es un ID correcto
            if(is_int((int)$_POST['id'])){
                $aMensajes[] = "ID: [".(int)$_POST['id']."]";
                $idMercaderia = test_input(((int)$_POST['id']));
            }
            else
                $aErrores[] = "El ID debe ser un integer";
        }

        
    }
    else
    {
        echo "<p>No se han especificado todos los datos requeridos.</p>";
    }

    // Si han habido errores se muestran, sino se mostrán los mensajes
    if( count($aErrores) > 0 )
    {
        echo "<p>ERRORES ENCONTRADOS:</p>";

        // Mostrar los errores:
        for( $contador=0; $contador < count($aErrores); $contador++ )
            $Errores = $aErrores[$contador] ;
            echo"<script>alert('$Errores');window,history.go(-1);</script>";
    }
    else
    {
        // Mostrar los mensajes:
        for( $contador=0; $contador < count($aMensajes); $contador++ ){
            echo $aMensajes[$contador]."<br/>";
        }

        // Initialize the session
        session_start();
        $idCliente = $_SESSION["id"];

        date_default_timezone_set("America/Montevideo");
        $fecha = date('Y-m-d');

        $insertar = "INSERT INTO feedbackproducto(id, comentario, fecha, idCliente, idMercaderia) 
        VALUES('$id', '$comentario', '$fecha', '$idCliente', '$idMercaderia')";
        

        $resultado = mysqli_query($conexion, $insertar);
        if($resultado){
            echo "<script>alert('Se ha creado el comentario con éxito'); window.location='./Catalogo.php'</script>";
        }
        else{
            echo"<script>alert('No se pudo crear el comentario');window,history.go(-1);</script>";
        }
        mysqli_close($link);
    }
?>