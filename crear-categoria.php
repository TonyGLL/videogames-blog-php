<?php require_once "includes/redirect.php"; ?>
<?php require_once 'includes/header.php'; ?>  
<?php require_once 'includes/aside.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Crear Categorías</h1>
    <p>
        Añade nuevas categorias al Blog para que los usuarios puedan usarlas al crear sus entradas.
    </p>
    <br>
    <form action="guardar-categoria.php" method="POST">

        <label for="nombre">Nombre de la categoría</label>
        <input type="text" name="nombre"/>

        <input type="submit" value="Guardar">

    </form>
</div>

<?php require_once "includes/footer.php"; ?>