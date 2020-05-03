<?php

if (isset($_POST)) {
    
    // Conexion a la base de datos
    require_once "includes/conexion.php";
    
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;

    // Array de errores
    $errores = array();

    // Validar los datos entes de guardarlos en la base de datos
    // Validar Nombre
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        
        $nombre_validate = true;
    }else{

        $nombre_validate = false;
        $errores['nombre'] = "Introduzca el nombre correctamente";
    }

    if (count($errores) == 0) {
        
        $sql = "INSERT INTO categorias VALUES(NULL, '$nombre');";
        $guardar = mysqli_query($db, $sql);  
    };

};

header('Location: index.php');