<?php

if (isset($_POST)) {

    // Conexion a la base de datos
    require_once "includes/conexion.php";

    // Recoger los valores del formulario de actualizacion si estos existen
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ?  mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ?  mysqli_real_escape_string($db, trim($_POST['email'])) : false;

    // Array de errores
    $errores = array();

    // Validar los datos entes de guardarlos en la base de datos
    // Validar Nombre
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        
        $nombre_validate = true;
    }else{

        $nombre_validate = false;
        $errores['nombre'] = "Introduzca el nombre correctamente.";
    }

    // Validar Apellidos
    if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
        
        $apellidos_validate = true;
    }else{

        $apellidos_validate = false;
        $errores['apellidos'] = "Introduzca los apellidos correctamente.";
    }

    // Validar Email
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        $email_validate = true;
    }else{

        $email_validate = false;
        $errores['email'] = "Introduzca el email correctamente.";
    }

    $guardar_usuario = false;
    if (count($errores) == 0) {
        
        $usuario = $_SESSION['usuario'];
        $guardar_usuario = true;

        // Comprobar si el email ya existe.
        $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $isset_email = mysqli_query($db, $sql);

        $isset_user = mysqli_fetch_assoc($isset_email);

        if ($isset_user['id'] == $usuario['id'] || empty($isset_user)) {
            
            // Actualizar usuario en la tabla de usuarios de la BBDD
            $usuario = $_SESSION['usuario'];
            $sql = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos', email = '$email' WHERE id = {$usuario['id']}";
            $guardar = mysqli_query($db, $sql);
    
            // Comprobar si se ha guardado correctamente
            if ($guardar) {
                
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellidos;
                $_SESSION['usuario']['email'] = $email;
    
                $_SESSION['completado'] = "Tus datos se han actualizado con éxito.";
            }else{
    
                $_SESSION['errores']['general'] = "Fallo al guardar actualizacion de datos!!!";
            };
        }else{

            $_SESSION['errores']['general'] = "El email introducido pertenece a otro usuario.";
        };

    }else{

        $_SESSION['errores'] = $errores;
    }
};

header('Location: mis-datos.php');