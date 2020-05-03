<?php

if (isset($_POST)) {

    // Conexion a la base de datos
    require_once "includes/conexion.php";

    // Recoger los valores del formulario de registro si estos existen
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ?  mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ?  mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ?  mysqli_real_escape_string($db, $_POST['password']) : false;

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

    // Validar Password
    if (!empty($password)) {

        $password_validate = true;
    }else{

        $password_validate = false;
        $errores['password'] = "Introduzca el password correctamente.";
    }

    $guardar_usuario = false;
    if (count($errores) == 0) {

        $guardar_usuario = true;

        // Cifrar la contraseña
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);

        // Insertar usuario en la tabla de usuarios de la BBDD
        $sql = "INSERT INTO usuarios VALUES(NULL, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE())";
        $guardar = mysqli_query($db, $sql);

        // Comprobar si se ha guardado correctamente
        if ($guardar) {

            $_SESSION['completado'] = "El registro de usuario se ha completado con exito";
        }else{

            $_SESSION['errores']['general'] = "Fallo al guardar el usuario!!!";
            header('Location: index.php');
        };
    }else{

        $_SESSION['errores'] = $errores;
    }
};

header('Location: index.php');
