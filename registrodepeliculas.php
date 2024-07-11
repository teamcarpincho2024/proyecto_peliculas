
<?php
$conexion = mysqli_connect("localhost","id22032743_dbpeliculas","W!89H*V3#e","id22032743_guille");
if (mysqli_connect_errno()) {
  echo '<p>ERROR: no se pudo conectar a la BD</p>';
  exit;
} else {
  //echo '<p>Conexión correcta a la BD</p>';
  $direcs = mysqli_query($conexion, 'select id_director, nombre, apellido from directores');
}

if (isset($_GET['accion']) && !empty($_GET['accion'])) {$accion = $_GET['accion'];} else {$accion = "insertar";}
if (isset($_GET['id_movie']) && !empty($_GET['id_movie']) && is_numeric($_GET['id_movie'])) {$id_movie = (int)$_GET['id_movie'];} else {$id_movie = "";}
?>

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

            <form action="https://lavagnino.000webhostapp.com/registrodepeliculas2.php" method="post" id="formregistrodepeliculas" class="padding:20px">
                <input type="hidden" name="accion" value="<?php echo $accion; ?>">
                <input type="hidden" name="id_movie" value="<?php echo $id_movie; ?>">
                <div class="camposoblig"><label>Todos los campos son obligatorios</label></div>

                <div class="box">
                    <select class="form-select form-select-sm" style="margin:20px 20px 20px 15px; width:80%;" aria-label="Default select example" style="margin:20px;" aria-label="Default select example" name="id_director" id="id_director">
                        <option value="">Ingresa un director</option>
                    <?php
                      while ($dire = mysqli_fetch_array($direcs)) {
                        echo '<option ';
                        if (isset($_GET['id_director']) && !empty($_GET['id_director']) && $_GET['id_director'] == $dire['id_director']) {echo 'selected="selected" ';}
                        echo 'value="'.$dire['id_director'].'">'.$dire['nombre'].' '.$dire['apellido'].'</option>';
                      }
                    ?>
                    </select>
                    <div class="error-text"></div>
                </div>

                <div class="contcamporeg">
                    <input class="campo cform" type="text" maxlength="40" size="40" placeholder="Ingresa el Nombre" id="nombre" name="nombre" value="<?php if (isset($_GET['nombre']) && !empty($_GET['nombre'])) {echo $_GET['nombre'];} ?>">
                </div>
                <div class="contcamporeg">
                    <input class="campo cform" type="text" maxlength="40" size="40" placeholder="Ingresa una Descripcion" id="descripcion" name="descripcion" value="<?php if (isset($_GET['descripcion']) && !empty($_GET['descripcion'])) {echo $_GET['descripcion'];} ?>">
                </div>
                <div class="contcamporeg">
                    <input class="campo cform" type="text" maxlength="40" size="40" placeholder="Ingresa el Genero" id="genero" name="genero" value="<?php if (isset($_GET['genero']) && !empty($_GET['genero'])) {echo $_GET['genero'];} ?>">
                </div>
                <div class="contcamporeg">
                    <input class="campo cform" type="text" maxlength="40" size="40" placeholder="Ingresa Calificacion" id="calificacion" name="calificacion" value="<?php if (isset($_GET['calificacion']) && !empty($_GET['calificacion'])) {echo $_GET['calificacion'];} ?>">
                </div>
                <div class="contcamporeg">
                    <input class="campo cform" type="number" maxlength="4" size="40" placeholder="Ingresa el Anio" id="anio" name="anio" value="<?php if (isset($_GET['anio']) && !empty($_GET['anio'])) {echo $_GET['anio'];} ?>">
                </div>
                <div class="contcamporeg">
                    <input class="campo cform" type="number" maxlength="1" size="40" placeholder="Ingresa Estrellas" id="estrellas" name="estrellas" value="<?php if (isset($_GET['estrellas']) && !empty($_GET['estrellas'])) {echo $_GET['estrellas'];} ?>">
                </div>
                <div class="contcamporeg">
                    <input class="campo cform" type="password" maxlength="40" size="40" placeholder="Contraseña de usuario" id="correo" name="correo">
                </div>
                <div class="contcamporeg" id="terminos">
                  <input id="terminos" type="checkbox" checked="checked" />
                  <label for="terminos" class="form_terminos_texto">Acepto términos y condiciones</label>
                </div>
                <div class="contcamporeg">
                    <button class="naveg hvr-grow">Enviar datos</button>
                </div>
            </form>

        </section>
    </main>

</body>
</html>
