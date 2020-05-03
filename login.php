<?php

// Iniciar la sesion y la conexion con la BD
require_once "includes/conexion.php";

// Recoger los datos del formulario
if (isset($_POST)) {

    $email = trim($_POST['email']);
    $password = ($_POST['password']);

    // Consulta para comprobar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $login = mysqli_query($db, $sql);

    // Comprobar si existe un login y si hay algo dentro de esa variable
    if ($login && mysqli_num_rows($login) == 1) {

        $usuario = mysqli_fetch_assoc($login);

        // Comprobar la password / cifrar
        $verify = password_verify($password, $usuario['password']);

        // Comprobar que la password esta bien verificada
        if ($verify) {

            // Utilizar la sesion para guardar los datos del usuario logueado
            $_SESSION['usuario'] = $usuario;

            if (isset($_SESSION['error_login'])) {

                unset($_SESSION['error_login']);
            };
        }else{

            // Si algo falla enviar una señal con el fallo
            $_SESSION['error_login'] = "Login incorrecto!!";
        }
    }else{

        // Mensaje de error
        $_SESSION['error_login'] = "Login incorrecto!!";
    };

};

// Redirigir al index.php
header('Location: index.php');
