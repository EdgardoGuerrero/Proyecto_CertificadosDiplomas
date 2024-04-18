<?php
    require_once("../../config/conexion.php");
    session_destroy();
    header("Location:".conectar::ruta()."index.php");
    exit();
?>