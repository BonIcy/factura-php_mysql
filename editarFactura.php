<?php
require_once("config.php");

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

$data = new Config();

$id = $_GET["id"];
$data->setID($id);
$record = $data->selectOne();
$val = $record[0];

$imagenPath = "images/"; // Ruta de la carpeta de imágenes
$imagenes = scandir($imagenPath); // Obtener la lista de imágenes

// Filtrar la lista de imágenes para eliminar los archivos ocultos (.) y (..)
$imagenes = array_filter($imagenes, function ($item) {
    return !in_array($item, ['.', '..']);
});

if (isset($_POST["editar"])) {
    $data->setNombres($_POST["nombres"]);
    $data->setDescripcion($_POST["descripcion"]);
    $data->setImagen($_POST["imagen"]);

    $data->update();
    echo "<script> alert('Los datos fueron actualizados satisfactoriamente');document.location ='facturas.php'</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Actualizar Estudiante</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/estudiantes.css">
</head>
<body>
  <div class="contenedor">
    <div class="parte-izquierda">
      <div class="perfil">
        <h3 style="margin-bottom: 2rem;">Camp Facturas.</h3>
        <img src="images/diseño.png" alt="" class="imagenPerfil">
        <h3>Yisuss</h3>
      </div>
      <div class="menus">
        <a href="home.html" style="display: flex;gap:2px;">
          <i class="bi bi-house-door"> </i>
          <h3 style="margin: 0px;font-weight: 800;">Home</h3>
        </a>
        <a href="/Estudiantes/Estudiantes.html" style="display: flex;gap:2px;">
          <i class="bi bi-people"></i>
          <h3 style="margin: 0px;">Facturas</h3>
        </a>
      </div>
    </div>
    <div class="parte-media">
      <h2 class="m-2">Factura a Editar</h2>
      <div class="menuTabla contenedor2">
        <form class="col d-flex flex-wrap" action="" method="post">
          <div class="mb-1 col-12">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" id="nombres" name="nombres" class="form-control" value="<?php echo $val['CategoriaNombre']; ?>" />
          </div>
          <div class="mb-1 col-12">
            <label for="descripcion" class="form-label">Descripcion</label>
            <input type="text" id="descripcion" name="descripcion" class="form-control" value="<?php echo $val['Descripcion']; ?>" />
          </div>
          <div class="mb-1 col-12">
                <label for="imagen" class="form-label">Imagen</label>
                <select id="imagen" name="imagen" class="form-control">
                  <?php foreach ($imagenes as $imagen): ?>
                    <option value="<?php echo $imagen; ?>" <?php echo ($val['imagen'] == $imagen) ? 'selected' : ''; ?>><?php echo $imagen; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
          <div class="col-12 m-2">
            <input type="submit" class="btn btn-primary" value="UPDATE" name="editar"/>
          </div>
        </form>
        <div id="charts1" class="charts"></div>
      </div>
    </div>
    <div class="parte-derecho" id="detalles">
      <h3>Detalle Facturas</h3>
      <p>Cargando...</p>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</body>
</html>