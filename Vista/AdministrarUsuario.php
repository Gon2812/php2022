<?php
include ("../Persistencia/Conexion.php");
$usuario = "SELECT * FROM cliente";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrar Usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
    <link rel="stylesheet" href="estiloUsuario.css">
</head>
<body>
    <div class="container-table">
    <div class="table__title">Usuarios</div>
    <div class="table__header">Nombre</div>
    <div class="table__header">Tipo</div>
    <div class="table__header">Correo</div>
    <div class="table__header">Nombre de Usuario</div>
    <div class="table__header">Habilitar</div>
    <?php $resultado = mysqli_query($conexion, $usuario);
        while($row=mysqli_fetch_assoc($resultado)){ ?>
            
            <div class="table__item"><?php echo $row["nombre"];?></div>
            <div class="table__item"><?php echo $row["tipo"];?></div>
            <div class="table__item"><?php echo $row["correo"];?></div>
            <div class="table__item"><?php echo $row["nombreUsuario"];?></div>
            <?php
                if($row["habilitado"] == true)
                {
                    ?>
                        <a href="../Modelo/HabilitarUsuario.php?id=<?php echo $row["id"];?>" class="table__item__link">Deshabilitar</a>
                    <?php
                }
                else
                {
                    ?>
                        <a href="../Modelo/HabilitarUsuario.php?id=<?php echo $row["id"];?>" class="table__item__link">Habilitar</a>
                    <?php
                }
                ?>
        <?php 
    } mysqli_free_result($resultado)?>
    </div>
</body>
</html>