<?php

    require_once "conexion.php";
    require_once "includes/helpers.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog de Videojuegos</title>

    <!-- Custom Css -->
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

    <!-- CABECERA -->
    <header id="header">

        <!-- LOGO -->
        <div id="logo">
            <a href="index.php">
                Blog de Videojuegos
            </a>

        </div>

        <!-- MENU -->
        <nav id="nav">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <?php

                    $categorias = getCategorias($db);
                    if (!empty($categorias)):
                        while($categoria = mysqli_fetch_assoc($categorias)):

                ?>

                    <li>
                        <a href="categoria.php?id=<?=$categoria['id']?>"><?=$categoria['nombre'];?></a>
                    </li>

                <?php

                    endwhile;
                    endif;

                ?>

                <li><a href="">Sobre Mi</a></li>
                <li><a href="">Contacto</a></li>
            </ul>
        </nav>

        <div class="clearfix"></div>
    </header>

    <div id="container">
