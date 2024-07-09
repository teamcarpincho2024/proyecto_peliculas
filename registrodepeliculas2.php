<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAC-Movies - Iniciar Sesión</title>
    <link rel="stylesheet" href="./css/hover-min.css" media="screen" />
    <link rel="stylesheet" href="./css/sweetalert2.min.css" media="all">
    <link rel="stylesheet" href="./css/estilos.css" media="all">
    <!-- <script src="./js/vendor/jquery.js"></script> -->
    <script src="./js/sweetalert2.all.min.js?11.11.0"></script>
    <script src="https://kit.fontawesome.com/f7fb471b65.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script language="JavaScript" type="text/javascript">
      function confirma_borrar(url){
        let conforme;
        conforme=confirm("Se va a eliminar la película.\n¿ESTA SEGURO?");
        if(conforme==true){
          location.href=url;
        }
      }
    </script>
</head>
<body>

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

<?php

$exito = "no";
$error = "";

$conexion = mysqli_connect("localhost","id22032743_dbpeliculas","W!89H*V3#e","id22032743_guille");
if (mysqli_connect_errno()) {
  echo '<p>ERROR: no se pudo conectar a la BD: '.mysqli_connect_error().'</p>';
  exit;
} /*else {
  echo '<p>Conexión correcta a la BD</p>';
} */
/*
ob_start(); 
var_dump($_POST);
$out = ob_get_clean();  
echo $out;
*/

If (isset($_GET['accion']) && $_GET['accion'] == "eliminar" && isset($_GET['id_movie']) && !empty($_GET['id_movie']) && is_numeric($_GET['id_movie'])) {
  $id_movie = (int)$_GET['id_movie'];
  $borrar = 'delete from movies where id_movie = '.$id_movie;
  $result_borrar = mysqli_query($conexion, $borrar);
}
else {


$opciones1 = array(
    'opciones1' => array(
      'default' => 1,
      'min_range' => 1,
      'max_range' => 4
    )
);
$opciones2 = array(
    'opciones2' => array(
      'default' => 1,
      'min_range' => 1,
      'max_range' => 1
    )
);
//$min = $max = 4;
//$min_est = 1; $max_est = 5;

if (isset($_POST['id_director']) && !empty($_POST['id_director'])) {$id_director = (int)$_POST['id_director'];}
else {$error = 'Falta el director ';}

if (isset($_POST['nombre']) && !empty($_POST['nombre'])) {$nombre = $_POST['nombre'];}
else {$error .= 'Falta el nombre de la película ';}

if (isset($_POST['descripcion']) && !empty($_POST['descripcion'])) {$descripcion = $_POST['descripcion'];}
else {$error .= 'Falta la descripción de la película ';}

if (isset($_POST['genero']) && !empty($_POST['genero'])) {$genero = $_POST['genero'];}
else {$error .= 'Falta el género de la película ';}

if (isset($_POST['calificacion']) && !empty($_POST['calificacion'])) {$calificacion = $_POST['calificacion'];}
else {$error .= 'Falta la calificación de la película ';}

if (isset($_POST['anio']) && !empty($_POST['anio']) && strlen($_POST['anio']) == 4 && !filter_var( $_POST['anio'], FILTER_VALIDATE_INT, $opciones1) === false) {$anio = (int)$_POST['anio'];}
else {$error .= 'Falta el año de la película o el año es incorrecto ';}

if (isset($_POST['estrellas']) && !empty($_POST['estrellas']) && $_POST['estrellas'] >= 1 && $_POST['estrellas'] <= 5 && !filter_var( $_POST['estrellas'], FILTER_VALIDATE_INT, $opciones2) === false) {$estrellas = (int)$_POST['estrellas'];}
else {$error .= 'Faltan las estrellas de la película o su número es incorrecto';}

if (isset($_POST['correo']) && !empty($_POST['correo'])) {
  $contrasenia = $_POST['correo'];

  $verificacion = 'select id_usuario from users where contrasenia = "'.$contrasenia.'"';
  $verif = mysqli_query($conexion, $verificacion);

  if (mysqli_num_rows($verif) > 0) {

    $pelicula = 'insert into movies
                 (id_movie, director_id, nombre, descripcion, genero, calificacion, anio, estrellas)
                 values
                 (NULL, '.$id_director.', "'.$nombre.'", "'.$descripcion.'", "'.$genero.'", "'.$calificacion.'", '.$anio.', '.$estrellas.')';
    $result = mysqli_query($conexion, $pelicula);
//var_dump($result);
    if (!$result) {$error .= "Hubo un error en la inserción de la película: ". mysqli_error($conexion);}
    else {$exito = "si"; $_POST = array();}

  } else {
    $error .= 'La contraseña es incorrecta.';
  }
}
else {$error .= 'Falta ingresar la contraseña';}

} // cierra el else de borrar pelicula

if (!empty($error)) { 
?>
<script language='javascript'>
  Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "<?php echo $error; ?>",
      footer: '<a href="https://lavagnino.000webhostapp.com/registrodepeliculas.php">Volver</a>'
  });
</script>
<?php
}
else { 
  if ($exito == "si") {echo '<h4>La información de la película se insertó exitosamente en la BD.</h4>';}
  $consulta = "SELECT * FROM movies";
  $result = mysqli_query($conexion, $consulta);
  
  ?>
      <table class="table">
  <thead>
    <tr>
      <th scope="col">id_movie</th>
      <th scope="col">nombre del director</th>
      <th scope="col">nombre</th>
      <th scope="col">descripcion</th>
      <th scope="col">genero</th>
      <th scope="col">calificacion</th>
      <th scope="col">anio</th>
      <th scope="col">estrellas</th>
      <th scope="col">Editar</th>
    </tr>
  </thead>
  <tbody>
    <?php
  while($listado = mysqli_fetch_array($result)){

    ?>

    <tr>
      <th scope="row"><?php echo $listado['id_movie']?></th>
      <td><?php $director_id = $listado['director_id'];
            $query = "SELECT id_director, nombre, apellido FROM directores WHERE id_director = $director_id";
            $result_direc = mysqli_query($conexion, $query);

            if ($result_direc) {
                $direc = mysqli_fetch_assoc($result_direc);
                if ($direc) {
                    echo $direc['nombre'] . " " . $direc['apellido'];
                } else {
                    echo "No se encontró el director.";
                }
            } else {
                echo "Error en la consulta: " . mysqli_error($conexion);
            }?></td>
      <td><?php echo $listado['nombre']?></td>
      <td><?php echo $listado['descripcion']?></td>
      <td><?php echo $listado['genero']?></td>
      <td><?php echo $listado['calificacion']?></td>
      <td><?php echo $listado['anio']?></td>
      <td><?php echo $listado['estrellas']?></td>
      <td>
        <!-- <a href="registrodepeliculas2.php?accion=eliminar&amp;id_movie=<?php echo $listado['id_movie']?>" target="_top"><img src="clipart/delete.png" alt="Eliminar" width="32" height="32"></a> -->

        <a href="javascript: confirma_borrar('registrodepeliculas2.php?accion=eliminar&amp;id_movie=<?php echo $listado['id_movie']?>')" target="_top"><img src="clipart/delete.png" alt="Eliminar" width="32" height="32"></a>

      </td>
    </tr>

<?php
  }
?>
  </tbody>
  </table>

<?php

}

mysqli_close($conexion);
?>
    </main>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>
</body>
</html>