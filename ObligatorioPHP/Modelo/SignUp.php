<?php
// Include config file
include "../Persistencia/Conexion.php";
//require_once "config.php";
 
// Define variables and initialize with empty values
$id = $username = $password = $confirm_password = $name = $mail = "";
$username_err = $password_err = $confirm_password_err = $name_err = $mail_err = "";
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
$patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
$patron_usuario = "/^[0-9a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
$patron_mail = "/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Comprobar si llegaron los campos requeridos:
    if( isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['name']) && isset($_POST['mail']))
    {
        // Nombre de Usuario:
        if( empty($_POST['username']) )
            $username_err = "Debe especificar un nombre de usuario.";
        else
        {
            // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
            if( preg_match($patron_usuario, $_POST['username']) ){
                $username = test_input($_POST["username"]);
            }
            else
                $username_err = "El nombre sólo puede contener letras y espacios.";
        }

        // Contraseña:
        if(empty(trim($_POST["password"]))){
            $password_err = "Debe especificar una contraseña.";     
        } 
        elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = "La contraseña debe contener al menos 6 caracteres.";
        } 
        else{
            $password = test_input($_POST["password"]);
        }

        // Confirmación de la Contraseña
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = "Confirme la Contraseña.";     
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password)){
                $confirm_password_err = "La Confirmación debe coincidir con la Contraseña.";
            }
        }

        // Nombre de Completo:
        if( empty($_POST['name']) )
            $name_err = "Debe especificar su nombre.";
        else
        {
            // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
            if( preg_match($patron_texto, $_POST['name']) ){
                $name = test_input($_POST["name"]);
            }
            else{
                $name_err = "El nombre sólo puede contener letras y espacios.";
            }
        }

        // Correo:
        if( empty($_POST['mail']) )
            $mail_err = "Debe especificar un Correo Electrónico.";
        else
        {
            // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
            if( preg_match($patron_mail, $_POST['mail']) ){
                $mail = test_input($_POST["mail"]);
            }
            else
                $mail_err = "Correo inválido.";
        }
    }
    else
    {
        echo "<p>No se han especificado todos los datos requeridos.</p>";
    }

    $aErrores = array($username_err, $password_err, $confirm_password_err, $name_err, $mail_err);
    // Si han habido errores se muestran, sino se mostrán los mensajes
    $aErrores = array_unique($aErrores );
    echo count($aErrores);
    if( count($aErrores) == 1 )
    {
        $insertar = "INSERT INTO cliente(id, nombre, tipo, correo, nombreUsuario, pass) 
        VALUES('$id', '$name', '$type', '$mail', '$username', '$password')";

        $resultado = mysqli_query($conexion, $insertar);
        if($resultado){
            echo "<script>alert('Se ha registrado el usuario con éxito'); window.location='/ObligatorioPHP/index.php'</script>";
        }
        else{
            echo"<script>alert('No se pudo registrar');window,history.go(-1);</script>";
        }
        mysqli_close($conexion);
    }
}


/*

        // Prepare a select statement
        $sql = "SELECT ci FROM cliente WHERE ci = ?";
        
        if($stmt = mysqli_prepare(Conectarse(), $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["ci"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                //store results
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["ci"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["pass"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["pass"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["pass"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO cliente (ci, pass) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare(Conectarse(), $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: ./Vista/IniciarSesion.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close(Conectarse());
}
?>*/