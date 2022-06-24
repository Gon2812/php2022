<?php
include ("../Persistencia/Conexion.php");
$clientes = "SELECT * FROM cliente";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Usuarios Registrados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<table class="table">
    <div class="table__title">Usuarios</div>
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Tipo</th>
            <th scope="col">Nombre</th>
            <th scope="col">Correo</th>
            <th scope="col">Usuario</th>
        </tr>
    </thead>
    <tbody>

        <?php $resultado = mysqli_query($conexion, $clientes);
        while($row=mysqli_fetch_assoc($resultado)){ ?>
            <tr>
            
                <th><?php echo $row["id"];?></th>
                <td><?php echo $row["tipo"];?></td>
                <td><?php echo $row["nombre"];?></td>
                <td><?php echo $row["correo"];?></td>
                <td><?php echo $row["nombreUsuario"];?></td>

            </tr>
        <?php } mysqli_free_result($resultado)?>
    </tbody>
</table>
</body>
</html>