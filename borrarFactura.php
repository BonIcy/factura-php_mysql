<?php
require_once("config.php");

if (isset($_GET['id']) && isset($_GET["req"]) && $_GET["req"] == "delete") {
    $config = new Config();
    $config->setId($_GET['id']);
    $config->delete();

    echo "<script>alert('Datos borrados correctamente'); document.location = 'facturas.php';</script>";
}
?>
