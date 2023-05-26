<?php
require_once("config.php");

$data = new Config();
$all = $data->selectAll();
 // Ruta de la carpeta de imágenes
$imagenPath = "images/";
//uso scandir para obtener la lista de archivos en la carpeta de imágenes y me  devuelve un array con el nombre de los archivos encontrados
$imagenes = scandir($imagenPath); 
// uso el array_filter() para filtrar la lista de archivos y eliminar los archivos ocultos (.) y (..)
$imagenes = array_filter($imagenes, function ($item) {
    return !in_array($item, ['.', '..']);
});
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página </title>
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
        <h3 style="margin-bottom: 2rem;">Camper Facturas.</h3>
        <img src="images/diseño.png" alt="" class="imagenPerfil">
        <h3>Yisuss</h3>
      </div>
      <div class="menus">
        <a href="/Home/home.php" style="display: flex;gap:2px;">
          <i class="bi bi-house-door"> </i>
          <h3 style="margin: 0px;">Home</h3>
        </a>
        <a href="estudiantes.php" style="display: flex;gap:1px;">
          <i class="bi bi-people"></i>
          <h3 style="margin: 0px;font-weight: 800;">Facturas</h3>
        </a>
      </div>
    </div>
    <div class="parte-media">
      <div style="display: flex; justify-content: space-between;">
        <h2>Facturas</h2>
        <button class="btn-m" data-bs-toggle="modal" data-bs-target="#registrarEstudiantes"><i class="bi bi-person-add" style="color: rgb(255, 255, 255);"></i></button>
      </div>
      <div class="menuTabla contenedor2">
        <table class="table table-custom">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">IMAGEN</th>
              <th scope="col">NOMBRES</th>
              <th scope="col">DESCRIPCION</th>
              <th scope="col">BORRAR</th>
              <th scope="col">DETALLES</th>
            </tr>
          </thead>
          <tbody class="" id="tabla">
            <!-- ///////Llenado DInamico desde la Base de Datos -->
            <?php foreach ($all as $val): ?>
              <tr>
                <td><?php echo $val['Categoria_id']?></td>
                <td><img src="<?php echo $imagenPath . $val['imagen']; ?>" width="70px" alt=""></td>
                <td><?php echo $val['CategoriaNombre']?></td>
                <td><?php echo $val['Descripcion']?></td>
                <td><a class="btn btn-danger" href="borrarFactura.php?id=<?= $val['Categoria_id']?>&req=delete">Borrar</a></td>
                <td><a class="btn btn-warning" href="editarFactura.php?id=<?= $val['Categoria_id']?>">Editar</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="parte-derecho " id="detalles">
      <h3>Detalle Facturas</h3>
      <p>Cargando...</p>
      <!-- ///////Generando la grafica -->
    </div>
    <!-- /////////Modal de registro de nuevo estudiante //////////-->
    <div class="modal fade" id="registrarEstudiantes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="backdrop-filter: blur(5px)">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva Factura</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="background-color: rgb(231, 253, 246);">
            <form class="col d-flex flex-wrap" action="registrarFactura.php" method="post">
              <div class="mb-1 col-12">
                <label for="nombres" class="form-label">Nombres Categoria</label>
                <input type="text" id="nombres" name="nombres" class="form-control" />
              </div>
              <div class="mb-1 col-12">
                <label for="descripcion" class="form-label">Descripcion</label>
                <input type="text" id="descripcion" name="descripcion" class="form-control" />
              </div>
              <div class="mb-1 col-12">
               <!-- ////////foreach para recorrer el array de imágenes y generar las opciones del elemento select//////////-->
                <label for="imagen" class="form-label">Imagen</label>
                <select id="imagen" name="imagen" class="form-control">
                  <?php foreach ($imagenes as $imagen): ?>
                     <!-- ////////dentro de cada iteración (en este caso uso foreach) del bucle, se genera una opción del select con el valor y el nombre de la imagen,luego se verifica si la imagen seleccionada coincide con la imagen actual en el bucle ($val['imagen'] == $imagen) y se agrega el atributo 'selected? a la opción correspondiente//////////-->
                    <option value="<?php echo $imagen; ?>" <?php echo ($val['imagen'] == $imagen) ? 'selected' : ''; ?>><?php echo $imagen; ?></option> <!-- el selected se utiliza en este caso para marcar la opción del elemento select que corresponde a la imagen actual en el bucle -->
                  <?php endforeach; ?>
                </select>
              </div>
              <div class=" col-12 m-2">
                <input type="submit" class="btn btn-primary" value="guardar" name="guardar" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"></script>
</body>
</html>