<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de estudiantes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    <?php
        include "./Persistencia/Conexion.php";
        $dato = "SELECT * FROM `cliente`";
        try {
            $resultado = mysqli_query($conexion, $dato);
                  
        }
        catch (\Throwable $th) {
            include("./Persistencia/CrearTablas.php");
        }
        //include("./Persistencia/CrearTablas.php");
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <section>
        <?php
            header("Location: http://localhost/ObligatorioPHP/Vista/IniciarSesion.php");
        ?>
	</section>
</body>
</html>
