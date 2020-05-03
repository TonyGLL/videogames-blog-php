<?php require_once "includes/redirect.php"; ?>
<?php require_once 'includes/header.php'; ?>  
<?php require_once 'includes/aside.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Crear Entradas</h1>
    <p>
        Añade nuevas entradas al Blog para que los usuarios puedan leerlas y disfrutar de nuestro contenido.
    </p>
    <br>
    <form action="guardar-entrada.php" method="POST">

        <label for="titulo">Titulo:</label>
        <input type="text" name="titulo"/>

        <!-- Mostrar error cuando no se llena el campo TITULO -->
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarErrores($_SESSION['errores_entrada'], 'titulo') : ''; ?>

        <label for="descripcion">Descripcion:</label>
        <textarea name="descripcion" id="" cols="30" rows="10"></textarea>

        <!-- Mostrar error cuando no se llena el campo DESCRIPCION -->
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarErrores($_SESSION['errores_entrada'], 'descripcion') : ''; ?>


        <label for="categoria">Categoría:</label>
        <select name="categoria">
            <?php 
                $categorias = getCategorias($db);
                if(!empty($categorias)): 
                while($categoria = mysqli_fetch_assoc($categorias)):
            ?>
                <option value="<?=$categoria['id']?>">
                    <?=$categoria['nombre']?>
                </option>
            <?php
                endwhile;
                endif;
            ?>

        </select>

        <!-- Mostrar error cuando no se llena el campo CATEGORIA -->
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarErrores($_SESSION['errores_entrada'], 'categoria') : ''; ?>

        <input type="submit" value="Guardar">

    </form>

    <?php borrarErrores() ?>
</div>

<?php require_once "includes/footer.php"; ?>