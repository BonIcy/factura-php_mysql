<?php
require_once("config.php");

if (isset($_POST["guardar"])) {
    $config = new Config();

    $config->setNombres($_POST["nombres"]);
    $config->setDescripcion($_POST["descripcion"]);
    $config->setImagen($_POST["imagen"]);
    $config->insertData();

    echo "<script>alert('Los datos fueron guardados satisfactoriamente'); document.location = 'facturas.php';</script>";
}
?>
