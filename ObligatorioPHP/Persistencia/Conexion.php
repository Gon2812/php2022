<?php
   /* $conexion = mysqli_connect("localhost","root","","estudiantes");
    mysqli_set_charset($conexion,"utf8");

*/

    /* Database credentials. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
    define("DB_SERVER", 'localhost');
    define("DB_USERNAME", "root");
    define("DB_PASSWORD", "");
    define("DB_NAME", "obligatoriophp");
    
    /* Attempt to connect to MySQL database */
    $conexion = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check connection
    if($conexion === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    /*
    function Conectarse()
    {
        $servername = "localhost";
        $database = "obligatoriophp";
        $username = "root";
        $password = "";
        // Create connection
        $conexion = mysqli_connect($servername, $username, $password, $database);
        // Check connection
        if (!$conexion) {
            die("Connection failed: " . mysqli_connect_error());
        }
        echo "Connected successfully";
        return $conexion;
    }
    */
?>