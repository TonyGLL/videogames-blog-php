  <!-- SIDEBAR -->
  <aside id="sidebar">

      <div id="buscador" class="block-aside">

          <form action="buscar.php" method="POST">

              <input type="text" name="busqueda" id="busqueda" placeholder="BUSCAR..."/>

              <input type="submit" value="Buscar" />
          </form>
      </div>

      <!-- Mostrar las credenciales del usuario logueado -->
      <?php if (isset($_SESSION['usuario'])) : ?>
          <div id="usuario-logueado" class="block-aside">
              <h3>Bienvenido, <?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellidos'] ?></h3>

              <!-- Botones -->
              <a href="crear-entradas.php" class="boton boton-verde">Crear entradas</a>
              <a href="crear-categoria.php" class="boton boton-azul">Crear categorias</a>
              <a href="mis-datos.php" class="boton boton-naranja">Mis datos</a>
              <a href="cerrar.php" class="boton boton-rojo">Cerrar sesión</a>
          </div>

      <?php endif; ?>

      <?php if (!isset($_SESSION['usuario'])) : ?>

          <div id="login" class="block-aside">
              <h3>Identificate</h3>

              <?php if (isset($_SESSION['error_login'])) : ?>
                  <div class="alerta alerta-error">
                      <?= $_SESSION['error_login']; ?>
                  </div>
              <?php endif; ?>

              <form action="login.php" method="POST">

                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" />

                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" />

                  <input type="submit" value="Entrar" />
              </form>
          </div>

          <div id="register" class="block-aside">
              <h3>Regístrate</h3>

              <!-- Mostrar exito al guardar el usuario en la BD -->
              <?php if (isset($_SESSION['completado'])) : ?>
                  <div class="alerta alerta-exito">
                      <?= $_SESSION['completado'] ?>
                  </div>

                  <!-- Mostrar error al guardar el usuario en BD -->
              <?php elseif (isset($_SESSION['errores']['general'])) : ?>
                  <div class="alerta alerta-error">
                      <?= $_SESSION['errores']['general'] ?>
                  </div>
              <?php endif; ?>

              <form action="register.php" method="POST">

                  <label for="nombre">Nombre</label>
                  <input type="text" name="nombre" id="nombre" />

                  <!-- Mostrar error cuando no se llena el campo NOMBRE -->
                  <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'nombre') : ''; ?>

                  <label for="apellidos">Apellidos</label>
                  <input type="text" name="apellidos" id="apellidos" />

                  <!-- Mostrar error cuando no se llena el campo APELLIDOS -->
                  <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'apellidos') : ''; ?>

                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" />

                  <!-- Mostrar error cuando no se llena el campo EMAIL -->
                  <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'email') : ''; ?>

                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" />

                  <!-- Mostrar error cuando no se llena el campo PASSWORD -->
                  <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'password') : ''; ?>

                  <input type="submit" value="Registrar" name="submit" />
              </form>

              <?php borrarErrores(); ?>
          </div>
      <?php endif; ?>

  </aside>