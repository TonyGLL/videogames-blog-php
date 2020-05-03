<?php require_once "includes/redirect.php"; ?>
<?php require_once 'includes/header.php'; ?>  
<?php require_once 'includes/aside.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Mis datos</h1>

    <!-- Mostrar exito al guardar el usuario en la BD -->
    <?php if(isset($_SESSION['completado'])): ?>      
        <div class="alerta alerta-exito">
            <?=$_SESSION['completado']?>
        </div> 
         
    <!-- Mostrar error al guardar el usuario en BD -->
    <?php elseif(isset($_SESSION['errores']['general'])): ?>
        <div class="alerta alerta-error">
            <?=$_SESSION['errores']['general']?>
        </div>
    <?php endif; ?>

    <form action="actualizar-usuario.php" method="POST">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="<?=$_SESSION['usuario']['nombre']?>"/>

        <!-- Mostrar error cuando no se llena el campo NOMBRE -->
        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'nombre') : ''; ?>

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos" value="<?=$_SESSION['usuario']['apellidos']?>"/>

        <!-- Mostrar error cuando no se llena el campo APELLIDOS -->
        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'apellidos') : ''; ?>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?=$_SESSION['usuario']['email']?>"/>

        <!-- Mostrar error cuando no se llena el campo EMAIL -->
        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'email') : ''; ?>

        <input type="submit" value="Actualizar" name="submit"/>
    </form>

</div>

<?php require_once "includes/footer.php"; ?>