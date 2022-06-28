<?php
// El isset comprueba si una variable está definida.
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
 
// Verificamos si el usuario está logueado.
if(isset($_SESSION["admin"]) && $_SESSION["admin"] === true){
    header("location: ../Vista/MenuPrincipalAdmin.php");
    exit;
}
else if(isset($_SESSION["usuario"]) && $_SESSION["usuario"] === true){
    header("location: ../Vista/MenuPrincipal.php");
    exit;
}
 
include "../Persistencia/Conexion.php";
 
// Definimos variables.
$username = $password = $tipo = $habilitado =  "";
$username_err = $password_err = $login_err = "";
$param_username = $param_pass = "";
 
// Procesamos el form sólo cuando apretamos el botón de registrar.
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Nos fijamos si el nombre de usuario está vacío.
    if(empty(trim($_POST["username"]))){
        $username_err = "El Nombre de Usuario no puede quedar vacío.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Nos fijamos si la contraseña está vacía.
    if(empty(trim($_POST["password"]))){
        $password_err = "Olvidaste poner tu contraseña contraseña.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validamos las credenciales.
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, nombreUsuario, pass, tipo, habilitado FROM cliente WHERE nombreUsuario = ?";
        $stmt = mysqli_prepare($conexion, $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){                   
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $tipo, $habilitado);
                    if(mysqli_stmt_fetch($stmt)){
                        if($password == $hashed_password){
                            if($habilitado == 1){
                                // Si la contraseña es correcta configurar una sesion
                                session_start();
                                if($tipo == "admin"){
                                    $_SESSION["admin"] = true;
                                }
                                else if($tipo == "local"){
                                    $_SESSION["local"] = true;
                                }
                                else{
                                    echo "Vos quién sos!?";
                                    return -1;
                                }
                                // almacenar datos en las variables de sesion.
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;                       
                                
                                // Redireccionar al menu principal.
                                header("location: ../Vista/MenuPrincipal.php");
                            }
                            else{
                                $login_err = "Usuario no habilitado, contacte con un administrador.";
                            }
                        } 
                        else{
                            // Contraseña inválida.
                            $login_err = "Nombre de usuario o contraseña incorrectos.";
                        }
                    }
                } 
                else{
                    // Nombre de usuario inválido.
                    $login_err = "Nombre de usuario o contraseña incorrectos.";
                }
            } 
            else{
                echo "Emmm... algo no salió bien, mejor intentalo luego.";
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($conexion);
    }
}
?>