<?php
    include ("Conexion.php");

    /*$sql = "
        DROP TABLE IF EXISTS feedbackproducto, feedbackCompra, pago, imgMercaderia, cliente, mercaderia;
    ";
    $resultado = mysqli_query($conexion, $sql);*/

    $sql = "CREATE TABLE IF NOT EXISTS cliente (
        id bigint unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
        nombre varchar (50) DEFAULT NULL,
        tipo varchar (50) DEFAULT NULL,
        correo varchar (50) DEFAULT NULL,
        nombreUsuario varchar(20) DEFAULT NULL UNIQUE,
        pass varchar(20) DEFAULT NULL
    );";
    $resultado = mysqli_query($conexion, $sql);

    $sql = "CREATE TABLE IF NOT EXISTS mercaderia (  
            id bigint unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
            nombre varchar (50) DEFAULT NULL,
            precio int DEFAULT NULL,
            stock int DEFAULT NULL
        );";
    $resultado = mysqli_query($conexion, $sql);

    $sql = "CREATE TABLE IF NOT EXISTS imgMercaderia (  
        id bigint unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
        nombre varchar (50) DEFAULT NULL,
        idMercaderia  bigint unsigned NOT NULL,
        FOREIGN KEY (idMercaderia) REFERENCES mercaderia(id)
    );";
    $resultado = mysqli_query($conexion, $sql);
        
    $sql = "CREATE TABLE IF NOT EXISTS pago (  
        id bigint unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
        cantidad int unsigned NOT NULL,
        idMercaderia bigint unsigned NOT NULL,
        idCliente bigint unsigned NOT NULL,
        FOREIGN KEY (idCliente) REFERENCES cliente(id),
        FOREIGN KEY (idMercaderia) REFERENCES mercaderia(id)
    );";
    $resultado = mysqli_query($conexion, $sql);

    $sql = "CREATE TABLE IF NOT EXISTS feedbackCompra (  
        id bigint unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,  
        comentario varchar (120) DEFAULT NULL,  
        fecha date NOT NULL,
        idCliente bigint unsigned NOT NULL,
        idPago bigint unsigned NOT NULL,
        FOREIGN KEY (idCliente) REFERENCES cliente(id),
        FOREIGN KEY (idPago) REFERENCES pago(id)
    );";
    $resultado = mysqli_query($conexion, $sql);

    $sql = "CREATE TABLE IF NOT EXISTS feedbackProducto (  
        id bigint unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,  
        comentario varchar (120) DEFAULT NULL,
        fecha date NOT NULL,
        idCliente bigint unsigned NOT NULL,
        idMercaderia bigint unsigned NOT NULL,
        FOREIGN KEY (idCliente) REFERENCES cliente(id),
        FOREIGN KEY (idMercaderia) REFERENCES mercaderia(id)
    );";
    $resultado = mysqli_query($conexion, $sql);

    $sql = "INSERT INTO cliente(id, nombre, tipo, correo, nombreUsuario, pass) 
    VALUES('1', 'Gon', 'admin', 'gc28@gmail.com', 'GC28', '123456');
    ";
    $resultado = mysqli_query($conexion, $sql);
    
    if($resultado){
        echo "<script>alert('Se han registrado las tablas con éxito'); window.location='/ObligatorioPHP/index.php'</script>";
    }
    else{
        echo"<script>alert('No se pudo registrar');window,history.go(-1);</script>";
    }
    mysqli_close($conexion);
?>