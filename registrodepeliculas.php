<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAC-Movies - Registrarse</title>
    <link rel="stylesheet" href="./css/hover-min.css" media="screen" />
    <link rel="stylesheet" href="./css/estilos.css" media="all">
    <script src="./js/vendor/jquery.js"></script>
    <script src="https://kit.fontawesome.com/f7fb471b65.js" crossorigin="anonymous"></script>
</head>
<body id="formIniciarSesion">

<header>
  <nav>
    <div class="izq hvr-grow"><i class="fas fa-film" aria-hidden="true"></i> <strong>CAC-Movies</strong></div>
    <div class="der">
      <ul>
        <li><a href="index.html" target="_top">Inicio</a></li>
        <li><a href="api.html" target="_top">API Películas</a></li>
        <li><a href="registrarse.html" target="_top">Registrarse</a></li>
        <li><a href="registrodepeliculas.php" target="_top"><button id="iniciarsesion" class="hvr-grow">Administrador Peliculas</button></a></li>
        <li><a href="iniciarsesion.html" target="_top"><button id="iniciarsesion" class="hvr-grow">Iniciar sesión</button></a></li>
      </ul>
    </div>
  </nav>
</header>

    <main id="contenido">
        <section class="seccionregistrodepeliculas">
            
            <h2 class="tituloform">Registro de Películas</h2>
<!---https://lavagnino.000webhostapp.com/registrodepeliculas2.php--->
            <form action="registrodepeliculas2.php" method="post" id="formregistrodepeliculas">
                <div class="camposoblig"><label>Todos los campos son obligatorios</label></div>

                <div>
                <?php
$conexion = mysqli_connect("localhost","id22032743_dbpeliculas","W!89H*V3#e","id22032743_guille");
if (mysqli_connect_errno()) {
  echo '<p>ERROR: no se pudo conectar a la BD</p>';
} else {
  //echo '<p>Conexión correcta a la BD</p>';
  $direcs = mysqli_query($conexion, 'select id_director, nombre, apellido from directores');
}
                ?>
                    <select name="id_director" id="id_director">
                        <option value="">Ingresa un director</option>
                    <?php
                      while ($dire = mysqli_fetch_array($direcs)) {
                        echo '<option value="'.$dire['id_director'].'">'.$dire['nombre'].' '.$dire['apellido'].'</option>';
                      }
                    ?>
                    </select>
                    <div class="error-text"></div>
                </div>

                <div>
                    <input class="campo cform" type="text" maxlength="40" size="40" placeholder="Ingresa el Nombre" id="nombre" name="nombre">
                    <div class="error-text"></div>
                </div>
                <div>
                    <input class="campo cform" type="text" maxlength="40" size="40" placeholder="Ingresa una Descripcion" id="descripcion" name="descripcion">
                    <div class="error-text"></div>
                </div>
                <div>
                    <input class="campo cform" type="text" maxlength="40" size="40" placeholder="Ingresa el Genero" id="genero" name=" genero">
                    <div class="error-text"></div>
                </div>
                <div>
                    <input class="campo cform" type="text" maxlength="40" size="40" placeholder="Ingresa Calificacion" id="calificacion" name="calificacion">
                    <div class="error-text"></div>
                </div>
                <div>
                    <input class="campo cform" type="number" maxlength="4" size="40" placeholder="Ingresa el Anio" id="anio" name="anio">
                    <div class="error-text"></div>
                </div>
                <div>
                    <input class="campo cform" type="number" maxlength="1" size="40" placeholder="Ingresa Estrellas" id="estrellas" name="estrellas">
                    <div class="error-text"></div>
                </div>
                <div>
                    <input class="campo cform" type="password" maxlength="40" size="40" placeholder="Email de usuario" id="correo" name="correo">
                    <div class="error-text"></div>
                </div>
                <div id="terminos">
                  <input id="terminos" type="checkbox" checked="checked" />
                  <label for="terminos" class="form_terminos_texto">Acepto términos y condiciones</label>
                </div>
                <div>
                    <button class="naveg hvr-grow">Enviar datos</button>
                </div>
            </form>

        </section>
    </main>

</body>
</html>